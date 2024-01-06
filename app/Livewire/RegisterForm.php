<?php

namespace App\Livewire;

use App\Models\Grade;
use HackerESQ\Settings\Facades\Settings;
use Illuminate\Support\Facades\File;
use Livewire\Component;

class RegisterForm extends Component
{

    public $form = [];
    public $grades = [];
    public $rules = [
        'form.SFName' => ['required' , 'string'],
        'form.SNationlity' => ['required' , 'string'],
        'form.dob-day' => ['required' , 'string'],
        'form.dob-month' => ['required' , 'string'],
        'form.dob-year' => ['required' , 'string'],
        'form.Sex' => ['required' , 'string'],
        'form.SCivilId' => ['required' , 'string'],
        'form.SPreviousSchool' => ['required' , 'string'],
        'form.SCurricullum' => ['required' , 'string'],
        'form.Grade' => ['required' , 'string' , 'exist:grades,id'],
        'form.SHAddress' => ['required' , 'string'],
        'form.FName' => ['required' , 'string'],
        'form.FNationlity' => ['required' , 'string'],
        'form.FCivilId' => ['required' , 'string'],
        'form.FMobile' => ['required' , 'string'],
        'form.FEmail' => ['required' , 'string'],
        'form.FOccupation' => ['required' , 'string'],
        'form.FBAddress' => ['required' , 'string'],
        'form.MName' => ['required' , 'string'],
        'form.MNationlity' => ['required' , 'string'],
        'form.MCivilId' => ['required' , 'string'],
        'form.MMobile' => ['required' , 'string'],
        'form.MEmail' => ['required' , 'string'],
        'form.MOccupation' => ['required' , 'string'],
        'form.MBAddress' => ['required' , 'string'],
        'form.HowDidYouKnow' => ['required' , 'string'],
    ];

    protected $validationAttributes = [
        'form.SFName' => 'Student Full Name',
        'form.SNationlity' => 'Nationality',
        'form.dob-day' => 'Birthdate',
        'form.dob-month' => 'Birthdate',
        'form.dob-year' => 'Birthdate',
        'form.Sex' => 'Sex',
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
    ];


    public function save()
    {
        $this->validate();

    }

    public function mount()
    {
        $this->grades = Grade::query()->where('is_active' , 1)->orderBy('price')->get();
    }
    public function render()
    {
        return view('livewire.register-form')->layout('layouts.guest');
    }

}
