<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Exports\ExportUsers;
use App\Imports\ImportUsers;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
class DataTableController extends Controller
{
     public function importExport()
    {
       return view('pages.excel.import');
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new ExportUsers(), 'users.xlsx');
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request) 
    {
    $this->validate($request,['file'=>'required|mimes:xls,xlsx']);
        Excel::import(new ImportUsers(), request()->file('file'));
        return back();

    }




}
