<?php

namespace App\Http\Controllers;


use App\Jobs\sendRegisterEmailJob;
use App\Models\Application;
use Barryvdh\DomPDF\Facade\Pdf;
use HackerESQ\Settings\Facades\Settings;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use MyFatoorah\Library\PaymentMyfatoorahApiV2;

class Controller extends BaseController
{
    public function callback() {
        /** @var Application $application */
        $status = false;
        $invoiceReference = null;
        $application = null;
        try {
            $mfObj = new PaymentMyfatoorahApiV2(Settings::get('MYFATOORAH_IS_LIVE', true) ? Settings::get('MYFATOORAH_API_KEY') : config('myfatoorah.api_key') , config('myfatoorah.country_iso'), ! (bool) Settings::get('MYFATOORAH_IS_LIVE', true));
            $data = $mfObj->getPaymentStatus(request('paymentId'), 'PaymentId');

            if (intval($data->CustomerReference) > 0)
                $application = Application::query()->where('paid' , 0)->findOrFail($data->CustomerReference);
            if ($data->InvoiceReference)
                $invoiceReference = $data->InvoiceReference;
            if ($data->InvoiceStatus == 'Paid') {
                $msg = 'Invoice is paid.';
                $status = true;
            } else if ($data->InvoiceStatus == 'Failed') {
                $msg = 'Invoice is not paid due to ' . $data->InvoiceError;
            } else if ($data->InvoiceStatus == 'Expired') {
                $msg = 'Invoice is expired.';
            }

        } catch (\Exception $e) {
            $status = false;
            $msg = $e->getMessage();
        }
        if ( $application == null)
            abort(404);
        if ( $status ){
            $application->invoiceReference = $invoiceReference;
            $application->paid_at = now();
            $application->paid = true;
            $application->save();
            dispatch(new sendRegisterEmailJob($application->id));
        }
        return redirect()->route('application.show' , ['uuid' => $application->uuid , 'msg' => $msg ]);

    }

    public function application($uuid){
        /** @var Application $application */
        $application = Application::query()->where('uuid' , $uuid)->firstOrFail();
        return view('application' , compact('application' ));
    }

    public function applicationPay($uuid){
        /** @var Application $application */
        $application = Application::query()->where('paid' , 0)->where('uuid' , $uuid)->firstOrFail();

        if (!$application->grade->is_active)
            abort(404);

        if ( $application->grade->price <= 0 ){
            $application->paid = true;
            $application->paid_at = now();
            $application->save();
            dispatch(new sendRegisterEmailJob($application->id));
            return redirect()->route('application.show' , ['uuid' => $application->uuid ]);
        }
        try {
            $payLoadData = [
                'CustomerName'       => $application->SFName,
                'InvoiceValue'       => $application->grade->price,
                'DisplayCurrencyIso' => 'KWD',
//                'CustomerEmail'      => $application->FEmail,
                'CallBackUrl'        => route('callback'),
                'ErrorUrl'           => route('callback'),
                'MobileCountryCode'  => '+965',
//                'CustomerMobile'     => $this->form['FMobile'],
                'Language'           => 'en',
                'CustomerReference'  => $application->id,
                'SourceInfo'         => $application->grade->title,
            ];
            $mfObj = new PaymentMyfatoorahApiV2(Settings::get('MYFATOORAH_IS_LIVE', true) ? Settings::get('MYFATOORAH_API_KEY') : config('myfatoorah.api_key') , config('myfatoorah.country_iso'), ! (bool) Settings::get('MYFATOORAH_IS_LIVE', true));
            $data            = $mfObj->getInvoiceURL($payLoadData, 0);
            $application->invoiceId = $data['invoiceId'];
            $application->price = $payLoadData['InvoiceValue'];
            $application->save();
            return redirect()->to($data['invoiceURL']);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return redirect()->route('application.show' , ['uuid' => $application->uuid , 'msg' => 'There was a problem connecting to the payment gateway! Please try again.' ]);
        }
    }


    public function applicationExport($uuid){
        /** @var Application $application */
        $application = Application::query()->where('uuid' , $uuid)->firstOrFail();
        $pdf = Pdf::loadView('pdf', compact('application'))->setPaper('a4');
        return $pdf->download('application_form_'.$application->id.'.pdf');
    }
}
