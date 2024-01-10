<?php

namespace App\Livewire;

use App\Jobs\sendRegisterEmailJob;
use App\Models\Application;
use App\Models\Grade;
use HackerESQ\Settings\Facades\Settings;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;
use MyFatoorah\Library\PaymentMyfatoorahApiV2;

class RegisterForm extends Component
{

    public $form = [];
    public $errorMessage = null;
    public $age = null;
    public $grades = [];
    public $rules = [
        'form.SFName' => ['required' , 'string'],
        'form.SNationlity' => ['required' , 'string'],
        'form.dob-day' => ['required' , 'string'],
        'form.dob-month' => ['required' , 'string'],
        'form.dob-year' => ['required' , 'string'],
        'form.Sex' => ['required' , 'string' ,'in:Male,Female'],
        'form.SCivilId' => ['required' , 'string'],
        'form.SPreviousSchool' => ['required' , 'string'],
        'form.SCurricullum' => ['required' , 'string'],
        'form.Grade' => ['required' , 'exists:grades,id'],
        'form.SHAddress' => ['required' , 'string'],
        'form.FName' => ['required' , 'string'],
        'form.FNationlity' => ['required' , 'string'],
        'form.FCivilId' => ['required' , 'string'],
        'form.FMobile' => ['required' , 'string'],
        'form.FEmail' => ['required' , 'email'],
        'form.FOccupation' => ['required' , 'string'],
        'form.FBAddress' => ['required' , 'string'],
        'form.MName' => ['required' , 'string'],
        'form.MNationlity' => ['required' , 'string'],
        'form.MCivilId' => ['required' , 'string'],
        'form.MMobile' => ['required' , 'string'],
        'form.MEmail' => ['required' , 'email'],
        'form.MOccupation' => ['required' , 'string'],
        'form.MBAddress' => ['required' , 'string'],
        'form.HowDidYouKnow' => ['required' , 'string'],
        'form.leaveReason' => ['required' , 'string'],
        'form.Medical' => ['nullable' , 'string'],
        'form.Siblings' => ['required' , 'int' , 'max:10', 'min:0'],
        'form.Duration' => ['required' , 'int' , 'max:10', 'min:0'],
        'form.SiblingsName' => ['required' , 'string'],
        'form.WhichGrades' => ['required' , 'string'],
        'form.PCEnglish' => ['required' , 'string'],
        'form.Marital' => ['required' , 'string'],
        'form.Educational' => ['required' , 'string'],
    ];

    protected $validationAttributes = [
        'form.SFName' => 'Student Full Name',
        'form.SNationlity' => 'Nationality',
        'form.dob-day' => 'Birthdate',
        'form.dob-month' => 'Birthdate',
        'form.dob-year' => 'Birthdate',
        'form.Sex' => 'Gender',
        'form.SCivilId' => 'Student Civil ID',
        'form.SPreviousSchool' => 'Previous School Name',
        'form.SCurricullum' => 'Curriculum',
        'form.Grade' => 'Grade',
        'form.SHAddress' => 'Home Address',
        'form.FName' => 'Father Full Name',
        'form.FNationlity' => 'Father Nationality',
        'form.FCivilId' => 'Father Civil ID',
        'form.FMobile' => 'Father Mobile',
        'form.FEmail' => 'Father Email',
        'form.FOccupation' => 'Father Occupation',
        'form.FBAddress' => 'Father Business Address',
        'form.MName' => 'Mother Full Name',
        'form.MNationlity' => 'Mother Nationality',
        'form.MCivilId' => 'Mother Civil ID',
        'form.MMobile' => 'Mother Mobile',
        'form.MEmail' => 'Mother Email',
        'form.MOccupation' => 'Mother Occupation',
        'form.MBAddress' => 'Mother Business Address',
        'form.HowDidYouKnow' => '',
        'form.leaveReason' => '',
        'form.Duration' => '',
        'form.Medical' => '',
        'form.WhichGrades' => '',
        'form.Siblings' => '',
        'form.SiblingsName' => '',
        'form.PCEnglish' => '',
        'form.Marital' => '',
        'form.Educational' => '',
    ];


    public function updated($name, $value)
    {
        if ( isset($this->form['dob-year'] , $this->form['dob-month'] , $this->form['dob-day']) and $this->form['dob-year'] and $this->form['dob-month'] and $this->form['dob-day'])
            $this->age = now()->diffInYears(Carbon::createFromDate($this->form['dob-year'],$this->form['dob-month'],$this->form['dob-day']));
    }

    public function save()
    {
        $this->validate();
        /** @var Grade $grade */
        $grade = Grade::query()->where('is_active' , 1)->findOrFail($this->form['Grade']);
        $this->form['dob'] = Carbon::createFromDate($this->form['dob-year'],$this->form['dob-month'],$this->form['dob-day']);
        $this->form['Grade_id'] = $this->form['Grade'];
        $application = new Application();
        $application->fill($this->form);
        do {
            $uuid = Str::uuid();
        } while ( Application::query()->where('uuid' , $uuid)->exists());
        $application->uuid = $uuid;
        $application->price = $grade->price;
        $application->save();
        if ( $grade->price <= 0 ){
            $application->paid = true;
            $application->paid_at = now();
            $application->save();
            dispatch(new sendRegisterEmailJob($application->id));
            return redirect()->route('application.show' , ['uuid' => $application->uuid ]);
        }
        try {
            $payLoadData = [
                'CustomerName'       => $this->form['SFName'],
                'InvoiceValue'       => $grade->price,
                'DisplayCurrencyIso' => 'KWD',
//                'CustomerEmail'      => $this->form['FEmail'],
                'CallBackUrl'        => route('callback'),
                'ErrorUrl'           => route('callback'),
                'MobileCountryCode'  => '+965',
//                'CustomerMobile'     => $this->form['FMobile'],
                'Language'           => 'en',
                'CustomerReference'  => $application->id,
                'SourceInfo'         => $grade->title,
            ];
            $mfObj = new PaymentMyfatoorahApiV2(Settings::get('MYFATOORAH_IS_LIVE', true) ? Settings::get('MYFATOORAH_API_KEY') : config('myfatoorah.api_key') , config('myfatoorah.country_iso'), ! (bool) Settings::get('MYFATOORAH_IS_LIVE', true));
            $data            = $mfObj->getInvoiceURL($payLoadData, 0);
            $application->invoiceId = $data['invoiceId'];
            $application->save();
            return redirect()->to($data['invoiceURL']);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            $this->errorMessage='There was a problem connecting to the payment gateway! Please try again.';
        }
    }

    public function mount()
    {
        $this->grades = Grade::query()
            ->where('is_active' , 1)
            ->orderBy('ordering')->get();
        $this->form['Sex'] = '';
        $this->form['Grade'] = '';
        $this->form['SCurricullum'] = '';
    }
    public function render()
    {
        return view('livewire.register-form')->layout('layouts.guest');
    }

}
