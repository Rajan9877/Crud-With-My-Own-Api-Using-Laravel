<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DataController extends Controller
{
    public function Fetch(){
        $data = User::all();
        return $data;
    }
    public function FetchThroughId(Request $req){
        // echo $req->id;
        $data = User::find($req->id);
        return $data;
    }
    public function Create(Request $req){
        $newdata = new User;
        $newdata->name = $req->name;
        $newdata->email = $req->email;
        $newdata->password = $req->password;
        $newdata->save();
        return ["Success" => "Data Inserted Successful."];
    }
    public function Update(Request $req){
        $editid = User::find($req->id);
        $editid->name = $req->name;
        $editid->email= $req->email;
        $editid->save();
        return ["Success" => "Data Updation Successful."];
    }
    public function Delete(Request $req){
        $deleteid = User::find($req->id);
        $deleteid->delete();
        return ["Success" => "Data Deletion Successful."];
    }
    public function Search(Request $req){
        $searchdata = User::where('name', 'LIKE', '%'.$req->search.'%')
                         ->orWhere('email', 'LIKE', '%'.$req->search.'%')
                         ->get();
        return $searchdata;
    }
    
}
