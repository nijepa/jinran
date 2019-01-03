@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Documents</a> </div>
            <h1><i class="icon-file"></i>  Documents</h1>
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
                        <div class="widget-title"> <span class="icon"><i class="icon-table"></i></span>
                            <h5>View Documents</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>User</th>
                                    <th>Comment</th>
                                    <th>File</th>
                                    <th>Reply</th>
                                    <th>File</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($documents)
                                    @foreach($documents as $document)
                                        <tr>
                                            <td>{{$document->id}}</td>
                                            <td>{{$document->user->name}}</td>
                                            <td>{{$document->comment}}</td>
                                            <td><a href="{{ asset('images/' . $document->file) }}">{{$document->file}}</a></td>
                                            <td>{{$document->reply}}</td>
                                            <td><a href="{{ asset('images/' . $document->file_r) }}">{{$document->file_r}}</a></td>
                                            <td>{{$document->created_at->diffForHumans()}}</td>
                                            <td>
                                                <a id="delDocument" rel="{{ $document->id }}" rel1="delete-document" href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a>
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