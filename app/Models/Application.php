<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $SFName
 * @property string $SNationlity
 * @property Carbon $dob
 * @property string $Sex
 * @property string $SCivilId
 * @property string $SPreviousSchool
 * @property string $SCurricullum
 * @property int $Grade_id
 * @property Grade $grade
 * @property string $SHAddress
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
        'Sex',
        'SCivilId',
        'SPreviousSchool',
        'SCurricullum',
        'Grade_id',
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
    ];

    protected $casts = [
        'Grade_id' => 'int' ,
        'price' => 'float' ,
        'dob' => 'date',
        'paid' => 'boolean',
        'paid_at' => 'datetime',
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class , 'Grade_id')->withTrashed();
    }
}
