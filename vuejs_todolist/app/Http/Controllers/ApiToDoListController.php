<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiTodoListController extends Controller
{
    public function getList()
    {
        $result = DB::table('todolists');

        if (request('search')) {
            $result->where("content", "like", "%" . request('search') . "%");
        }
        
        $result = $result->orderBy('id', 'desc')->get();
        return response()->json($result);
    }

    public function getRead($id)
    {
        $row = DB::table('todolists')->where("id", $id)->first();
        return response()->json($row);
    }

    public function postCreate()
    {
        $content = request('content');
        DB::table('todolists')
            ->insert([
                'created_at' => date('Y-m-d H:i:s'),
                'content' => $content
            ]);
        return response()->json(['status' => true, 'message' => 'Data berhasil ditambahkan']);
    }

    public function postUpdate($id)
    {
        $content = request('content');
        DB::table('todolists')
            ->where('id', $id)
            ->update([
                'updated_at' => date('Y-m-d H:i:s'),
                'content' => $content
            ]);
        return response()->json(['status' => true, 'message' => 'Data berhasil diupdate']);
    }

    public function postDelete($id)
    {
        DB::table('todolists')
            ->where('id', $id)
            ->delete();
        return response()->json(['status' => true, 'message' => 'Data berhasil dihapus']);
    }
}