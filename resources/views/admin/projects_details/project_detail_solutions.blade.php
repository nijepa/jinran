@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Project</a> <a href="#" >Project Detail</a> <a href="#" class="current">Tasks</a> </div>
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
        <div class="container-fluid"><hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Project Detail</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" action={{ url('admin/edit-project-detail/' . $projectDetails->id) }} name="project_detail_edit" id="project_detail_edit" novalidate="novalidate">{{ csrf_field() }}
                                <div class="control-group">
                                    <label class="control-label">Date</label>
                                    <div class="controls">
                                        <input type="date" disabled ="" name="date_pd" id="date_pd" value="{{$projectDetails->date_pd}}" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Title</label>
                                    <div class="controls">
                                        <input type="text" disabled ="" name="title" id="title" value="{{$projectDetails->title}}" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Description</label>
                                    <div class="controls">
                                        <textarea disabled ="" name="description" id="description" >{{$projectDetails->description}}</textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Subtype</label>
                                    <div class="controls">
                                        <select style="width:220px" disabled ="" name="subtype_id" id="subtype_id">
                                            <?php echo $subtypes_dropdown; ?>
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
                            <h5>Tasks</h5>
                        </div>
                        <a href="{{ url('/admin/add-solution/' . $projectDetails->id) }}" class="btn btn-success">Add Task</a>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>Id</th>
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
                                            <td>{{$solution->user->name}}</td>
                                            <td>{{$solution->description}}</td>
                                            <td><a href="{{ asset('images/' . $solution->file) }}">{{ $solution->file  }}</a></td>
                                            <td>
                                                @if($solution->finished == 1)
                                                    <form method="post" action={{ url('admin/update-solution/' . $solution->id) }} name="solution_update" id="solution_update" novalidate="novalidate">{{ csrf_field() }}
                                                        <input type="hidden" name="finished" value="0">
                                                        <div class="form-group">
                                                            <input type="submit" value="YES" class="btn btn-info btn-mini">
                                                        </div>
                                                    </form>
                                                @else
                                                    <form method="post" action={{ url('admin/update-solution/' . $solution->id) }} name="solution_update" id="solution_update" novalidate="novalidate">{{ csrf_field() }}
                                                        <input type="hidden" name="finished" value="1">
                                                        <div class="form-group">
                                                            <input type="submit" value="NO" class="btn btn-warning btn-mini">
                                                        </div>
                                                    </form>
                                                @endif
                                            </td>
                                            <td>
                                                @if($solution->is_admin == 1)
                                                    <a href="{{ url('/admin/edit-solution/' . $solution->id) }}" class="btn btn-primary btn-mini">Edit</a>
                                                    <a id="delSolution" rel="{{ $solution->id }}" rel1="delete-solution" href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a>
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