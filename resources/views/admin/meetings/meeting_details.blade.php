@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Meetings</a> <a href="#" class="current">Meeting Details</a> </div>
            <h1><i class="icon-briefcase"></i>  Meeting Details</h1>
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
                            <h5>Meeting</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" action={{ url('admin/edit-meeting/' . $meetingDetails->id) }} name="meeting_edit" id="meeting_edit" novalidate="novalidate">{{ csrf_field() }}
                                <div class="control-group">
                                    <label class="control-label">Date</label>
                                    <div class="controls">
                                        <input type="date" disabled ="" name="date_m" id="date_m" value="{{$meetingDetails->date_m}}" />
                                    </div>
                                </div>
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
                                    <label class="control-label">Company</label>
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
                            <h5>Meeting Details</h5>
                        </div>
                        <a href="{{ url('/admin/add-meeting-detail/' . $meetingDetails->id) }}" class="btn btn-success">Add Meeting Detail</a>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Company</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if($meetingDet)
                                    @foreach($meetingDet as $meetingD)
                                        <tr>
                                            <td>{{$meetingD->id}}</td>
                                            <td>{{$meetingD->title}}</td>
                                            <td>{{$meetingD->company ? $meetingD->company->name : 'Meeting has no company'}}</td>
                                            <td>{{$stri=str_limit($meetingD->description,30)}}</td>
                                            <td>
                                                <a href="#myModal{{$meetingD->id}}" data-toggle="modal"class="btn btn-info btn-mini">View</a>
                                                <a href="{{ url('/admin/detail-meeting-comments/' . $meetingD->id) }}" class="btn btn-warning btn-mini">Comments</a>
                                                <a href="{{ url('/admin/edit-meeting-detail/' . $meetingD->id) }}" class="btn btn-primary btn-mini">Edit</a>
                                                <a id="delMeetingDetail" rel="{{ $meetingD->id }}" rel1="delete-meeting-detail" href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a>
                                            </td>
                                        </tr>

                                        <div id="myModal{{$meetingD->id}}" class="modal hide">
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">×</button>
                                                <h3>Meeting with: </h3>
                                                <h4>{{$meetingD->company ? $meetingD->company->name : 'Meeting has no company'}}</h4>
                                                <a href="{{ url('/admin/pdf-meeting-detail/' . $meetingD->id) }}" class="btn btn-inverse">Export to PDF</a>
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