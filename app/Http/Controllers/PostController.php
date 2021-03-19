<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post');
    }

    /**
     * Get all exisiting resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $patient_id
     * @return \Illuminate\Http\Response
     */
    public function getPostComments(Request $request, $post_id)
    {
        try
        {
            // set new comment
            $new_comment = array();

            // check for post id
            if(!empty($post_id))
            {
                // get initial comment
                $comments = \App\Models\Comment::where('post_id','=',$post_id)
                ->where('reply_id','=',0)
                ->orderBy('id','DESC')
                ->get()
                ->toArray();

                // count comments
                if(COUNT($comments))
                {
                    // loop comments
                    foreach($comments AS $key=>$comment)
                    {
                        $new_comment[$key]['comment'] = $comment;
                        $new_comment[$key]['comment']['replies'] = $this->getChildComment($comment['post_id'],$comment['id']);
                    }
                }

                // return response
                return \Response::json([
                    'success'=>true,
                    'message'=>'Loaded result successfully!',
                    'result'=>$new_comment
                ],200);
            }

            // return response
            return \Response::json([
                'success'=>false,
                'message'=>'Missing post id!',
                'result'=>$new_comment
            ],400);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try
        {
            // check for post id
            if(!empty($id))
            {
                // check post
                $post = \DB::table('posts')->where('id','=',1)->first();
                if(empty($post))
                {
                    // return response
                    return \Response::json([
                        'success'=>false,
                        'message'=>'Post did not exists!',
                        'result'=>[]
                    ],400);
                }

                // return response
                return \Response::json([
                    'success'=>true,
                    'message'=>'Loaded result successfully!',
                    'result'=>$post
                ],200);
            }

            // return response
            return \Response::json([
                'success'=>false,
                'message'=>'Missing id!',
                'result'=>[]
            ],400);
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

    // get child comment
    private function getChildComment($post_id=0,$reply_id=0)
    {
        // set new comment
        $new_comment = array();

        // check post id and parent id
        if(!empty($post_id)&&!empty($reply_id))
        {
            // get comment
            $comments = \App\Models\Comment::where('post_id','=',$post_id)
            ->where('reply_id','=',$reply_id)
            ->orderBy('id','DESC')
            ->get()
            ->toArray();

            // count comment
            if(COUNT($comments))
            {
                // loop comments
                foreach($comments AS $key=>$comment)
                {
                    $new_comment[$key]['comment'] = $comment;
                    $new_comment[$key]['comment']['replies'] = $this->getChildComment($comment['post_id'],$comment['id']);
                }
            }

            // return new comment
            return $new_comment;
        }
    }
}
