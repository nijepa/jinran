@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tasks</a> </div>
            <h1><i class="icon-wrench"></i>  Tasks</h1>
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
                            <h5>View Task</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>User</th>
                                    <th>Description</th>
                                    <th>File</th>
                                    <th>Finished</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($solutions)
                                    @foreach($solutions as $solution)
                                        <tr>
                                            <td>{{$solution->id}}</td>
                                            <td>{{date('d-M-y', strtotime($solution->date_s))}}</td>
                                            <td>{{$solution->user->name}}</td>
                                            <td>{{$solution->description}}</td>
                                            <td><a href="{{ asset('images/backend_images/solutions/' . $solution->file) }}">{{ $solution->file  }}</a></td>
                                            <td>
                                                @if($solution->finished == 1)
                                                    <form method="post" action={{ url('admin/update-solution/' . $solution->id) }} name="comment_update" id="comment_update" novalidate="novalidate">{{ csrf_field() }}
                                                        <input type="hidden" name="finished" value="0">
                                                        <div class="form-group">
                                                            <input type="submit" value="YES" class="btn btn-info btn-mini">
                                                        </div>
                                                    </form>
                                                @else
                                                    <form method="post" action={{ url('admin/update-solution/' . $solution->id) }} name="comment_update" id="comment_update" novalidate="novalidate">{{ csrf_field() }}
                                                        <input type="hidden" name="finished" value="1">
                                                        <div class="form-group">
                                                            <input type="submit" value="NO" class="btn btn-warning btn-mini">
                                                        </div>
                                                    </form>
                                                @endif
                                            </td>
                                            <td>
                                                @if($solution->is_admin == 0)
                                                    <a href="#myModal{{$solution->project_detail_id}}" data-toggle="modal" class="btn btn-info btn-mini">View Project</a>
                                                    <a href="#myMod{{ $solution->id }}" data-toggle="modal" class="btn btn-warning btn-mini">View Task</a>
                                                    <a href="{{ url('/admin/detail-project-solutions/' . $solution->project_detail_id) }}" class="btn btn-outline-secondary btn-mini">Go to Project</a>
                                                @else
                                                    <a href="#myModal{{ $solution->project_detail_id }}" data-toggle="modal" class="btn btn-info btn-mini">View Project</a>
                                                    <a href="#myMod{{ $solution->id }}" data-toggle="modal" class="btn btn-warning btn-mini">View Task</a>
                                                    <a href="{{ url('/admin/detail-project-solutions/' . $solution->project_detail_id) }}" class="btn btn-outline-secondary btn-mini">Go to Project</a>
                                                    <a href="{{ url('/admin/edit-solution/' . $solution->id) }}" class="btn btn-primary btn-mini">Edit</a>
                                                    <a id="delComment" rel="{{ $solution->id }}" rel1="delete-comment" href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a>
                                                @endif
                                            </td>
                                        </tr>
                                        @foreach($project as $projectD)
                                            <div id="myModal{{$projectD->id}}" class="modal hide">
                                                <div class="modal-header">
                                                    <button data-dismiss="modal" class="close" type="button">×</button>
                                                    <h3>Project detail subtype : </h3>
                                                    <h4>{{$projectD->subtype ? $projectD->subtype->name : 'Project detail has no subtype'}}</h4>

                                                </div>
                                                <div class="modal-body">
                                                    <p>ID: <h5>{{$projectD->id}}</h5></p>
                                                    <p>Date: <h5>{{$projectD->date_pd}}</h5></p>
                                                    <p>Title: <h5>{{$projectD->title}}</h5></p>
                                                    <p>Description: <h5>{{$projectD->description}}</h5></p>
                                                    <p>Created: <h5>{{$projectD->created_at->diffForHumans()}}</h5></p>
                                                    <p>Updated: <h5>{{$projectD->updated_at->diffForHumans()}}</h5></p>
                                                </div>
                                            </div>
                                        @endforeach

                                            <div id="myMod{{$solution->id}}" class="modal hide">
                                                <div class="modal-header">
                                                    <button data-dismiss="modal" class="close" type="button">×</button>
                                                    <h3>Task : </h3>
                                                </div>
                                                <div class="modal-body">
                                                    <p>ID: <h5>{{$solution->id}}</h5></p>
                                                    <p>Date: <h5>{{$solution->date_s}}</h5></p>
                                                    <p>Description: <h5>{{$solution->description}}</h5></p>
                                                    <p>Created: <h5>{{$projectD->created_at->diffForHumans()}}</h5></p>
                                                    <p>Updated: <h5>{{$projectD->updated_at->diffForHumans()}}</h5></p>
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