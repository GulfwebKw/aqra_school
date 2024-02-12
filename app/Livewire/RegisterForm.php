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
        'form.SFName' => ['required' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.SNationlity' => ['required' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.dob-day' => ['required' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.dob-month' => ['required' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.dob-year' => ['required' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.Sex' => ['required' , 'string' ,'in:Male,Female' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.SCivilId' => ['required' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.SPreviousSchool' => ['required' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.SCurricullum' => ['required' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.Grade' => ['required' , 'exists:grades,id' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.SHAddress' => ['required' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.FName' => ['required' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.FNationlity' => ['required' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.FCivilId' => ['required' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.FMobile' => ['required' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.FEmail' => ['required' , 'email' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.FOccupation' => ['required' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.FBAddress' => ['required' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.MName' => ['required' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.MNationlity' => ['required' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.MCivilId' => ['required' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.MMobile' => ['required' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.MEmail' => ['required' , 'email' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.MOccupation' => ['required' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.MBAddress' => ['required' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.HowDidYouKnow' => ['required' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.leaveReason' => ['required' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.FDegree' => ['required' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.MDegree' => ['required' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.Medical' => ['nullable' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.Siblings' => ['required' , 'int' , 'max:10', 'min:0' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.Duration' => ['required' , 'int' , 'max:10', 'min:0' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.SiblingsName' => ['required' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.WhichGrades' => ['required' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.PCEnglish' => ['required' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.Marital' => ['required' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
        'form.Educational' => ['required' , 'string' , 'regex:/^[a-zA-Z0-9 .!@#$%^*&_+\-\/,\';\]\[|`":()\{\}~]+$/u'],
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
        'form.MDegree' => 'Degree',
        'form.FDegree' => 'Degree',
    ];


    public function updated($name, $value)
    {
        if ( in_array($name , ['form.dob-year' , 'form.dob-month' ,'form.dob-day' ])) {
            if (isset($this->form['dob-year'], $this->form['dob-month'], $this->form['dob-day']) and $this->form['dob-year'] and $this->form['dob-month'] and $this->form['dob-day']) {
                $ageCalculator = Settings::get('ageFrom', 'now') === "now" ? now()->startOfDay() : Carbon::createFromFormat('Y-m-d', Settings::get('ageFromDate'))->startOfDay();
                $birthDay = Carbon::createFromDate($this->form['dob-year'], $this->form['dob-month'], $this->form['dob-day']);
                $this->age = $ageCalculator->diffInYears($birthDay);
                $year = $ageCalculator->diffInYears($birthDay);
                $month = $ageCalculator->diffInMonths($birthDay) - ($ageCalculator->diffInYears($birthDay) * 12);
                $this->grades = Grade::query()
                    ->where(function ($query) use ($year, $month) {
                        $query->where(function ($query) use ($year, $month) {
                            $query->where('from_year', $year)
                                ->where('until_year', $year)
                                ->where('from_month', '<=', $month)
                                ->where('until_month', '>', $month);
                        })
                            ->orwhere(function ($query) use ($year, $month) {
                                $query->where('from_year', $year)
                                    ->where('until_year', '>', $year)
                                    ->where('from_month', '<=', $month);
                            })
                            ->orwhere(function ($query) use ($year, $month) {
                                $query->where('from_year', '<=', $year)
                                    ->where('until_year', '>', $year);
                            })
                            ->orwhere(function ($query) use ($year, $month) {
                                $query->where('until_year', $year)
                                    ->where('from_year', '<', $year)
                                    ->where('until_month', '>', $month);
                            });
                    })
                    ->where('is_active', 1)
                    ->orderBy('ordering')->get();
            } else {
                $this->grades = [];
                $this->form['Grade'] = null;
            }
        }
    }

    public function save()
    {
        $this->validate();
        /** @var Grade $grade */
        $grade = Grade::query()->where('is_active' , 1)->findOrFail($this->form['Grade']);
        $this->form['dob'] = Carbon::createFromDate($this->form['dob-year'],$this->form['dob-month'],$this->form['dob-day']);
        $this->form['ageDate'] = Settings::get('ageFrom', 'now') === "now" ? now()->startOfDay() : Carbon::createFromFormat('Y-m-d', Settings::get('ageFromDate'))->startOfDay();
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
        $this->grades = [];
        $this->form['Sex'] = '';
        $this->form['Grade'] = '';
        $this->form['SCurricullum'] = '';
    }
    public function render()
    {
        return view('livewire.register-form')->layout('layouts.guest');
    }

}
