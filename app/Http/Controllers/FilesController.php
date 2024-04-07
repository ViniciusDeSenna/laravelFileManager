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
    public function upFiles(Request $request)
    {
        try {
            if (!is_null($request->file('file'))){
                $file = $request->file('file');
                $filename = $file->getClientOriginalName();
                $filetype = $file->getClientMimeType();

                Storage::disk('local')->put('teste/' . $filename, file_get_contents($file));

                $file = new Files();
                $file->name = $filename;
                $file->type = $filetype;
                $file->path = 'teste';
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
