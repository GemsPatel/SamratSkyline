<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\TitleResource;
use App\Models\Admin\AudioBookAuthorTitleMap;
use App\Models\Admin\AudioDramaAuthorTitleMap;
use App\Models\Admin\Author;
use App\Models\Admin\AuthorTitleMap;
use App\Models\Admin\Categories;
use App\Models\Admin\Country;
use App\Models\Admin\Language;
use App\Models\Admin\Plan;
use App\Models\Admin\Title;
use App\Models\Admin\Type;
use Illuminate\Http\Request;

class HomeApiController extends Controller
{
    //
    /**
     * @Function:        <getAuthorList>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <04-12-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Display a listing of the resource.
     * API: 2717
     * @return \Illuminate\Http\Response
     */
    public function getAuthorList( Request $request )
    {
        $author = Author::with('auth_type', 'auth_tag' )->where( [ 'status' => 1 ] );
        if( $request->sort_by && $request->sort_by == "asc" ){
            $author = $author->orderBy( 'name', 'asc' );
        } else if( $request->sort_by && $request->sort_by == "desc" ){
            $author = $author->orderBy( 'name', 'desc' );
        }

        $per_pagination = getConfigurationfield('PER_PAGINATION');
        $author = AuthorResource::collection( $author->paginate( $per_pagination ) );

        return response()->json( ['data' => ['result' => $author ], 'message' => 'The data was successfully retrieved.' ], 200);
    }

    /**
     * @Function:        <getAuthorDetails>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <08-12-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Display a author details of the resource.
     * API: 2743
     * @return \Illuminate\Http\Response
     */
    public function getAuthorDetails( $id )
    {
        return response()->json( ['data' => ['result' => AuthorResource::collection( Author::with('auth_type', 'auth_tag' )->where( [ 'status' => 1, 'id' => $id ] )->get() ) ], 'message' => 'The data was successfully retrieved.' ], 200);
    }

    /**
     * @Function:        <getTypeList>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <04-12-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Display a listing of the resource.
     * API: 2718
     * @return \Illuminate\Http\Response
     */
    public function getTypeList( Request $request )
    {
        $type = Type::where( [ 'status' => 1 ] );
        if( $request->sort_by && $request->sort_by == "asc" ){
            $type = $type->orderBy( 'title', 'asc' );
        } else if( $request->sort_by && $request->sort_by == "desc" ){
            $type = $type->orderBy( 'title', 'desc' );
        }

        $per_pagination = getConfigurationfield('PER_PAGINATION');
        $type = $type->paginate( $per_pagination );

        return response()->json( ['data' => ['result' => $type ], 'message' => 'The data was successfully retrieved.' ], 200);
    }

    /**
     * @Function:        <getLanguageList>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <08-12-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Display a language listing of the resource.
     * API: 2738
     * @return \Illuminate\Http\Response
     */
    public function getLanguageList()
    {
        return response()->json( ['data' => ['result' =>Language::where( [ 'status' => 1 ] )->get() ] ], 200);
    }

    /**
     * @Function:        <getCountryList>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <24-12-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Display a country listing of the resource.
     * API: 27
     * @return \Illuminate\Http\Response
     */
    public function getCountryList()
    {
        return response()->json( ['data' => ['result' =>Country::where( [ 'status' => 1 ] )->get() ] ], 200);
    }

    /**
     * @Function:        <getTitleList>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <08-12-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Display a listing of the resource.
     * API: 2752
     * @return \Illuminate\Http\Response
     */
    public function getTitleList( $pageNo = 0 )
    {
        $per_pagination = getConfigurationfield('PER_PAGINATION');
        $result = Title::with('author_titles', 'country', 'language', 'genre', 'sub_category', 'type', 'tags')->where( [ 'status' => 1 ] )->paginate( $per_pagination );
        // $result = Title::with('author_titles', 'country', 'language', 'genre', 'sub_category', 'type', 'tags')->where( [ 'status' => 1 ] )->skip( $pageNo * (int)$per_pagination )->take( $per_pagination )->get();
        return response()->json( ['data' => ['result' => TitleResource::collection( $result ) ], 'message' => 'The data was successfully retrieved.' ], 200);
    }

    /**
     * @Function:        <getTitleDetails>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <08-12-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Display a author details of the resource.
     * API: 2752
     * @return \Illuminate\Http\Response
     */
    public function getTitleDetails( $id )
    {
        return response()->json( ['data' => ['result' => TitleResource::collection( Title::with('author_titles', 'country', 'language', 'genre', 'sub_category', 'type', 'tags')->where( [ 'status' => 1, 'id' => $id ] )->get() )], 'message' => 'The data was successfully retrieved.' ], 200);
    }

    /**
     * @Function:        <searchTitleAuthor>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <09-12-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Search author with title details of the resource.
     * API: 2733
     * 1: Audio Drama, 2: Audio Book, 3: Podcast
     * @return \Illuminate\Http\Response
     */
    public function searchTitleAuthor( Request $request )
    {
        $requestType = $request->type;

        //get author search data
        $getAuthorArr = Author::where('name', 'LIKE', "%{$request->search}%")->where( ['status' => 1 ] )->get()->pluck('id');
        $titleIds = [];
        foreach( $getAuthorArr as $aid ){
            if( $requestType == 1 ){
                $getAuthorTitleMap = AudioDramaAuthorTitleMap::where( 'author_id', $aid )->pluck( 'title_id' );
            } else {
                $getAuthorTitleMap = AudioBookAuthorTitleMap::where( 'author_id', $aid )->pluck( 'title_id' );
            }

            foreach( $getAuthorTitleMap as $tid ){
                $titleIds[] = $tid;
            }
        }

        $per_pagination = getConfigurationfield('PER_PAGINATION');
        $result = [];
        if( $requestType == 1 ){
            $result = Title::with('genre', 'sub_category', 'type', 'audio_drama_author_titles', 'audio_drama')->where( [ 'status' => 1 ] )->where('title', 'LIKE', "%{$request->search}%")->orWhereIn( 'id', $titleIds )->paginate( $per_pagination );
        } else {
            $result = Title::with('genre', 'sub_category', 'type', 'audio_book_author_titles', 'audio_book')->where( [ 'status' => 1 ] )->where('title', 'LIKE', "%{$request->search}%")->orWhereIn( 'id', $titleIds )->paginate( $per_pagination );
        }
        return response()->json( ['data' => ['result' =>$result ], 'message' => 'The data was successfully retrieved.' ], 200);
    }
}
