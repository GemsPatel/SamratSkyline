<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    public function type(){
        return $this->hasone(Type::class, 'id', 'type_id');
    }

    public function sub_category(){
        return $this->hasMany( Categories::class, 'id', 'parent_id' );
    }

    public function blog_best_single_view(){
        return $this->hasOne( Blogs::class, 'category_id', 'id' )->orderBy( 'view', 'desc' )->where( 'status', 1 );//->with('blog_tag_map', 'author')
    }
}
