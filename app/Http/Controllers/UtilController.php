<?php

namespace App\Http\Controllers;

use App\Classes\Util;
use App\Models\FilesModel;
use App\Models\FoldersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UtilController extends Controller
{
    public function view($id, $viewMode)
    {
        $folder = FoldersModel::where('id','=',$id)->first();
        if ($folder == null){
            $folder = FoldersModel::where('id','=','1')->first();
        }
        $folders = FoldersModel::where('parent_folder_id','=',$folder->id)->where('id','!=','1')->get();
        $files = FilesModel::where('parent_folder_id','=',$folder->id)->get();

        return view('local', ['folder' => $folder, 'files'=>$files, 'folders'=>$folders]);
    }

    public function returnTempLink(Request $request)
    {
        $file = FilesModel::where('id','=', $request->id)->first();
        return Util::displayImage($file->path);
    }

    public function userLogout()
    {
        Auth::logout();
        return redirect('/');
    }
}
