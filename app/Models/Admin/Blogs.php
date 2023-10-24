<?php

namespace App\Models\Admin;

use App\Models\User;
use CreateBlogTagMapsTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    use HasFactory;

    public function category(){
        return $this->hasOne( Categories::class, 'id', 'category_id' );//->where( 'status', 1 );
    }

    public function sub_category(){
        return $this->hasOne( Categories::class, 'id', 'sub_category_id' );
    }

    public function blog_tag_map(){
        return $this->hasMany( BlogTagMaps::class, 'blog_id', 'id' )->with('tags');
    }

    public function author(){
        return $this->hasOne( User::class, 'id', 'user_id' );
    }
}
