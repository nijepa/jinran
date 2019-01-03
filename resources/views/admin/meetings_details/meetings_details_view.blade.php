@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Meeting Details</a> </div>
            <h1><i class="icon-building"></i>  Meeting Details</h1>
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
                            <form class="form-horizontal" method="post" action="" name="meeting_view" id="meeting_view" novalidate="novalidate">{{ csrf_field() }}
                                <div class="control-group">
                                    <label class="control-label">Date</label>
                                    <div class="controls">
                                        <input type="date" name="date_m" id="date_m" value="{{$meeting->date_m}}" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Title</label>
                                    <div class="controls">
                                        <input type="text" name="title" id="title" value="{{$meeting->title}}" />
                                    </div>
                                </div><div class="control-group">
                                    <label class="control-label">Description</label>
                                    <div class="controls">
                                        <textarea name="description" id="description" >{{$meeting->description}}</textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Select Company</label>
                                    <div class="controls">
                                        <select style="width:220px" name="company_id" id="company_id">
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
                        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                            <h5>View Meeting Details</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Company</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if($meetingDetails)
                                    @foreach($meetingDetails as $meetingD)
                                        <tr>
                                            <td>{{$meetingD->id}}</td>
                                            <td>{{$meetingD->title}}</td>
                                            <td>{{$meetingD->description}}</td>
                                            <td>{{$meetingD->company ? $meetingD->company->name : 'Meeting has no company'}}</td>
                                            <td>{{$meetingD->created_at->diffForHumans()}}</td>
                                            <td>{{$meetingD->updated_at->diffForHumans()}}</td>
                                            <td><a href="{{ url('/admin/view-meetings-detail/' . $meetingD->id) }}" class="btn btn-secondary btn-mini">Details</a>
                                                <a href="{{ url('/admin/edit-meeting/' . $meetingD->id) }}" class="btn btn-primary btn-mini">Edit</a>
                                                <a id="delMeeting" rel="{{ $meetingD->id }}" rel1="delete-meeting" href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a></td>
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