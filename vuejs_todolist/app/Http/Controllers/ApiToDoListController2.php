<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiToDoListController extends Controller
{
    public function getList(){
        $result = DB::table('todolist');
        if (\request('search')){
            $result->where('content', 'like', '%', request('search').'%');
        }
        $result= $result->orderBy('id', 'desc')->get();
        return response()->json($result);
    }

    public function postCreate(){
        $content = request('content');
        DB::table('todolist')
        ->insert([
            'created_at' => date('Y-m-d H:i:s'),
            'content' => $content
        ]);
        return response()->json(['status'=>true, 'message' => 'Data berhasil ditambahkan']);
    }

    public function postUpdate($id){
        $content = request('content');
        DB::table('todolist')
        ->where('id', $id)
        ->update([
            'updated_at' => date('Y-m-d H:i:s'),
            'content' => $content
        ]);
        return response()->json(['status'=>true, 'message' => 'Data berhasil diupdate']);

    }

    public function getDelete($id){
        DB::table('todolist')
        ->where($id)
        ->delete();
        return response()->json(['status'=>true, 'message' => 'Data berhasil dihapus']);
    }

    public function getRead($id){
        $row = DB::table('todolist')->where('id', $id)->first();
        return response()->json($row);

    }
}
