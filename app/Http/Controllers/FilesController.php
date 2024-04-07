<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;
use function Webmozart\Assert\Tests\StaticAnalysis\false;
use function Webmozart\Assert\Tests\StaticAnalysis\true;

class FilesController extends Controller
{

    public function viewFiles()
    {
        return view('welcome');
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
