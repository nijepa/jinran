@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Meetings</a> <a href="#" >Meeting Detail</a> <a href="#" class="current">Comments</a> </div>
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
        <div class="container-fluid"><hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Meeting Detail</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" action={{ url('admin/edit-meeting/' . $meetingDetails->id) }} name="meeting_edit" id="meeting_edit" novalidate="novalidate">{{ csrf_field() }}

                                <div class="control-group">
                                    <label class="control-label">Title</label>
                                    <div class="controls">
                                        <input type="text" disabled ="" name="title" id="title" value="{{$meetingDetails->title}}" />
                                    </div>
                                </div><div class="control-group">
                                    <label class="control-label">Description</label>
                                    <div class="controls">
                                        <textarea disabled ="" name="description" id="description" >{{$meetingDetails->description}}</textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Select Company</label>
                                    <div class="controls">
                                        <select style="width:220px" disabled ="" name="company_id" id="company_id">
                                            <?php echo $companies_dropdown; ?>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-table"></i></span>
                            <h5>Comments</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>User</th>
                                    <th>Comment</th>
                                    <th>File</th>
                                    <th>Replied</th>
                                    <th>Checked</th>
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
                                            <td>{{$comment->reply}}</td>
                                            <td><a href="{{ asset('images/' . $comment->file_r) }}">{{ $comment->file_r  }}</a></td>
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
                                                @if($comment->reply != '')
                                                    <a href="{{ url('/admin/edit-reply/' . $comment->id) }}" class="btn btn-primary btn-mini">Edit</a>
                                                    <a id="delReply" rel="{{ $comment->id }}" rel1="delete-reply" href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a>
                                                @else
                                                    <a href="{{ url('/admin/add-reply/' . $comment->id) }}" class="btn btn-success btn-mini">Add Reply</a>
                                                @endif
                                            </td>
                                        </tr>
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