<style>
    table, th, td {
        margin: auto;
        padding: 5px;
        border: 1px solid #344050;
        border-collapse: collapse;
    }
</style>
<table style="width: 100%;border-collapse: collapse;">
    <tr>
        <td colspan="4" style="background-color: #344050;color: white;padding: 10px 5px;">Student Information #{{ $application->id }}</td>
    </tr>
    <tr>
        <td colspan="4">
            <strong>
                Student Full Name:
            </strong><br>
            {{ $application->SFName }}
        </td>
    </tr>
    <tr>
        <td style="width: 25%;">
            <strong>
                Nationality:
            </strong><br>
            {{ $application->SNationlity }}
        </td>
        <td style="width: 25%;">
            <strong>
                Date Of Birth:
            </strong><br>
            {{ $application->dob }}
        </td>
        <td style="width: 25%;">
            <strong>
                Sex:
            </strong><br>
            {{ $application->Sex }}
        </td>
        <td style="width: 25%;">
            <strong>
                Student Civil ID:
            </strong><br>
            {{ $application->SCivilId }}
        </td>
    </tr>
    <tr>
        <td>
            <strong>
                Previous School Name:
            </strong><br>
            {{ $application->SPreviousSchool }}
        </td>
        <td>
            <strong>
                Curriculum:
            </strong><br>
            {{ $application->SCurricullum }}
        </td>
        <td colspan="2">
            <strong>
                Grade Applied For:
            </strong><br>
            {{ $application->grade->title }}
        </td>
    </tr>
    <tr>
        <td colspan="4">
            <strong>
                Home Address:
            </strong><br>
            {{ $application->SHAddress }}
        </td>
    </tr>
    <tr>
        <td colspan="4" style="background-color: #344050;color: white;padding: 10px 5px;">Father Information</td>
    </tr>
    <tr>
        <td colspan="4">
            <strong>
                Father Full Name:
            </strong><br>
            {{ $application->FName }}
        </td>
    </tr>
    <tr>
        <td>
            <strong>
                Nationality:
            </strong><br>
            {{ $application->FNationlity }}
        </td>
        <td>
            <strong>
                Father Civil ID:
            </strong><br>
            {{ $application->FCivilId }}
        </td>
        <td>
            <strong>
                Mobile:
            </strong><br>
            {{ $application->FMobile }}
        </td>
        <td>
            <strong>
                Email:
            </strong><br>
            {{ $application->FEmail }}
        </td>
    </tr>
    <tr>
        <td>
            <strong>
                Occupation:
            </strong><br>
            {{ $application->FOccupation }}
        </td>
        <td colspan="3">
            <strong>
                Business Address:
            </strong><br>
            {{ $application->FBAddress }}
        </td>
    </tr>
    <tr>
        <td colspan="4" style="background-color: #344050;color: white;padding: 10px 5px;">Mother Information</td>
    </tr>
    <tr>
        <td colspan="4">
            <strong>
                Mother Full Name:
            </strong><br>
            {{ $application->MName }}
        </td>
    </tr>
    <tr>
        <td>
            <strong>
                Nationality:
            </strong><br>
            {{ $application->MNationlity }}
        </td>
        <td>
            <strong>
                Mother Civil ID:
            </strong><br>
            {{ $application->MCivilId }}
        </td>
        <td>
            <strong>
                Mobile:
            </strong><br>
            {{ $application->MMobile }}
        </td>
        <td>
            <strong>
                Email:
            </strong><br>
            {{ $application->MEmail }}
        </td>
    </tr>
    <tr>
        <td>
            <strong>
                Occupation:
            </strong><br>
            {{ $application->MOccupation }}
        </td>
        <td colspan="3">
            <strong>
                Business Address:
            </strong><br>
            {{ $application->MBAddress }}
        </td>
    </tr>
    <tr>
        <td colspan="2" style="background-color: #344050;color: white;padding: 10px 5px;">Invoice Information</td>
        <td colspan="2" style="background-color: #344050;color: white;padding: 10px 5px;">Price: {{ number_format($application->price , 2) }} KD</td>
    </tr>
    <tr>
        <td>
            <strong>
                Status:
            </strong><br>
            {{ $application->paid ? 'Paid' : 'Pending' }}
        </td>
        <td>
            <strong>
                Invoice ID:
            </strong><br>
            {{ $application->invoiceId }}
        </td>
        <td>
            <strong>
                Invoice Reference:
            </strong><br>
            {{ $application->invoiceReference }}
        </td>
        <td>
            <strong>
                Paid At:
            </strong><br>
            {{ $application->paid_at }}
        </td>
    </tr>
    <tr>
        <td colspan="4" style="background-color: #344050;color: white;padding: 10px 5px;">Other Information</td>
    </tr>
    <tr>
        <td>
            <strong>
                Created at:
            </strong><br>
            {{ $application->created_at }}
        </td>
        <td colspan="3">
            <strong>
                How did you know about {{ \HackerESQ\Settings\Facades\Settings::get('site_title') }} ?
            </strong><br>
            {{ $application->HowDidYouKnow }}
        </td>
    </tr>
</table>
