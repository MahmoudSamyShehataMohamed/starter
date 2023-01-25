<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestFile extends Controller
{

    public function file1()
    {
        return view('testfile');
    }

    public function file2(Request $request)
    {
        $request->validate([
            //'file' => 'required|mimes:jpeg,jpg,png',
        ]);


        $fileName = time().'.'.$request->file->extension();

        $request->file->move(public_path('uploads'), $fileName);

        return back()
            ->with('success','You have successfully upload file.')
            ->with('file',$fileName);

    }
}
