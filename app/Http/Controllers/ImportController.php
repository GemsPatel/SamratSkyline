<?php

namespace App\Http\Controllers;

use App\Imports\GenreDataImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.import.index');
    }

    /**
     * @Function:        <__construct>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <02-12-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for import genre related data.>
     * @return void
     */
    public function importGenreExcel(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'file' => 'required|mimes:xlsx'
        ]);

        if ($validator->fails()) {
            return redirect('admin/import')->with('error', $validator->errors()->messages()['file'][0]);
        }
        
        $import = new GenreDataImport();
        $import->onlySheets('Type', 'Genre', 'Sub Genre', 'Title');
        Excel::import( $import, $request->file('file') );
        return redirect('admin/import')->with('success', 'Imported Successfully.');
    }
}
