<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionMap extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'collection_id',
        'customer_id',
        'title_id',
        'type_id',
        'author_id', 
        'music_id',
        'spend_time',
        'total_time',
        'sort_order'
    ];
}
