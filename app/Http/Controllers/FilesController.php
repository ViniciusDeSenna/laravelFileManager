<?php

namespace App\Http\Controllers;

use App\Models\FilesModel;
use App\Models\FoldersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

class FilesController extends Controller
{
    public function viewFiles($id)
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
        return $caminho;
    }
    public function newFolder(Request $request)
    {
        try {
            $folder = FoldersModel::where('name','=',$request->name)->first();
            if (is_null($folder)){
                $folder = new FoldersModel();
                $folder->name = $request->name;
                $folder->parent_folder_id = $request->parent_folder;
                $folder->save();

                return response()->json(['success'=>true, 'message'=>'Folder criado']);
            } else {
                return response()->json(['success'=>false, 'message'=>'Esse folder já existe']);
            }
        }   catch (Exception $exception){
            return response()->json(['success'=>false, 'message'=>'Erro: ' . $exception->getMessage()]);
        }
    }
    public function upFiles(Request $request)
    {
        try {
            if (!is_null($request->file('file'))){
                $caminho = $this->gerarCaminho($request->fileLocal);

                //Pega os dados do arquivo
                $file = $request->file('file');
                $filename = $file->getClientOriginalName();
                $filetype = $file->getClientMimeType();
                $filepath = $caminho . '/' . $filename;

                //Salva no storage
                Storage::disk('local')->put($filepath, file_get_contents($file));


                //Salva o caminho e os dados no banco
                $file = new FilesModel();
                $file->name = $filename;
                $file->type = $filetype;
                $file->path = $filepath;
                $file->parent_folder_id = $request->fileLocal;
                $file->save();
                return response()->json(['success'=>true, 'message'=>'Arquivo enviado']);
            } else {
                return response()->json(['success'=>false, 'message'=>'Não foi possivel encontrar seus arquivos']);
            }
        }   catch (\Exception $exception){
            return response()->json(['success'=>false, 'message' => 'Erro:' . $exception->getMessage()]);
        }
    }
}
