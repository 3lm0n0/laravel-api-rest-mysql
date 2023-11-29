<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cards';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'hp',
        'first_edition',
        'expansion',
        'kind',
        'rarity',
        'price',
        'image'
    ];

    /**
    * The attributes that should be hidden for arrays.
    * @var array
    */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
