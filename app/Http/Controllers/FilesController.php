<?php

namespace App\Http\Controllers;

use App\Models\FilesModel;
use App\Models\FoldersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function viewFiles($caminho)

    {
        $folder = FoldersModel::where('name','=',$caminho)->first();
        $folders = FoldersModel::where('parent_folder_id','=',$folder->id)->get();
        $files = FilesModel::where('parent_folder_id','=',$folder->id)->get();
        return view('layout/dashboard/dashboard', ['files'=>$files, 'folders'=>$folders]);
    }
    public function newFolder(Request $request)
    {
        $folder = Folders::where('name','=',$request->name)->first();
        if (is_null($folder)){
            $folder = new FoldersModel();
            $folder->name = $request->name;
            $folder->save();

            return response()->json(['success'=>true, 'message'=>'Folder criado']);
        } else {
            return response()->json(['success'=>false, 'message'=>'Esse folder já existe']);
        }
    }
    public function upFiles(Request $request)
    {
        try {
            if (!is_null($request->file('file'))){
                $file = $request->file('file');
                $filename = $file->getClientOriginalName();
                $filetype = $file->getClientMimeType();
                $filepath = $request->fileLocal . $filename;
                Storage::disk('local')->put($filepath, file_get_contents($file));
                $file = new FilesModel();
                $file->name = $filename;
                $file->type = $filetype;
                $file->path = $filepath;
                $file->save();
                return response()->json(['success'=>true, 'message'=>'Arquivo enviado']);
            } else {
                return response()->json(['success'=>false, 'message'=>'Não foi possivel encontrar seus arquivos']);
            }
        }   catch (\Exception $exception){
            return response()->json(['success'=>false, 'message' => 'Erro:' . $exception]);
        }
    }
}
