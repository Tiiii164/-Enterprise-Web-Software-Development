<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Comments;
use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{

    public function store(Request $request, Comments $comments, $ideas_id)
    {
        $comments = new Comments();
        $comments->text = $request->input('text');
        $comments->users_id = Auth::user()->id;
        $comments->ideas_id = $ideas_id;
        //$comments->ideas_id = Comments::where('users_id', Auth::user()->id)->value('ideas_id');

        //$comments->ideas_id = Comments::where('ideas_id');
        //$comments->ideas_id = Comments::ideas()->id;
        //$comments->ideas_id = request()->route('ideas_id');
        // if (isset($request->ideas_id)) {
        //     $comments->ideas_id = $request->ideas_id;
        // } else {
        //     $comments->ideas_id = request()->route('ideas_id');
        // }
    
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'text' => 'required|string',
    //         'ideas_id' => 'required|integer',
    //     ]);

    //     $comments = new Comments();
    //     $comments->text = $validatedData['text'];
    //     $comments->user_id = Auth::user()->id;
    //     $comments->ideas_id = $validatedData['ideas_id'];
    //     $comments->save();

    //     return response()->json($comments);
    // }
}
