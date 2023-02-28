<?php
namespace App\Http\Controllers;

use App\Models\Topics;
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
        $topics = Topics::all();
        return response()->json($topics);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showTopicsCreate()
    {
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
    public function showTopics()
    {
        return Inertia::render('TopicsIndex');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showTopicsUpdate($id)
    {
        return Inertia::render('TopicsUpdate');
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
