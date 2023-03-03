<?php

namespace App\Http\Controllers;

use App\Models\Ideas;
use App\Models\Topics;
use App\Models\Views;
use App\Models\Comments;
use App\Models\Categories;
use Illuminate\Http\Request;
use Inertia\Inertia;

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
        $ideas->save();
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
}
