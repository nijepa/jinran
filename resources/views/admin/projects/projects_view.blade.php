@extends('layouts.adminLayout.admin_design')
@section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Projects</a> </div>
            <h1><i class="icon-cogs"></i>  Projects</h1>
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
                            <h5>View Projects</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Type</th>
                                    <th>Company</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($projects)
                                    @foreach($projects as $project)
                                        <tr>
                                            <td>{{$project->id}}</td>
                                            <td>{{$project->type ? $project->type->name : 'Project has no type'}}</td>
                                            <td>{{$project->company ? $project->company->name : 'Project has no company'}}</td>
                                            <td>{{$project->title}}</td>
                                            <td>{{$project->description}}</td>
                                            <td>
                                                @if($project->finished == 1)
                                                    <form method="post" action={{ url('admin/update-project/' . $project->id) }} name="comment_update" id="comment_update" novalidate="novalidate">{{ csrf_field() }}
                                                        <input type="hidden" name="finished" value="0">
                                                        <div class="form-group">
                                                            <input type="submit" value="Finished" class="btn btn-secondary btn-mini">
                                                        </div>
                                                    </form>
                                                @else
                                                    <form method="post" action={{ url('admin/update-project/' . $project->id) }} name="comment_update" id="comment_update" novalidate="novalidate">{{ csrf_field() }}
                                                        <input type="hidden" name="finished" value="1">
                                                        <div class="form-group">
                                                            <input type="submit" value="Active" class="btn btn-primary btn-mini">
                                                        </div>
                                                    </form>
                                                @endif
                                            </td>
                                            <td>{{$project->created_at->diffForHumans()}}</td>
                                            <td>{{$project->updated_at->diffForHumans()}}</td>
                                            <td>
                                                <a href="{{ url('/admin/edit-project/' . $project->id) }}" class="btn btn-primary btn-mini">Edit</a>
                                                <a href="{{ url('/admin/details-project/' . $project->id) }}" class="btn btn-warning btn-mini">Details</a>
                                                <a id="delType" rel="{{ $project->id }}" rel1="delete-project" href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a>
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