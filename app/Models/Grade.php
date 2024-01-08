<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property string $title
 * @property float $price
 * @property int $ordering
 * @property bool $is_active
 * @property Collection<Application> $applications
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class Grade extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'title' ,
        'price' ,
        'ordering',
        'is_active'
    ];

    protected $casts = [
        'price' => 'float' ,
        'ordering' => 'int' ,
        'is_active' => 'boolean'
    ];

    public function applications()
    {
        return $this->hasMany(Application::class , 'Grade_id');
    }

}
