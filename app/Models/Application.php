<?php

namespace App\Models;

use DateInterval;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $SFName
 * @property string $SNationlity
 * @property Carbon $dob
 * @property Carbon $ageDate
 * @property string $Sex
 * @property string $SCivilId
 * @property string $SPreviousSchool
 * @property string $SCurricullum
 * @property int $Grade_id
 * @property ?DateInterval $age
 * @property Grade $grade
 * @property string $SHAddress
 * @property int $Duration
 * @property string $leaveReason
 * @property string $Medical
 * @property int $Siblings
 * @property string $SiblingsName
 * @property string $WhichGrades
 * @property string $PCEnglish
 * @property string $Marital
 * @property string $Educational
 * @property string $FName
 * @property string $FNationlity
 * @property string $FCivilId
 * @property string $FMobile
 * @property string $FEmail
 * @property string $FOccupation
 * @property string $FBAddress
 * @property string $MName
 * @property string $MNationlity
 * @property string $MCivilId
 * @property string $MMobile
 * @property string $MEmail
 * @property string $MOccupation
 * @property string $MBAddress
 * @property string $HowDidYouKnow
 * @property string $invoiceId
 * @property string $uuid
 * @property float $price
 * @property string $invoiceReference
 * @property string $FDegree
 * @property string $MDegree
 * @property Carbon $paid_at
 * @property boolean $paid
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class Application extends Model
{
    use SoftDeletes;

    protected $fillable =  [
        'SFName',
        'SNationlity',
        'dob',
        'ageDate',
        'Sex',
        'SCivilId',
        'SPreviousSchool',
        'SCurricullum',
        'Grade_id',
        'Duration',
        'leaveReason',
        'Medical',
        'Siblings',
        'SiblingsName',
        'WhichGrades',
        'PCEnglish',
        'Marital',
        'Educational',
        'SHAddress',
        'FName',
        'FNationlity',
        'FCivilId',
        'FMobile',
        'FEmail',
        'FOccupation',
        'FBAddress',
        'MName',
        'MNationlity',
        'MCivilId',
        'MMobile',
        'MEmail',
        'MOccupation',
        'MBAddress',
        'HowDidYouKnow',
        'price',
        'paid',
        'paid_at',
        'invoiceReference',
        'invoiceId',
        'uuid',
        'FDegree',
        'MDegree',
    ];

    protected $casts = [
        'Grade_id' => 'int' ,
        'price' => 'float' ,
        'dob' => 'date',
        'ageDate' => 'date',
        'paid' => 'boolean',
        'paid_at' => 'datetime',
    ];

    protected $appends = [
        'age',
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class , 'Grade_id')->withTrashed();
    }

    public function getAgeAttribute(): ?DateInterval
    {
        if( $this->dob )
            return $this->ageDate ? $this->ageDate->diff($this->dob) : now()->diff($this->dob);
        return null;
    }
}
