<style>
    @page { margin: 0; }
    body { margin: 0; }
</style>
<body style="background-size:cover;background-repeat: no-repeat;background-image: url('{{ asset(Str::replaceFirst('public/' , 'storage/' , \HackerESQ\Settings\Facades\Settings::get('pdf_background'))) }}');">
<div style="width: 100%;margin: 70px auto 50px;vertical-align: middle;text-align: center;">
    <strong>Application Form  {{ $application->SFName }}</strong>
</div>
<div style="width: 90%;margin: 0 auto;">
    @include('report' , ['application' => $application])
</div>
</body>
