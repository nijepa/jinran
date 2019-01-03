@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Replies</a> <a href="#" class="current">Add Reply</a> </div>
            <h1><i class="icon-building"></i>  Replies</h1>
        </div>

        <div class="container-fluid"><hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Comment</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" action={{ url('admin/add-reply/' . $comment->id) }} name="meeting_edit" id="meeting_edit" novalidate="novalidate">{{ csrf_field() }}
                                <div class="control-group">
                                    <label class="control-label">User</label>
                                    <div class="controls">
                                        <input type="text" disabled ="" name="date_m" id="date_m" value="{{$comment->user->name}}" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Comment</label>
                                    <div class="controls">
                                        <textarea disabled ="" name="description" id="description" >{{$comment->comment}}</textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">File</label>
                                    <div class="controls">
                                        <input type="text" disabled ="" name="title" id="title" value="{{$comment->file}}" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid"><hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Reply</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" action={{ url('admin/add-reply/' . $comment->id) }} name="reply_add" id="reply_add" enctype="multipart/form-data" novalidate="novalidate">{{ csrf_field() }}
                                <div class="control-group">
                                    <label class="control-label">Reply</label>
                                    <div class="controls">
                                        <textarea name="reply" id="reply" ></textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">File</label>
                                    <div class="controls">
                                        <input type="file" name="file" id="file" />
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="Add Reply" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.adminLayout.admin_scripts_forms')
@endsection
<script src="{{ asset('js/frontend_js/dropzone.js') }}"></script>