<?php

namespace App\Http\Controllers;

use App\Http\Resources\Resource;
use App\Models\Topics;
use App\Models\Reacts;
use App\Models\Ideas;
use App\Models\Comments;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Resource::collection(Topics::paginate(5));
    }
    public function showSelect()
    {
        $topics = Topics::all();
        return response()->json($topics);
    }
    public function getTopicsId()
    {
        $topicsId = Topics::getId();
        return response()->json($topicsId);
    }
    public function getTopics()
    {
        $dataTopics = Topics::get();
        return response()->json($dataTopics);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showTopicsCreate(Request $request)
    {
        $request->user()->authorizeRoles(['Manager', 'Admin']);
        return Inertia::render('TopicsCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $topics = new Topics();
        $topics->name = $request->input('name');
        $topics->closure_date = $request->input('closure_date');
        $topics->final_closure_date = $request->input('final_closure_date');
        $topics->save();
        return response()->json($topics);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showTopics(Request $request)
    {
        $request->user()->authorizeRoles(['Manager', 'Admin']);
        return Inertia::render('TopicsIndex', 'StaffSubmission');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showTopicsUpdate($id, Request $request)
    {
        $request->user()->authorizeRoles(['Manager', 'Admin']);
        return Inertia::render('TopicsUpdate');
    }

    public function showTopicsShow(Request $request)
    {
        $request->user()->authorizeRoles(['Manager', 'Admin']);
        return Inertia::render('TopicsShow');
    }

    public function inforTopics($id)
    {
        $topics = Topics::with('ideas')->find($id);
        $ideas = $topics->ideas;
        return response()->json(['ideas' => $ideas, 'topics' => $topics]);
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

        $topics = Topics::find($id);
        $topics->update($request->all());
        return response()->json($topics);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topics = Topics::find($id);
        $topics->delete();
        return response()->json(['message' => 'Topic deleted']);
    }
}
