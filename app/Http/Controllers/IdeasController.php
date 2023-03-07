<?php

namespace App\Http\Controllers;

use App\Models\Ideas;
use App\Models\Topics;
use App\Models\Reacts;
use App\Models\Views;
use App\Models\Comments;
use App\Models\Categories;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class IdeasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ideas = Ideas::with('topics')->get();
        $topics = Topics::all();
        return response()->json(['ideas' => $ideas, 'topics' => $topics]);
        // $ideas = Ideas::all();
        // return response()->json($ideas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showIdeasCreate()
    {
        return Inertia::render('IdeasCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ideas = new Ideas();
        $ideas->title = $request->input('title');
        $ideas->text = $request->input('text');
        $ideas->file_path = $request->input('file_path');
        $ideas->categories_id = $request->input('categories_id');
        $ideas->topics_id = $request->input('topics_id');
        $ideas->users_id = Auth::user()->id;
        $ideas->save();

        //Create a new comment for the idea
        // $comments = new Comments();
        // $comments->text = $request->input('comments_text');
        // $comments->user_id = Auth::user()->id;
        // $ideas->comments()->save($comments);

        return response()->json($ideas);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showIdeas()
    {
        return Inertia::render('IdeasIndex');
    }
    public function showIdeasShow()
    {
        return Inertia::render('IdeasShow');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showIdeasUpdate()
    {
        return Inertia::render('IdeasUpdate');
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $ideas = Ideas::find($id);
        $ideas->update($request->all());
        return response()->json($ideas);
    }


    public function inforIdeas($id)
    {
        $ideas = Ideas::with('comments', 'topics', 'categories', 'views')->find($id);
        $comments = $ideas->comments;
        $topics = $ideas->topics;
        $categories = $ideas->categories;
        $views = $ideas->views;
        return response()->json(['ideas' => $ideas, 'topics' => $topics, 'categories' => $categories, 'views' => $views, 'comments' => $comments]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ideas = Ideas::find($id);
        $ideas->delete();
        return response()->json(['message' => 'Idea deleted']);
    }
    // public function storeLike(Request $request)
    // {
    //     $user_id = Auth::id();
    //     $idea_id = $request->input('idea_id');
    //     $react = $request->input('react');

    //     // check if the user has already reacted to this idea
    //     $existing_react = Reacts::where('user_id', $user_id)
    //         ->where('idea_id', $idea_id)
    //         ->first();

    //     if ($existing_react) {
    //         // user has already reacted, update the react
    //         $existing_react->like = $react == 'like' ? 1 : 0;
    //         $existing_react->dislike = $react == 'dislike' ? 1 : 0;
    //         $existing_react->save();
    //     } else {
    //         // create a new react
    //         $react = new Reacts();
    //         $react->user_id = $user_id;
    //         $react->idea_id = $idea_id;
    //         $react->like = $react == 'like' ? 1 : 0;
    //         $react->dislike = $react == 'dislike' ? 1 : 0;
    //         $react->save();
    //     }

    //     // get the number of likes and dislikes for this idea
    //     $likes = Reacts::where('idea_id', $idea_id)->where('like', 1)->count();
    //     $dislikes = Reacts::where('idea_id', $idea_id)->where('dislike', 1)->count();

    //     // return the likes and dislikes count
    //     return response()->json([
    //         'likes' => $likes,
    //         'dislikes' => $dislikes,
    //     ]);
    // }
}
