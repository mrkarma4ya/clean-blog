<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Facade\FlareClient\Http\Response;

class SearchController extends Controller
{
    //
    public function index(Request $request)
    {
        $posts = Post::where('title', 'LIKE', '%' . $request->search . "%")
                        ->where('status', '1')
                        ->paginate(5);
        
        return view('search.search',['posts'=>$posts]);
    }
    public function search(Request $request)
    {
        
        $data = [];


        if($request->has('q')){
            $search = $request->q;
            $data = Post::where('title', 'LIKE', '%' . $search . "%")
                        ->where('status', '1')
                        ->get();
        }


        return response()->json($data);
    }
}
