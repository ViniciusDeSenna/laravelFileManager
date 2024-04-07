<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class FilesController extends Controller
{
    public function upFiles(Request $request)
    {
        try {
            dd($request);
        }   catch (Exception $exception){
            return response()->json('erro:' . $exception);
        }
    }
}
