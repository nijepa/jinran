@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Comments</a> </div>
            <h1><i class="icon-comments"></i>  Comments</h1>
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
                            <h5>View Comment</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>User</th>
                                    <th>Comment</th>
                                    <th>File</th>
                                    <th>Replied</th>
                                    <th>Checked</th>
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
                                            <td>{{$comment->comment}}</td>
                                            <td><a href="{{ asset('images/' . $comment->file) }}">{{ $comment->file  }}</a></td>
                                            <td>
                                                @if($comment->reply != '')

                                                @else
                                                    @if($comment->reply_id != 0)
                                                        YES {{$comment->reply_id}}
                                                    @else
                                                        NO
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                @if($comment->comment )
                                                    @if($comment->checked_a == 1)
                                                        <form method="post" action={{ url('admin/update-comment/' . $comment->id) }} name="comment_update" id="comment_update" novalidate="novalidate">{{ csrf_field() }}
                                                            <input type="hidden" name="checked_a" value="0">
                                                            <div class="form-group">
                                                                <input type="submit" value="Un-Check" class="btn btn-secondary btn-mini">
                                                            </div>
                                                        </form>
                                                    @else
                                                        <form method="post" action={{ url('admin/update-comment/' . $comment->id) }} name="comment_update" id="comment_update" novalidate="novalidate">{{ csrf_field() }}
                                                            <input type="hidden" name="checked_a" value="1">
                                                            <div class="form-group">
                                                                <input type="submit" value="Check" class="btn btn-primary btn-mini">
                                                            </div>
                                                        </form>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                @if($comment->reply != '')
                                                    <a href="#myModal{{$comment->meeting_id}}" data-toggle="modal" class="btn btn-info btn-mini">View</a>
                                                    <a href="{{ url('/admin/details-comment/' . $comment->id) }}" class="btn btn-warning btn-mini">Details</a>
                                                    <a href="{{ url('/admin/edit-meeting/' . $comment->id) }}" class="btn btn-primary btn-mini">Edit</a>
                                                    <a id="delMeeting" rel="{{ $comment->id }}" rel1="delete-meeting" href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a>
                                                @else
                                                    <a href="#myModal{{ $comment->meeting_detail_id }}" data-toggle="modal" class="btn btn-info btn-mini">View Meeting</a>
                                                    @if($comment->reply_id != 0)
                                                        <a href="#myMod{{ $comment->reply_id }}" data-toggle="modal" class="btn btn-warning btn-mini">View Reply</a>
                                                    @else
                                                        <a href="{{ url('/admin/add-reply/' . $comment->id) }}" class="btn btn-success btn-mini">Add Reply</a>
                                                    @endif
                                                    <a href="{{ url('/admin/detail-meeting-comments/' . $comment->meeting_detail_id) }}" class="btn btn-outline-secondary btn-mini">Go to Meeting</a>
                                                    <a id="delComment" rel="{{ $comment->id }}" rel1="delete-comment" href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a>
                                                @endif
                                            </td>
                                        </tr>
                                        @foreach($meeting_detail as $meetingD)
                                            <div id="myModal{{$meetingD->id}}" class="modal hide">
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
                                        @foreach($comment_detail as $commentD)
                                            <div id="myMod{{$commentD->id}}" class="modal hide">
                                                <div class="modal-header">
                                                    <button data-dismiss="modal" class="close" type="button">×</button>
                                                    <h3>Reply: </h3>

                                                </div>
                                                <div class="modal-body">
                                                    <p>ID: <h5>{{$commentD->id}}</h5></p>
                                                    <p>Reply: <h5>{{$commentD->reply}}</h5></p>
                                                    <p>File: <h5>{{$commentD->file_r}}</h5></p>
                                                    <p>Created: <h5>{{$commentD->created_at->diffForHumans()}}</h5></p>
                                                    <p>Updated: <h5>{{$commentD->updated_at->diffForHumans()}}</h5></p>
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