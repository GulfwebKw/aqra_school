<?php

namespace App\Jobs;

use App\Mail\RegisterEmail;
use App\Models\Application;
use Barryvdh\DomPDF\Facade\Pdf;
use HackerESQ\Settings\Facades\Settings;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class sendRegisterEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $aplication_id;
    /**
     * Create a new job instance.
     */
    public function __construct($id)
    {
        $this->aplication_id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $to = Settings::get( 'email_to' ,false);
        if ( $to ) {
            $application = Application::query()->findOrFail($this->aplication_id);

            $pdf = PDF::loadView('pdf', compact('application'));

            Mail::to($to)->send(new RegisterEmail($pdf,$application));
        }
    }
}
