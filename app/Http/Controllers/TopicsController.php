<?php



// class TopicsController extends Controller
// {
//     public function index()
//     {
//         $topics = Topics::all();
//         return view('topics.index', [
//             'topics' => $topics,
//         ]);
//     }

//     /**
//      * Show the form for creating a new resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function create()
//     {
//         //insert new topics
//         $topics = Topics::all();
//         return view('topics.create', [
//             'topics' => $topics,
//         ]);
//     }

//     /**
//      * Store a newly created resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\Response
//      */
//     public function store(Request $request)
//     {

//         $request->validate([
//             'id' => 'required',
//             'name' => 'required',
//             'closure_date' => 'required',
//             'final_closure_date' => 'required'
//         ]);

//         $topisc = Topics::create([
//             'id' => $request->input('id'),
//             'name' => $request->input('name'),
//             'closure_date' => $request->input('closure_date'),
//             'final_closure_date' => $request->input('final_closure_date')
//         ]);
//         //save to Database
//         $topisc->save();
//         return redirect('/topics');
//     }

//     /**
//      * Display the specified resource.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function show($id) //like "show details"
//     {
//         //dd('This is show, id = '.$id);
//         $topics = Topics::find($id);
//         //$closure_date = $topics->closure_date();
//         $closure_date = Topics::find($topics->closure_date);
//         //dd($category);
//         $final_closure_date = Topics::find($topics->final_closure_date);

//         return view('topics.show')->with('topics', $topics);
//     }

//     /**
//      * Show the form for editing the specified resource.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function edit($id)
//     {
//         // $topics = Topics::find($id);
//         // return view('topics.edit', [
//         //     'topics' => $topics,
//         // ]);
//         $topics = Topics::all();
//         return response()->json($topics);
//     }

//     /**
//      * Update the specified resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function update(TopicsValidationRequest $request, $id)
//     {
//         $request->validated();
//         $topics = Topics::where('id', $id)
//             ->update([
//                 'id' => $request->input('id'),
//                 'name' => $request->input('name'),
//                 'closure_date' => $request->input('closure_date'),
//                 'final_closure_date' => $request->input('final_closure_date'),
//             ]);
//         return redirect('/topics');
//     }

//     /**
//      * Remove the specified resource from storage.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function destroy($id)
//     {
//         $topics = Topics::find($id);
//         $topics->delete();
//         //dd($id);
//         return redirect('/topics');
//     }
// }


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
