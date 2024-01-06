<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $title
 * @property float $price
 * @property bool $is_active
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
        'is_active'
    ];

    protected $casts = [
        'price' => 'float' ,
        'is_active' => 'boolean'
    ];

}
