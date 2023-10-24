<?php

namespace App\Models\Admin;

use CreateBlogTagMapsTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogTagMaps extends Model
{
    use HasFactory;

    public function tags(){
        return $this->hasOne( Tags::class, 'id', 'tag_id' );
    }
}
