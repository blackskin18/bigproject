<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Trip;
use Illuminate\Support\Facades\Auth;
use App\Plan;
use App\User;
use App\Follow;
use Validator;
use App\Join;
use App\comment;
use DB;

class CommentController extends Controller
{
    public function postComment(Request $request,$trip_id, $user_id) {
        $comment = new comment;
        $comment->parent_id = null;
        $comment->trip_id = $trip_id;
        $comment->user_id = $user_id;
        $comment->text = $request->data;

        $comment->save();
        $comments = DB::table('comments')
                            ->join('users', 'users.id', '=', 'comments.user_id')
                            ->join('trips', 'trips.id', '=', 'comments.trip_id')
                            ->where('trips.id',$trip_id)
                            ->select('trips.*','users.*','comments.*')
                            ->orderBy('comments.id')
                            ->get();
        $avatar = asset(Auth::user()->avatar);
        // dd(['text' => $request->data, 'avatar' => $avatar]);
        // $data_return = {"text": $request->data, "avatar": $avatar };
        return ['text' => $request->data, 'avatar' => $avatar, 'name'=> Auth::User()->name, 'comment_id' => $comment->id];
    }


    public function postSubComment(Request $request,$trip_id, $user_id,$parent_comment_id) {
        $comment = new comment;
        $comment->parent_id = $parent_comment_id;
        $comment->trip_id = $trip_id;
        $comment->user_id = $user_id;
        $comment->text = $request->data;

        $comment->save();
        $comments = DB::table('comments')
                            ->join('users', 'users.id', '=', 'comments.user_id')
                            ->join('trips', 'trips.id', '=', 'comments.trip_id')
                            ->where('trips.id',$trip_id)
                            ->select('trips.*','users.*','comments.*')
                            ->orderBy('comments.id')
                            ->get();
        return $comments;
    }
}
