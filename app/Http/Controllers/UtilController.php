<?php

namespace App\Http\Controllers;

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
    private function gerarCaminho($parentFolder)
    {
        $parentOfParentFolder = FoldersModel::where('parent_folder_id','=',$parentFolder)->first();
        for ($i = $parentOfParentFolder->parent_folder_id; $i != 0; $i = $parentOfParentFolder->parent_folder_id){
            $folder = FoldersModel::where('id','=',$i)->first();
            $folders[] = $folder->name;
            $folders = array_reverse($folders);
            $parentOfParentFolder->parent_folder_id--;
        }
        array_push($folders, $parentOfParentFolder->name);
        $caminho = implode('/', $folders);
        if ($caminho == 'local/local'){
            $caminho = 'local';
        }
        return $caminho;
    }
}
