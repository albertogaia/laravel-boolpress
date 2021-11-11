<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class CustomController extends Controller

{
    public function deleteCheckedPosts(Request $request){
        $ids = $request->ids;
        Post::whereIn('id', $ids)->delete();
        return response()->json(['success'=>'Students have been deleted!']);
    }
}
