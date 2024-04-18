<?php

namespace App\Http\Controllers;

use App\Classes\Util;
use App\Models\FilesModel;
use App\Models\FoldersModel;
use Illuminate\Http\Request;

class UtilController extends Controller
{
    public function view($id, $viewMode)
    {
        $folder = FoldersModel::where('id','=',$id)->first();
        $folders = FoldersModel::where('parent_folder_id','=',$folder->id)->where('name','!=','local')->get();
        $files = FilesModel::where('parent_folder_id','=',$folder->id)->get();

        return view('local', ['folder' => $folder, 'files'=>$files, 'folders'=>$folders]);
    }

    public function returnTempLink($path)
    {
        return Util::displayImage($path);
    }
}
