@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Replies</a> </div>
            <h1><i class="icon-comments-alt"></i>  Replies</h1>
            @if(Session::has('flash_message_error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! session('flash_message_error') !!}</strong>
                </div>
            @endif
            @if(Session::has('flash_message_success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! session('flash_message_success') !!}</strong>
                </div>
            @endif
        </div>
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                            <h5>View Reply</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>User</th>
                                    <th>Reply</th>
                                    <th>File</th>
                                    <th>User Checked</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if($comments)
                                    @foreach($comments as $comment)
                                        <tr>
                                            <td>{{$comment->id}}</td>
                                            <td>{{date('d-M-y', strtotime($comment->created_at))}}</td>
                                            <td>{{$comment->user->name}}</td>
                                            <td>{{$comment->reply }}</td>
                                            <td><a href="{{ asset('images/' . $comment->file_r) }}">{{ $comment->file_r }}</a></td>
                                            <td>
                                                @if($comment->reply )
                                                    @if($comment->checked == 1)
                                                        <p style="color:blue">Checked</p>
                                                    @else
                                                        <p style="color:red">Not Checked</p>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#myModal{{ $comment->comment_id }}" data-toggle="modal" class="btn btn-info btn-mini">View Comment</a>
                                                <a href="#myMod{{ $comment->meeting_id }}" data-toggle="modal" class="btn btn-warning btn-mini">View Meeting</a>
                                                <a href="{{ url('/admin/detail-meeting-comments/' . $comment->meeting_id) }}" class="btn btn-outline-secondary btn-mini">Go to Meeting</a>
                                                <a href="{{ url('/admin/edit-reply/' . $comment->id) }}" class="btn btn-primary btn-mini">Edit</a>
                                                <a id="delMeeting" rel="{{ $comment->id }}" rel1="delete-reply" href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a>
                                            </td>
                                        </tr>
                                        @foreach($comment_detail as $commentD)
                                            <div id="myModal{{$commentD->id}}" class="modal hide">
                                                <div class="modal-header">
                                                    <button data-dismiss="modal" class="close" type="button">×</button>
                                                    <h3>Comment: </h3>
                                                    <h4>{{$commentD->id}}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>ID: <h5>{{$commentD->id}}</h5></p>
                                                    <p>Comment: <h5>{{$commentD->comment}}</h5></p>
                                                    <p>File: <h5>{{$commentD->file}}</h5></p>
                                                    <p>Created: <h5>{{$commentD->created_at->diffForHumans()}}</h5></p>
                                                    <p>Updated: <h5>{{$commentD->updated_at->diffForHumans()}}</h5></p>
                                                </div>
                                            </div>
                                        @endforeach
                                        @foreach($meeting_detail as $meetingD)
                                            <div id="myMod{{$meetingD->id}}" class="modal hide">
                                                <div class="modal-header">
                                                    <button data-dismiss="modal" class="close" type="button">×</button>
                                                    <h3>Meeting with: </h3>
                                                    <h4>{{$meetingD->company ? $meetingD->company->name : 'Meeting has no company'}}</h4>

                                                </div>
                                                <div class="modal-body">
                                                    <p>ID: <h5>{{$meetingD->id}}</h5></p>
                                                    <p>Title: <h5>{{$meetingD->title}}</h5></p>
                                                    <p>Description: <h5>{{$meetingD->description}}</h5></p>
                                                    <p>Created: <h5>{{$meetingD->created_at->diffForHumans()}}</h5></p>
                                                    <p>Updated: <h5>{{$meetingD->updated_at->diffForHumans()}}</h5></p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @include('layouts.adminLayout.admin_scripts_tables')
@endsection