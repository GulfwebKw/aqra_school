<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use \HackerESQ\Settings\Facades\Settings as config;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\File;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class Settings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationGroup = 'Setting';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.settings';


    public $site_title ;
    public $logo ;
    public $logo_dark ;
    public $email_from ;
    public $email_to ;
    public $MYFATOORAH_API_KEY ;

    public $rules = [
        'site_title' => ['required' , 'string'],
        'MYFATOORAH_API_KEY' => ['required' , 'string'],
        'email_from' => ['required' , 'email'],
        'email_to' => ['required' , 'email'],
        'logo' => ['nullable' , 'image'],
        'logo_dark' => ['nullable' , 'image'],
    ];
    protected $validationAttributes = [
        'site_title' => 'Site Title',
        'MYFATOORAH_API_KEY' => 'Myfatoorah API Key',
        'email_from' => 'Email From',
        'email_to' => 'Notification Email address',
        'logo' => 'Logo Light',
        'logo_dark' => 'Logo Dark',
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
                        ->label('Logo Light')
                        ->type('file')
                        ->rule(['nullable' , 'image']),
                    TextInput::make('logo_dark')
                        ->label('Logo Dark')
                        ->type('file')
                        ->rule(['nullable' , 'image']),
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

        if ( $data['logo'] instanceof TemporaryUploadedFile) {
            $carbon = now();
            $logoPath = "public/". $carbon->year .'/'.$carbon->month.'/'.$carbon->day.'/'.'logo.' . $data['logo']->guessExtension();
            $data['logo']->storeAs($logoPath);
            $last_logo_image = config::get('logo');
            config::force()->set(['logo' => $logoPath]);
            File::delete($last_logo_image);
        }
        if ( $data['logo_dark'] instanceof TemporaryUploadedFile ) {
            $carbon = now();
            $logoPath = "public/". $carbon->year .'/'.$carbon->month.'/'.$carbon->day.'/'.'logo_dark.' . $data['logo_dark']->guessExtension();
            $data['logo_dark']->storeAs($logoPath);
            $last_logo_image = config::get('logo_dark');
            config::force()->set(['logo_dark' => $logoPath]);
            File::delete($last_logo_image);
        }
        config::force()->set(collect($data)->except(['logo' , 'logo_dark'])->toArray());
        Notification::make()
            ->title('Settings saved successfully!')
            ->success()
            ->send();
    }
}
