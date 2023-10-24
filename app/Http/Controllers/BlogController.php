<?php

namespace App\Http\Controllers;

use App\Models\Admin\Analytics;
use App\Models\Admin\BlogComments;
use App\Models\Admin\Blogs;
use App\Models\Admin\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Stevebauman\Location\Facades\Location;

class BlogController extends Controller
{
    public $websiteDetails = "";

    function __construct()
    {
        $this->websiteDetails = getHeaderInformation();
    }
    /**
     *
     */
    function index( Request $request ){
        $headerInfo = $this->websiteDetails;
        $topSliderArr = Categories::where( [ 
                        'website_id' => $headerInfo->id,
                        'status' => 1 
                    ] )
                    ->inRandomOrder()
                    ->limit(5)
                    ->get();

        $topStories = Blogs::with('blog_tag_map', 'category', 'author')
                    ->where( [ 
                        'website_id' => $headerInfo->id,
                        'status' => 1 
                    ] )
                    ->orderBy( 'id', 'desc' )
                    ->limit(18)
                    ->get()
                    ->toArray();
        $topStories = array_chunk( $topStories, 6 );

        $recentArr = Blogs::with('blog_tag_map', 'category', 'author')
                    ->where( [ 
                        'website_id' => $headerInfo->id,
                        'status' => 1 
                    ] )
                    ->orderBy( 'view', 'desc' )
                    ->offset(5)
                    ->limit(6)
                    ->get();

        $bestCategories = Categories::with('blog_best_single_view')
                    ->where( [ 
                        'website_id' => $headerInfo->id,
                        'status' => 1 
                    ] )
                    ->inRandomOrder()
                    ->limit(5)
                    ->get();
                    
        $active = '/';
        return view('front.'.$this->websiteDetails->slug.'.index', compact('topStories', 'topSliderArr', 'recentArr', 'bestCategories', 'active', 'headerInfo' ));
    }

	/**
	 *
	 */
	function redirectOrigionalUrl( Request $request, $short_url="" ){
        $headerInfo = $this->websiteDetails;
		if( $short_url ){
			$blog = Blogs::select('slug')->where( [ 
                'website_id' => $headerInfo->id,
                'short_url' => $short_url 
            ] )->first();

			if( $blog ){
				return Redirect::to( url( $blog->slug ) );
			}
		}

		return Redirect::to( url( '/' ) );
	}

    /**
     *
     */
    function getCategoryWiseBlogs( Request $request, $slug="" ){
        $headerInfo = $this->websiteDetails;
        $search = $request->q;
        $category = Categories::where( 'slug', $slug )->first();
        $blogArr = Blogs::with('blog_tag_map', 'category', 'author')//, 'sub_category'
                    ->where( [ 
                        'website_id' => $headerInfo->id,
                        'category_id' => $category->id, 
                        'status' => 1 
                    ] )
                    ->when( $search, function ($query, $search) {
                        return $query->where( 'title',  'LIKE', '%'.$search.'%' )
                        ->where( 'short_description', 'LIKE', '%'.$search.'%' );
                    })
                    ->paginate(15);

        $recentArr = Blogs::with('blog_tag_map', 'category', 'author')//, 'sub_category'
                    ->where( [ 
                        'website_id' => $headerInfo->id,
                        'status' => 1 
                    ] )
                    ->orderBy( 'view', 'desc' )
                    ->limit(6)
                    ->get();

        $action = url('category/'.$slug );
        $active = $slug;
        $custom_page_title = $category->title.' - '.$headerInfo->name;
        $meta_description = $category->title;
        $meta_keyword = $category->slug;

        return view('front.'.$this->websiteDetails->slug.'.blog-listing', compact('blogArr', 'recentArr', 'slug', 'action', 'request', 'custom_page_title', 'meta_description', 'meta_keyword', 'active', 'headerInfo' ));
    }

    /**
     *
     */
    function getBlogDetails( Request $request, $slug="" ){

        $headerInfo = $this->websiteDetails;

        if( $slug == "admin" ){
            return Redirect::to( url('admin/login') );
        }

        $data = Blogs::with('blog_tag_map', 'category', 'author')
                ->where( [ 
                    'website_id' => $headerInfo->id,
                    'slug' => $slug 
                ] )
                ->first();

        $categories = [];

        $recentArr = Blogs::with('blog_tag_map', 'category', 'author')
                    ->where( [ 
                        'website_id' => $headerInfo->id,
                        'status' => 1 
                    ] )
                    ->orderBy( 'view', 'desc' )
                    ->limit(6)
                    ->get();

        $prevBlog = $nextBlog = [];
        $custom_page_title = $meta_description = $meta_keyword = '';
        $meta_image = url( 'storage/app/website/'.$this->websiteDetails->header_logo );
        $active = '/';

        if( $data ){
            $prevBlog = Blogs::select('id', 'slug', 'title', 'image')->where( 'id', '<', $data->id )->where( 'status', 1 )->limit(1)->orderBy( 'id', 'DESC' )->get();
            $nextBlog = Blogs::select('id', 'slug', 'title', 'image')->where( 'id', '>', $data->id )->where( 'status', 1 )->limit(1)->orderBy( 'id', 'ASC' )->get();

            $custom_page_title = $data->title.' - TimesOfReading';
            $meta_description = $data->short_description;
            $meta_keyword = $data->short_description;
            $meta_image = url( 'storage/app/'.$data->image );

            $active = getField( 'categories', 'id', 'slug', $data->category_id );
        }

		$isRunAdvertisementParam = ( isset( $_GET['advt'] ) ) ? $_GET['advt'] : 1;
        if ( false && $isRunAdvertisementParam ){
            Blogs::increment( 'view', 1 ); // count + 1

            //generate analytics format
            $ip = "66.249.70.3";//$request->ip();
            if( $ip != "127.0.0.1" && strlen( $ip ) > 7 )
            {
                $locationPosition = Location::get( $ip );
                $locationPosition = json_encode( $locationPosition );
                $locationPosition = json_decode( $locationPosition, 1 );

                $analytics = new Analytics();
                $analytics->areaCode = $locationPosition['areaCode'];
                $analytics->cityName = $locationPosition['cityName'];
                $analytics->countryCode = $locationPosition['countryCode'];
                $analytics->countryName = $locationPosition['countryName'];
                $analytics->ip = $locationPosition['ip'];
                $analytics->isoCode = $locationPosition['isoCode'];
                $analytics->latitude = $locationPosition['latitude'];
                $analytics->longitude = $locationPosition['longitude'];
                $analytics->metroCode = $locationPosition['metroCode'];
                $analytics->postalCode = $locationPosition['postalCode'];
                $analytics->regionCode = $locationPosition['regionCode'];
                $analytics->regionName = $locationPosition['regionName'];
                $analytics->zipCode	 = $locationPosition['zipCode'];
                $analytics->save();
            }
        }
        
        return view('front.'.$this->websiteDetails->slug.'.blog-details', compact( 'data', 'categories', 'recentArr', 'prevBlog', 'nextBlog', 'custom_page_title', 'meta_description', 'meta_keyword', 'meta_image', 'active', 'headerInfo' ) );
    }

    /**
     *
     */
    function getBlogLists( Request $request, $search='' ){

        $headerInfo = $this->websiteDetails;
        $blogArr = Blogs::with('blog_tag_map', 'category', 'author')
                    ->where( [ 
                        'website_id' => $headerInfo->id,
                        'status' => 1 
                    ] );

                    if( $request->q ){
                        $search = $request->q;
                        $blogArr = $blogArr->where( 'title',  'LIKE', '%'.$search.'%' )
                        ->orWhere( 'short_description', 'LIKE', '%'.$search.'%' );
                    }

        $blogArr = $blogArr->orderBy( 'id', 'desc' )
                ->paginate(15);

        $bestCategories = Categories::with('blog_best_single_view')
                    ->where( [ 
                        'website_id' => $headerInfo->id,
                        'status' => 1 
                    ] )
                    ->inRandomOrder()
                    ->get();

        $recentArr = Blogs::with('blog_tag_map', 'category', 'author')
                    ->where( [
                        'website_id' => $headerInfo->id,
                        'status', 1
                    ] )
                    ->orderBy( 'view', 'desc' )
                    ->offset(5)
                    ->limit(6)
                    ->get();

        $slug = '';
        $action = route('readAll');
		$active = "";
        
        return view('front.'.$this->websiteDetails->slug.'.blog-listing', compact('blogArr', 'bestCategories', 'recentArr', 'slug', 'action', 'request', 'active', 'headerInfo' ));
    }

    /**
     * 
     */
    public function blogComments(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'content' => 'required|string',
            'blog_id' => 'required',
        ], [
            'email.required' => 'Please provide your email address.',
            'email.email' => 'Please provide a valid email address.',
        ]);

        // Create a new comment
        $comment = new BlogComments();
        $comment->blog_id = $validatedData['blog_id'];
        $comment->name = $validatedData['name'];
        $comment->email = $validatedData['email'];
        $comment->content = $validatedData['content'];
        $comment->ip_address = $request->ip();
        $comment->save();

        return response()->json(['success' => true, 'message' => 'Comment successfully added; we will publish your comment as soon as possible.']);
    }
}
