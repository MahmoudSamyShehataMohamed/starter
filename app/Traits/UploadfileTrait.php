<?php
namespace App\Traits;
Trait UploadfileTrait
{

    function saveFile($file,$folder)
    {

        $filename = time().'.'.$file->extension();


        $path= $folder;

        $file->move(public_path($path), $filename);
        return $filename;

    }

}
