<style>
    @page { margin: 0; }
    body { margin: 0; }
</style>
<body style="background-size:cover;background-repeat: no-repeat;background-image: url('{{ asset(Str::replaceFirst('public/' , 'storage/' , \HackerESQ\Settings\Facades\Settings::get('pdf_background'))) }}');">
<div style="width: 100%;margin: 70px auto 85px;vertical-align: middle;text-align: center;">
    {{--    <strong>Application Form:</strong>  {{ $application->SFName }}--}}
    {{--    <div style="margin-top:10px;"></div>--}}
    {{--    <strong>Submission Date & Time:</strong>  {{ $application->created_at }}--}}
</div>
<div style="width: 220px;font-size:12px;line-height:5px;float:right;margin-right:47px;margin-top:-30px; background-color: #344050;color: white;padding: 8px 5px;">
    <small style="">Submission Date & Time: {{ $application->created_at }}</small>
</div>
<div style="width:692px;margin: 0 auto 6px; background-color: #344050;color: white;padding: 5px 5px;">
    <strong>Application Form: {{ $application->SFName }}</strong>
</div>
<div style="width: 90%;margin: 0 auto;">
    @include('report' , ['application' => $application])
</div>
</body>
