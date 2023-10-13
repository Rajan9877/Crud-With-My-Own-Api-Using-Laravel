<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function fileUpload(Request $req){
        $result = $req->file('file')->store('public/uploads');
        return ["Success" => "File Uploaded Successful."];
    }
}
