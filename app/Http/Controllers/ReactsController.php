<?php

namespace App\Http\Controllers;

use App\Models\Reacts;
use App\Models\Ideas;
use Illuminate\Support\Facades\Auth;

class ReactsController extends Controller
{
    public function like($ideasId)
    {
        $ideas = Ideas::find($ideasId);
        if (!$ideas) {
            return response()->json(['message' => 'Idea not found'], 404);
        }

        $user = Auth::user();
        $react = Reacts::where('ideas_id', $ideasId)
            ->where('users_id', $user->id)
            ->first();

        if ($react) {
            // Check if the user already disliked the idea
            if ($react->like == 1) {
                $react->like = 0;
                $ideas->likes_count--;
            } else {
                $react->like = 1;
                $ideas->likes_count++;
                if ($react->dislike == 1) {
                    $ideas->dislikes_count--;
                    $react->dislike = 0;
                }
            }
            $react->save();
            $ideas->save();
        } else {
            // Create a new react for the user and idea
            $react = new Reacts();
            $react->ideas_id = $ideas->id;
            $react->users_id = $user->id;
            $react->like = 1;
            $ideas->likes_count++;
            $react->save();
            $ideas->save();
        }

        return response()->json(['message' => 'Reacted successfully']);
    }

    public function dislike($ideasId)
    {
        $ideas = Ideas::find($ideasId);
        if (!$ideas) {
            return response()->json(['message' => 'Idea not found'], 404);
        }

        $user = Auth::user();
        $react = Reacts::where('ideas_id', $ideasId)
            ->where('users_id', $user->id)
            ->first();

        if ($react) {
            // Check if the user already liked the idea
            if ($react->dislike == 1) {
                $react->dislike = 0;
                $ideas->dislikes_count--;
            } else {
                $react->dislike = 1;
                $ideas->dislikes_count++;
                if ($react->like == 1) {
                    $ideas->likes_count--;
                    $react->like = 0;
                }
            }
            $react->save();
            $ideas->save();
        } else {
            // Create a new react for the user and idea
            $react = new Reacts();
            $react->ideas_id = $ideas->id;
            $react->users_id = $user->id;
            $react->dislike = 1;
            $ideas->dislikes_count++;
            $react->save();
            $ideas->save();
        }
        return response()->json(['message' => 'Reacted successfully']);
    }
}
