<style>
    table, th, td {
        margin: auto;
        padding: 5px;
        border: 1px solid #344050;
        border-collapse: collapse;
        font-size: .75rem;
    }
</style>
<table style="width: 100%;border-collapse: collapse;">
    <tr>
        <td colspan="4" style="background-color: #344050;color: white;padding: 5px 5px;">Student Information #{{ $application->id }}</td>
    </tr>
    <tr>
        <td colspan="4">
            <strong>
                Student Full Name:
            </strong>
            {{ $application->SFName }}
        </td>
    </tr>
    <tr>
        <td style="width: 25%;">
            <strong>
                Grade Applied For:
            </strong><br>
            {{ $application->grade->title }}
        </td>
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
            {{ $application->dob->format('Y-m-d') }}  <strong><br> Age:</strong> {{ "{$application->age->y} years, {$application->age->m} months, and {$application->age->d} days" }}
        </td>
        <td style="width: 25%;">
            <strong>
                Gender:
            </strong><br>
            {{ $application->Sex }}
        </td>
    </tr>
    <tr>
        <td>
            <strong>
                Student Civil ID:
            </strong><br>
            {{ $application->SCivilId }}
        </td>
        <td>
            <strong>
                School Name:
            </strong><br>
            {{ $application->SPreviousSchool }}
        </td>
        <td>
            <strong>
                Curriculum:
            </strong><br>
            {{ $application->SCurricullum }}
        </td>
        <td>
            <strong>
                Duration:
            </strong><br>
            {{ $application->Duration }}
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <strong>
                Reason to leave:
            </strong><br>
            {{ $application->leaveReason }}
        </td>
        <td colspan="2">
            <strong>
                Medical Issues:
            </strong><br>
            {{ $application->Medical }}
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <strong>
                How many Siblings at IQAS:
            </strong><br>
            {{ $application->Siblings }}
        </td>
        <td>
            <strong>
                Siblings Name:
            </strong><br>
            {{ $application->SiblingsName }}
        </td>
        <td>
            <strong>
                Which Grades:
            </strong><br>
            {{ $application->WhichGrades }}
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
        <td colspan="4" style="background-color: #344050;color: white;padding: 5px 5px;">Father Information</td>
    </tr>
    <tr>
        <td colspan="4">
            <strong>
                Father Full Name:
            </strong>
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
                Degree:
            </strong><br>
            {{ $application->FDegree }}
        </td>
        <td>
            <strong>
                Occupation:
            </strong><br>
            {{ $application->FOccupation }}
        </td>
        <td colspan="2">
            <strong>
                Business Address:
            </strong><br>
            {{ $application->FBAddress }}
        </td>
    </tr>
    <tr>
        <td colspan="4" style="background-color: #344050;color: white;padding: 5px 5px;">Mother Information</td>
    </tr>
    <tr>
        <td colspan="4">
            <strong>
                Mother Full Name:
            </strong>
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
                Degree:
            </strong><br>
            {{ $application->MDegree }}
        </td>
        <td>
            <strong>
                Occupation:
            </strong><br>
            {{ $application->MOccupation }}
        </td>
        <td colspan="2">
            <strong>
                Business Address:
            </strong><br>
            {{ $application->MBAddress }}
        </td>
    </tr>
    <tr>
        <td colspan="2" style="background-color: #344050;color: white;padding: 5px 5px;">Invoice Information</td>
        <td colspan="2" style="background-color: #344050;color: white;padding: 5px 5px;">Price: {{ number_format($application->price , 2) }} KD</td>
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
        <td colspan="4" style="background-color: #344050;color: white;padding: 5px 5px;">Other Information</td>
    </tr>
    <tr>
        <td colspan="2">
            <strong>
                Parents Command of English:
            </strong><br>
            {{ $application->PCEnglish }}
        </td>
        <td>
            <strong>
                Marital Status:
            </strong><br>
            {{ $application->Marital }}
        </td>
        <td>
            <strong>
                Educational Custody:
            </strong><br>
            {{ $application->Educational }}
        </td>
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
