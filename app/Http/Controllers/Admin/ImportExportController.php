<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExportUser;
use App\Http\Controllers\Controller;
use App\Imports\ImportUser;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class ImportExportController extends Controller
{
    public function importView(Request $request){
        return view('admin.importexcel.importFile');
    }

    public function import(Request $request){
        (new \Maatwebsite\Excel\Excel)->import(new ImportUser(),
            $request->file('file')->store('files'));
        return redirect()->back();
    }

    public function exportUsers(Request $request){
        return (new \Maatwebsite\Excel\Excel)->download(new ExportUser(), 'users.xlsx');
    }
}
