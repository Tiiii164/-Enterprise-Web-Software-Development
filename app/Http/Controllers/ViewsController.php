<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Views;
use App\Models\Ideas;
use Illuminate\Support\Facades\Auth;

class ViewsController extends Controller
{
    public function view($ideasId)
    {
        $ideas = Ideas::find($ideasId);
        if (!$ideas) {
            return response()->json(['message' => 'Idea not found'], 404);
        }

        $user = Auth::user();

        $view = Views::where('ideas_id', $ideasId)
            ->where('user_id', $user->id)
            ->first();

        if (!$view) {
            $view = new Views();
            $view->user_id = $user->id;
            $view->ideas_id = $ideas->id;
            $view->isView = 1;
            $ideas->views_count++;
            $view->save();
            $ideas->save();
        }

        return response()->json(['message' => 'You have viewed this idea!!!']);
    }
}
