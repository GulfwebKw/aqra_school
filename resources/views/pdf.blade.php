<table style="width: 90%;margin: 10px auto;">
    <tr>
        <td style="width: 80%;border-right: none;border-top: none;vertical-align: middle;padding: 20px 20px;">
            <strong>Application Form Of  {{ $application->SFName }}</strong>
            <div style="margin-top:10px;"></div>
            <strong>Printed at</strong>: {{ now() }}
        </td>
    </tr>
</table>
<div style="width: 90%;margin: 10px auto;">
@include('report' , ['application' => $application])
</div>
