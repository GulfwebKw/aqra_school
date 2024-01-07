<table style="width: 90%;margin: 10px auto;">
    <tr>
        <td colspan="2" style="border: none;text-align: center;padding-top: 20px;">
            <strong>{{ \HackerESQ\Settings\Facades\Settings::get('site_title') }}</strong>
        </td>
    </tr>
    <tr>
        <td style="width: 80%;border-right: none;border-top: none;vertical-align: middle;padding: 20px 20px;">
            <strong>Application Form Of  {{ $application->SFName }}</strong>
            <div style="margin-top:10px;"></div>
            <strong>Printed at</strong>: {{ now() }}
        </td>
        <td style="width: 20%;border-left: none;border-top: none; text-align: right;padding: 10px;">
            @if(\HackerESQ\Settings\Facades\Settings::get('logo_dark'))
            <img style="max-width: 100%;" src="{{ asset(Str::replaceFirst('public/' , 'storage/' , \HackerESQ\Settings\Facades\Settings::get('logo_dark'))) }}"/>
            @endif
        </td>
    </tr>
</table>
<div style="width: 90%;margin: 10px auto;">
@include('report' , ['application' => $application])
</div>
