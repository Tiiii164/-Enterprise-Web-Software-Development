<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\models\Comments;
use app\models\Ideas;
use app\models\Users;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function store(Request $request, Ideas $ideas)
    {
        // $validatedData = $request->validate([
        //     'text' => 'required|string',
        // ]);

        // $comments = new Comments();
        // $comments->text = $validatedData['text'];
        // $comments->users_id = Auth::id();
        // $ideas->comments()->save($comments);

        // $ideas->increment('comments_count');

        // return response()->json($comments);
    }
}
