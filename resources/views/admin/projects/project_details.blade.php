@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Projects</a> <a href="#" class="current">Project Details</a> </div>
            <h1><i class="icon-cogs"></i>  Project Details</h1>
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
                            <h5>Project</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" action={{ url('admin/edit-meeting/' . $projectDetails->id) }} name="meeting_edit" id="meeting_edit" novalidate="novalidate">{{ csrf_field() }}
                                <div class="control-group">
                                    <label class="control-label">Date</label>
                                    <div class="controls">
                                        <input type="date" disabled ="" name="date_m" id="date_m" value="{{$projectDetails->date_p}}" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Title</label>
                                    <div class="controls">
                                        <input type="text" disabled ="" name="title" id="title" value="{{$projectDetails->title}}" />
                                    </div>
                                </div><div class="control-group">
                                    <label class="control-label">Description</label>
                                    <div class="controls">
                                        <textarea disabled ="" name="description" id="description" >{{$projectDetails->description}}</textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Company</label>
                                    <div class="controls">
                                        <select style="width:220px" disabled ="" name="company_id" id="company_id">
                                            <?php echo $companies_dropdown; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Type</label>
                                    <div class="controls">
                                        <select style="width:220px" disabled ="" name="type_id" id="type_id">
                                            <?php echo $types_dropdown; ?>
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
                            <h5>Project Details</h5>
                        </div>
                        <a href="{{ url('/admin/add-project-detail/' . $projectDetails->id) }}" class="btn btn-success">Add Project Detail</a>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Date</th>
                                    <th>Subtype</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if($projectDet)
                                    @foreach($projectDet as $projectD)
                                        <tr>
                                            <td>{{$projectD->id}}</td>
                                            <td>{{$projectD->date_pd}}</td>
                                            <td>{{$projectD->subtype ? $projectD->subtype->name : 'Project has no subtype'}}</td>
                                            <td>{{$projectD->title}}</td>
                                            <td>{{$stri=str_limit($projectD->description,30)}}</td>
                                            <td>
                                                @if($projectD->finished == 1)
                                                    <form method="post" action={{ url('admin/update-project-detail/' . $projectD->id) }} name="comment_update" id="comment_update" novalidate="novalidate">{{ csrf_field() }}
                                                        <input type="hidden" name="finished" value="0">
                                                        <div class="form-group">
                                                            <input type="submit" value="Finished" class="btn btn-secondary btn-mini">
                                                        </div>
                                                    </form>
                                                @else
                                                    <form method="post" action={{ url('admin/update-project-detail/' . $projectD->id) }} name="comment_update" id="comment_update" novalidate="novalidate">{{ csrf_field() }}
                                                        <input type="hidden" name="finished" value="1">
                                                        <div class="form-group">
                                                            <input type="submit" value="Active" class="btn btn-primary btn-mini">
                                                        </div>
                                                    </form>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#myModal{{$projectD->id}}" data-toggle="modal"class="btn btn-info btn-mini">View</a>
                                                <a href="{{ url('/admin/detail-project-solutions/' . $projectD->id) }}" class="btn btn-warning btn-mini">Tasks</a>
                                                <a href="{{ url('/admin/edit-project-detail/' . $projectD->id) }}" class="btn btn-primary btn-mini">Edit</a>
                                                <a id="delProjectDetail" rel="{{ $projectD->id }}" rel1="delete-project-detail" href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a>
                                            </td>
                                        </tr>
                                        <div id="myModal{{$projectD->id}}" class="modal hide">
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">×</button>
                                                <h3>Project detail: </h3>
                                                <h4>{{$projectD->subtype ? $projectD->subtype->name : 'Meeting has no company'}}</h4>
                                                <a href="{{ url('/admin/pdf-meeting-detail/' . $projectD->id) }}" class="btn btn-inverse">Export to PDF</a>
                                            </div>
                                            <div class="modal-body">
                                                <p>ID: <h5>{{$projectD->id}}</h5></p>
                                                <p>Title: <h5>{{$projectD->title}}</h5></p>
                                                <p>Description: <h5>{{$projectD->description}}</h5></p>
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