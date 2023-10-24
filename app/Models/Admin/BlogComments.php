<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class BlogComments extends Model
{
    protected $table = "blog_comments";

    public function blog(){
        return $this->HasOne(Blogs::class, 'id', 'blog_id');
    }
}
