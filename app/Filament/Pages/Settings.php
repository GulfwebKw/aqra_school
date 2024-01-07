<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use \HackerESQ\Settings\Facades\Settings as config;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class Settings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationGroup = 'Setting';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.settings';


    public $site_title ;
    public $logo ;
    public $email_from ;
    public $email_to ;
    public $MYFATOORAH_API_KEY ;

    public $rules = [
        'site_title' => ['required' , 'string'],
        'MYFATOORAH_API_KEY' => ['required' , 'string'],
        'email_from' => ['required' , 'email'],
        'email_to' => ['required' , 'email'],
        'logo' => ['nullable' , 'image'],
    ];
    protected $validationAttributes = [
        'site_title' => 'Site Title',
        'MYFATOORAH_API_KEY' => 'Myfatoorah API Key',
        'email_from' => 'Email From',
        'email_to' => 'Notification Email address',
        'logo' => 'Logo',
    ];


    public function mount()
    {
        $this->form->fill(config::get());
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make()
                ->schema([
                    TextInput::make('site_title')
                        ->label('Site Title')
                        ->required(),
                    TextInput::make('email_from')
                        ->label('Email From')
                        ->rule(['email'])
                        ->required(),
                    TextInput::make('email_to')
                        ->label('Notification Email address')
                        ->rule(['email'])
                        ->required(),
                    TextInput::make('logo')
                        ->label('Logo')
                        ->type('file')
                        ->rule(['image']),
                ])
                ->columns(3),
            Section::make()
                ->label('Payment Gateway')
                ->schema([
                    TextInput::make('MYFATOORAH_API_KEY')
                        ->label('Myfatoorah API Key')
                        ->required(),
                ])
                ->columns(2),
        ];
    }


    public function save()
    {
        $this->validate();
        $data = $this->form->getState() ;
        config::force()->set(collect($data)->except('logo')->toArray());
        Notification::make()
            ->title('Settings saved successfully!')
            ->success()
            ->send();
    }
}
