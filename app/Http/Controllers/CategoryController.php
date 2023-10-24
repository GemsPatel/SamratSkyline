<?php

namespace App\Http\Controllers;

use App\Models\Admin\Blogs;
use Illuminate\Support\Facades\Request;

class CategoryController extends Controller
{
    /**
     * 
     */
    function getCategoryBlogs( Request $request, $slug="" ){

        $explode = explode('-', $slug);
        $blogArr = Blogs::with('blog_tag_map', 'sub_category', 'category')->where( [ 'sub_category_id' => $explode[0], 'status' => 1 ] )->paginate(15);
        return view('front.blog-listing', compact('blogArr'));
    }
}