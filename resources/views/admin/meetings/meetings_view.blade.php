@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Meetings</a> </div>
            <h1><i class="icon-briefcase"></i>  Meetings</h1>
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
                            <h5>View Meeting</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>Company</th>
                                    <th>Date</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if($meetings)
                                    @foreach($meetings as $meeting)
                                        <tr>
                                            <td>{{$meeting->company ? $meeting->company->name : 'Meeting has no company'}}</td>
                                            <td>{{$meeting->date_m}}</td>
                                            <td>{{$meeting->title}}</td>
                                            <td>{{$stri=str_limit($meeting->description,20)}}</td>
                                            <td>
                                                @if($meeting->finished == 1)
                                                    <form method="post" action={{ url('admin/update-meeting/' . $meeting->id) }} name="comment_update" id="comment_update" novalidate="novalidate">{{ csrf_field() }}
                                                        <input type="hidden" name="finished" value="0">
                                                        <div class="form-group">
                                                            <input type="submit" value="Finished" class="btn btn-secondary btn-mini">
                                                        </div>
                                                    </form>
                                                @else
                                                    <form method="post" action={{ url('admin/update-meeting/' . $meeting->id) }} name="comment_update" id="comment_update" novalidate="novalidate">{{ csrf_field() }}
                                                        <input type="hidden" name="finished" value="1">
                                                        <div class="form-group">
                                                            <input type="submit" value="Active" class="btn btn-primary btn-mini">
                                                        </div>
                                                    </form>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#myModal{{$meeting->id}}" data-toggle="modal"class="btn btn-info btn-mini">View</a>
                                                <a href="{{ url('/admin/details-meeting/' . $meeting->id) }}" class="btn btn-warning btn-mini">Details</a>
                                                <a href="{{ url('/admin/edit-meeting/' . $meeting->id) }}" class="btn btn-primary btn-mini">Edit</a>
                                                <a id="delMeeting" rel="{{ $meeting->id }}" rel1="delete-meeting" href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a>
                                            </td>
                                        </tr>

                                        <div id="myModal{{$meeting->id}}" class="modal hide">
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">×</button>
                                                <h3>Meeting with: </h3>
                                                <h4>{{$meeting->company ? $meeting->company->name : 'Meeting has no company'}}</h4>
                                                <a align="right" href="{{ url('/admin/pdf-meeting/' . $meeting->id) }}" class="btn btn-inverse">Export to PDF</a>
                                            </div>
                                            <div class="modal-body">
                                                <p>ID: <h5>{{$meeting->id}}</h5></p>
                                                <p>Date:<h5>{{$meeting->date_m}}</h5></p>
                                                <p>Title: <h5>{{$meeting->title}}</h5></p>
                                                <p>Description: <h5>{{$meeting->description}}</h5></p>
                                                <p>Created: <h5>{{$meeting->created_at->diffForHumans()}}</h5></p>
                                                <p>Updated: <h5>{{$meeting->updated_at->diffForHumans()}}</h5></p>
                                            </div>
                                        </div>

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