<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Folders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function viewFiles($caminho)

<<<<<<< Updated upstream
    public function viewFiles($caminho)
=======
>>>>>>> Stashed changes
    {
        $folder = Folders::where('name','=',$caminho)->first();
        $folders = Folders::where('parent_folder_id','=',$folder->id)->get();
        $files = Files::where('parent_folder_id','=',$folder->id)->get();
        dd($folder);
        return view('dashboard', ['files'=>$files, 'folders'=>$folders]);
    }
    public function newFolder(Request $request)
    {
        $folder = Folders::where('name','=',$request->name)->first();
        if (is_null($folder)){
            $folder = new Folders();
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
                $file = new Files();
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
