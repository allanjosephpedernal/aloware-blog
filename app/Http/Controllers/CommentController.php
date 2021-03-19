<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            // get errors
            $errors = static::validateRequest(
                \Validator::make($request->all(), [
                    'post_id'=>'required|int',
                    'username'=>'required',
                    'content'=>'required'
                ])
            );

            // count errors
            if (count($errors) > 0)
            {
                // return response
                return \Response::json([
                    'success'=>false,
                    'message'=> 'Missing required fields',
                    'result'=>$errors
                ],400);
            }

            // extract all
            extract($request->all());

            // optional
            $reply_id = (isset($reply_id) ? $reply_id : 0);

            // new comment
            $comment = new \App\Models\Comment;
            $comment->username = $username;
            $comment->post_id = $post_id;
            $comment->reply_id = $reply_id;
            $comment->content = $content;
            $comment->save();

            // return response
            return \Response::json([
                'success'=>true,
                'message' => 'Comment is successfully added!',
                'result'=>$comment
            ],201);
        }
        catch(\Exception $e)
        {
            return \Response::json([
                'success'=>false,
                'message'=>$e->getMessage(),
                'result'=>[]
            ],500);
        }
    }
}
