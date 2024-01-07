<?php

namespace App\Http\Controllers;


use App\Models\Application;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Request;
use MyFatoorah\Library\PaymentMyfatoorahApiV2;

class Controller extends BaseController
{
    public function callback() {
        $status = false;
        $invoiceReference = null;
        $application = null;
        try {
            $mfObj = new PaymentMyfatoorahApiV2(config('myfatoorah.api_key'), config('myfatoorah.country_iso'), config('myfatoorah.test_mode'));
            $data = $mfObj->getPaymentStatus(request('paymentId'), 'PaymentId');

            if ($data->InvoiceStatus == 'Paid') {
                $msg = 'Invoice is paid.';
                $status = true;
                $invoiceReference = $data->InvoiceReference;
                $application = Application::query()->where('paid' , 0)->findOrFail($data->CustomerReference);
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
        }
        return redirect()->route('application.show' , ['uuid' => $application->uuid , 'msg' => $msg ]);

    }

    public function application($uuid){
        $application = Application::query()->where('uuid' , $uuid)->firstOrFail();
        return view('application' , compact('application' ));
    }


}
