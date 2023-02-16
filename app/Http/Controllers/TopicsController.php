<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\models\Topics;
use App\Http\Requests\TopicsValidationRequest;

class TopicsController extends Controller
{
    public function index()
    {
        $topics = Topics::all();
        return view('topics.index', [
            'topics' => $topics,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //insert new topics
        $topics = Topics::all();
        return view('topics.create', [
            'topics' => $topics,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',

            'closure_date' => 'required',
            'final_closure_date' => 'required'
        ]);

        $topisc = Topics::create([
            'name' => $request->input('name'),
            'closure_date' => $request->input('closure_date'),
            'final_closure_date' => $request->input('final_closure_date')
        ]);
        //save to Database
        $topisc->save();
        return redirect('/topics');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //like "show details"
    {
        //dd('This is show, id = '.$id);
        $topics = Topics::find($id);
        //$closure_date = $topics->closure_date();
        $closure_date = Topics::find($topics->closure_date);
        //dd($category);
        $final_closure_date = Topics::find($topics->final_closure_date);

        return view('topics.show')->with('topics', $topics);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $topics = Topics::find($id);
        return view('topics.edit', [
            'topics' => $topics,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TopicsValidationRequest $request, $id)
    {
        $request->validated();
        $topics = Topics::where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'closure_date' => $request->input('closure_date'),
                'final_closure_date' => $request->input('final_closure_date'),
            ]);
        return redirect('/topics');
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
        //dd($id);
        return redirect('/topics');
    }
}
