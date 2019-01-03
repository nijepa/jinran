<?php
namespace App\Http\Controllers;
use App\Meeting_Detail;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Comment;
use App\User;

use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        $post = Meeting_Detail::findOrFail($request->meeting_id);

        $comment = Comment::create([
            'comment' => $request->comment,
            'user_id' => Auth::id(),
            'meeting_id' => $post->id
        ]);

        if ($post->user_id != $comment->user_id) {
            $user = User::find($post->user_id);
            $user->notify(new NewCommentPost($comment));
        }

        return redirect()->route('author.meetings_details', $post->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}