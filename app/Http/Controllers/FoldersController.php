<?php

namespace App\Http\Controllers;

use App\Models\FoldersModel;
use Illuminate\Http\Request;
use Mockery\Exception;

class FoldersController extends Controller
{
    public function newFolder(Request $request)
    {
        try {
            $folder = FoldersModel::where('name','=',$request->name)->first();
            if (is_null($folder)){
                $folder = new FoldersModel();
                $folder->name = $request->name;
                $folder->parent_folder_id = $request->parent_folder;
                $folder->save();

                return response()->json(['success'=>true, 'message'=>'Folder criado com sucesso!']);
            } else {
                return response()->json(['success'=>false, 'message'=>'Esse folder já existe']);
            }
        }
        catch (Exception $exception){
            return response()->json(['success'=>false, 'message'=>'Erro: ' . $exception->getMessage()]);
        }
    }
    public function favoriteFolder(Request $request)
    {}
    public function downloadFolder(Request $request)
    {

    }
    public function deleteFolder(Request $request)
    {}
    public function renameFolder(Request $request)
    {}
}
