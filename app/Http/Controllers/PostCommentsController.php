<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Meeting_Detail;
use App\Post;
use App\Solution;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class PostCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $comments = Comment::all();


        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();

        $user = Auth::user();

        $comment = new Comment;
        $comment->user_id = $user->id;
        if($file = $request->file('file')){
            $name = time() . $file->getClientOriginalName();
            $file->move('/images/backend_images/comments/', $name);
            $comment->file = $name;
        }
        $comment->meeting_detail_id = $data['meeting_id'];
        $comment->comment = $data['comment'];
        $comment->save();

  /**      $data = [
            'user_id'=> $user->id,
            'meeting_id' => $request->meeting_id,
            'comment'=> $request->comment
        ];
        Comment::create($data);
**/
        $request->session()->flash('comment_message','Your message has been submitted and is waiting moderation');

        return redirect()->back();





    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //



        $post = Meeting_Detail::findOrFail($id);

        $comments = $post->comments;


        return view('admin.comments.show', compact('comments'));



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = $request->all();
        Solution::where(['id'=>$id])->update(['finished'=>$data['finished']]);
        return redirect()->back();
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
        //
        //Comment::findOrFail($id)->update($request->all());
        $data = $request->all();
        Comment::where(['id'=>$id])->update(['checked'=>$data['checked']]);
        return redirect()->back();
    }

    public function updates(Request $request, $id)
    {
        //
        //Comment::findOrFail($id)->update($request->all());
        $data = $request->all();
        Solution::where(['id'=>$id])->update(['finished'=>$data['finished']]);
        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        Comment::findOrFail($id)->delete();

        return redirect()->back();


    }
}
