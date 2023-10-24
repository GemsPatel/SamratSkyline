<?php

namespace App\Http\Controllers;

use App\Models\Admin\Categories;
use App\Models\Admin\Tags;
use Illuminate\Http\Request;

class TypeaheadController extends Controller
{
      /**
       * Undocumented function
       *
       * @return void
       */
      public function index()
      {

      }

      /**
       * @Function:        <__construct>
       * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
       * @Created On:      <10-12-2021>
       * @Last Modified By:Gautam Kakadiya
       * @Last Modified:   Gautam Kakadiya
       * @Description:     <This function work for auto search title list.>
       * @return void
       */
      public function autocompleteBlogTagSearch(Request $request)
      {
            $filterResult = Tags::where('title', 'LIKE', '%'. $request->get('query'). '%');
            $filterResult = $filterResult->get();
            return response()->json($filterResult);
      }

      /**
       * @Function:        <__construct>
       * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
       * @Created On:      <11-12-2021>
       * @Last Modified By:Gautam Kakadiya
       * @Last Modified:   Gautam Kakadiya
       * @Description:     <This function work for auto search genre list.>
       * @return void
       */
      public function autocompleteCategorySearch(Request $request, $parent_id=0, $type=2)
      {
            $query = $request->get('query');
            $parents = explode( '-', $parent_id );
            $filterResult = Categories::where('title', 'LIKE', '%'. $query. '%')->where( ['status' => 1, 'level' => $type ])->whereIn( 'parent_id', $parents )->get();//'parent_id' => $parent_id,
            return response()->json($filterResult);
      }
}
