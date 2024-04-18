<?php

namespace App\Classes;

use App\Models\FoldersModel;

class Util
{
    public function makePath($parentFolder)
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
