@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Replies</a> <a href="#" class="current">Edit Reply</a> </div>
            <h1><i class="icon-building"></i>  Replies</h1>
        </div>
        <div class="container-fluid"><hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Reply</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" action={{ url('admin/edit-reply/' . $replies->id) }} name="meeting_detail_edit" id="meeting_detail_edit" novalidate="novalidate">{{ csrf_field() }}
                                <div class="control-group">
                                    <label class="control-label">Description</label>
                                    <div class="controls">
                                        <textarea name="reply" id="reply" >{{$replies->reply}}</textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">File</label>
                                    <div class="controls">
                                        <input type="file" name="file_r" id="file_r" value="{{$replies->file_r}}" />
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="Edit Reply" class="btn btn-success">
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