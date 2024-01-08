<table style="width: 100%;border: none;">
    <tr>
        <td colspan="2" style="border: none;text-align: center;padding-top: 20px;">
            <strong>{{ \HackerESQ\Settings\Facades\Settings::get('site_title') }}</strong>
        </td>
    </tr>
    <tr>
        <td style="width: 80%;border: none;vertical-align: middle;padding: 20px 20px;">
            Dear User,
            <div style="margin-top:10px;"></div>
            New application form has been received. you can visit it from:<br>
            <a href="{{ route('application.show' , ['uuid' => $application->uuid])  }}">
                {{ route('application.show' , ['uuid' => $application->uuid])  }}
            </a>
            <div style="margin-top:10px;"></div>
            You can also view application information below the email and attachments.
        </td>
        <td style="width: 20%;border: none; text-align: right;padding: 10px;">
            @if(\HackerESQ\Settings\Facades\Settings::get('logo_dark'))
            <img style="max-width: 100%;" src="{{ asset(Str::replaceFirst('public/' , 'storage/' , \HackerESQ\Settings\Facades\Settings::get('logo_dark'))) }}"/>
            @endif
        </td>
    </tr>
</table>
<div style="width: 100%;margin: 10px auto;">
@include('report' , ['application' => $application])
</div>
