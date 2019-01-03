@extends('layouts.adminLayout.admin_design')
@section('content')

    <!--main-container-part-->
    <div id="content">
        <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
        </div>
        <!--End-breadcrumbs-->

        <!--Action boxes-->
        <div class="container-fluid">
            <div class="quick-actions_homepage">
                <ul class="quick-actions">
                    <li class="bg_lv span4"> <a href="{{ url('admin/view-meetings') }}"> <i class="icon-briefcase"></i><span class="label label-success">{{$metCount}}</span> Meetings</a> </li>
                    <li class="bg_ly span2">
                        <div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-warning dropdown-toggle"> ŠIFARNICI <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li class="bg_ly span2"> <a href="{{ url('admin/view-companies') }}"> <i class="icon-screenshot"></i> <span class="label label-success">{{$compCount}}</span> Companies </a> </li>
                                <li class="bg_ly span2"><a href="{{ url('admin/view-categories') }}"> <i class="icon-th-list"></i><span class="label label-success">{{$catCount}}</span> Categories</a></li>
                                <li class="bg_ly span2"> <a href="{{ url('admin/view-cities') }}"> <i class="icon-building"></i><span class="label label-success">{{$citCount}}</span> Cities</a> </li>
                                <li class="bg_ly span2"> <a href="{{ url('admin/view-countries') }}"> <i class="icon-globe"></i><span class="label label-success">{{$couCount}}</span> Countries </a> </li>
                                <li class="bg_ly span2"> <a href="{{ url('admin/view-types') }}"> <i class="icon-th-large"></i><span class="label label-success">{{$couCount}}</span> Types </a> </li>
                                <li class="bg_ly span2"> <a href="{{ url('admin/view-subtypes') }}"> <i class="icon-th"></i><span class="label label-success">{{$couCount}}</span> Subtypes </a> </li>
                            </ul>
                        </div>
                    </li>
                    <li class="bg_lg span4"> <a href="{{ url('admin/view-users') }}"> <i class="icon-user"></i> <span class="label label-success">{{$useCount}}</span> Users</a> </li>
                    <li class="bg_lh span4"> <a href="{{ url('admin/view-documents') }}"> <i class="icon-file"></i> Documents</a> </li>
                    <li class="bg_ls span4"> <a href="{{ url('admin/view-comment') }}"> <i class="icon-comments"></i><span class="label label-success">{{$comCount}}</span> Comments</a> </li>
                    <li class="bg_lb span2"> <a href="{{ url('admin/view-reply') }}"> <i class="icon-comments-alt"></i><span class="label label-success">{{$repCount}}</span> Replies</a> </li>
                    <li class="bg_lo span4"> <a href="{{ url('admin/view-projects') }}"> <i class="icon-cogs"></i><span class="label label-success">{{$proCount}}</span> Projects</a> </li>
                    <li class="bg_lr span4"> <a href="{{ url('admin/view-solutions') }}"> <i class="icon-wrench"></i><span class="label label-success">{{$solCount}}</span> Tasks</a> </li>
                </ul>
            </div>
            <!--End-Action boxes-->

            <!--Projects-box-->
            <div class="row-fluid">
                <div class="widget-box">
                    <div class="widget-title bg_lg"><span class="icon"><i class="icon-cogs"></i></span>
                        <h5>Active Projects</h5>
                    </div>
                    <div class="widget-content" >
                        <div class="row-fluid">
                            <div class="span9">
                                <table class="table table-bordered data-table">
                                    <thead>
                                    <tr>
                                        <th> </th>
                                        <th>Company</th>
                                        <th>Date</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($projects)
                                        @foreach($projects as $project)
                                            <tr>
                                                <td> <img width="40" height="40" alt="User" src="{{ asset('images/backend_images/demo/project.png') }}"> </td>
                                                <td>{{$project->company ? $project->company->name : 'Meeting has no company'}}</td>
                                                <td>{{$project->date_p}}</td>
                                                <td>{{$project->title}}</td>
                                                <td>{{$stri=str_limit($project->description,20)}}</td>
                                                <td>
                                                    <a href="#myModal{{$project->id}}" data-toggle="modal"class="btn btn-info btn-mini">View</a>
                                                    <a href="{{ url('/admin/details-project/' . $project->id) }}" class="btn btn-warning btn-mini">Details</a>
                                                </td>
                                            </tr>

                                            <div id="myModal{{$project->id}}" class="modal hide">
                                                <div class="modal-header">
                                                    <button data-dismiss="modal" class="close" type="button">×</button>
                                                    <h3>Project with: </h3>
                                                    <h4>{{$project->company ? $project->company->name : 'Meeting has no company'}}</h4>
                                                    <a align="right" href="{{ url('/admin/pdf-meeting/' . $project->id) }}" class="btn btn-inverse">Export to PDF</a>
                                                </div>
                                                <div class="modal-body">
                                                    <p>ID: <h5>{{$project->id}}</h5></p>
                                                    <p>Date:<h5>{{$project->date_p}}</h5></p>
                                                    <p>Title: <h5>{{$project->title}}</h5></p>
                                                    <p>Description: <h5>{{$project->description}}</h5></p>
                                                    <p>Created: <h5>{{$project->created_at->diffForHumans()}}</h5></p>
                                                    <p>Updated: <h5>{{$project->updated_at->diffForHumans()}}</h5></p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="span3">
                                <ul class="site-stats">
                                    <li class="bg_lh"><a href="{{ url('admin/view-projects') }}"><i class="icon-cogs"></i> <strong>{{$proCount}}</strong> <small>All Projects</small></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End-Projects-box-->

            <div class="row-fluid">
                <div class="span12">
                    <!--Solutions-box-->
                    <div class="widget-box">
                        <div class="widget-title bg_ly" data-toggle="collapse" href="#collapseG3"><span class="icon"><i class="icon-chevron-down"></i></span>
                            <h5>Active Tasks</h5>
                        </div>
                        <div class="widget-content nopadding collapse in" id="collapseG3">
                            <ul class="recent-posts">
                                @foreach($solutions as $solution)
                                    <li>
                                        <div class="user-thumb"> <img width="40" height="40" alt="User" src="{{ asset('images/backend_images/demo/solution.png') }}"> </div>
                                        <div class="article-post"> <span class="user-info"> By: {{$solution->user->name}} / Date: {{$solution->created_at}}  </span>
                                            <p><a href="{{ url('/admin/detail-project-solutions/' . $solution->project_detail_id) }}">Comment: {{$solution->description}}  / File: {{$solution->file}}</a> </p>
                                        </div>
                                    </li>
                                @endforeach
                                <li>
                                    <a href="{{ url('admin/view-solutions') }}"><button class="btn btn-warning btn-mini">View All</button></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--End-Solutions-box-->
                </div>
            </div>

            <!--Meetings-box-->
            <div class="row-fluid">
                <div class="widget-box">
                    <div class="widget-title bg_lg"><span class="icon"><i class="icon-briefcase"></i></span>
                        <h5>Active Meetings</h5>
                    </div>
                    <div class="widget-content" >
                        <div class="row-fluid">
                            <div class="span9">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th> </th>
                                    <th>Company</th>
                                    <th>Date</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($meetings)
                                    @foreach($meetings as $meeting)
                                        <tr>
                                            <td> <img width="40" height="40" alt="User" src="{{ asset('images/backend_images/demo/meeting.png') }}"> </td>
                                            <td>{{$meeting->company ? $meeting->company->name : 'Meeting has no company'}}</td>
                                            <td>{{$meeting->date_m}}</td>
                                            <td>{{$meeting->title}}</td>
                                            <td>{{$stri=str_limit($meeting->description,20)}}</td>
                                            <td>
                                                <a href="#myModal{{$meeting->id}}" data-toggle="modal"class="btn btn-info btn-mini">View</a>
                                                <a href="{{ url('/admin/details-meeting/' . $meeting->id) }}" class="btn btn-warning btn-mini">Details</a>
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
                            <div class="span3">
                                <ul class="site-stats">
                                    <li class="bg_lh"><a href="{{ url('admin/view-meetings') }}"><i class="icon-briefcase"></i> <strong>{{$metCount}}</strong> <small>All Meetings</small></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End-Meetings-box-->
            <hr/>
            <div class="row-fluid">
                <div class="span6">
                    <!--Comments-box-->
                    <div class="widget-box">
                        <div class="widget-title bg_ly" data-toggle="collapse" href="#collapseG2"><span class="icon"><i class="icon-chevron-down"></i></span>
                            <h5>Active Comments</h5>
                        </div>
                        <div class="widget-content nopadding collapse in" id="collapseG2">
                            <ul class="recent-posts">
                                @foreach($comments as $comment)
                                <li>
                                    <div class="user-thumb"> <img width="40" height="40" alt="User" src="{{ asset('images/backend_images/demo/comment.png') }}"> </div>
                                    <div class="article-post"> <span class="user-info"> By: {{$comment->user->name}} / Date: {{$comment->created_at}}  </span>
                                        <p><a href="{{ url('/admin/detail-meeting-comments/' . $comment->meeting_id) }}">Comment: {{$comment->comment}}  / File: {{$comment->file}}</a> </p>
                                    </div>
                                </li>
                                @endforeach
                                <li>
                                    <a href="{{ url('admin/view-comment') }}"><button class="btn btn-warning btn-mini">View All</button></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--End-Comments-box-->
                    <!--Users-box-->
                    <div class="widget-box">
                        <div class="widget-title bg_lo"  data-toggle="collapse" href="#collapseG3" > <span class="icon"> <i class="icon-chevron-down"></i> </span>
                            <h5>Unregistered Users</h5>
                        </div>
                        <div class="widget-content nopadding updates collapse in" id="collapseG3">
                            <div class="new-update clearfix">
                                <a href="{{ url('admin/view-users') }}"><button class="btn btn-warning btn-mini">View All</button></a>
                            </div>
                            @foreach($users as $user)
                            <div class="new-update clearfix"><i class="icon-ok-sign"></i>
                                <div class="user-thumb"> <img width="40" height="40" alt="User" src="{{ asset('images/backend_images/demo/user.png') }}"> </div>
                                <div class="update-done"><a title="" href="{{ url('/admin/edit-user/' . $user->id) }}"><strong>Name: {{$user->name}}</strong></a> <span>E-mail: {{$user->email}}</span> </div>
                                <div class="update-date"><span class="update-day">{{date('M', strtotime($user->created_at))}}</span>{{date('d-y', strtotime($user->created_at))}}</div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!--End-Users-box-->
                </div>
                <div class="span6">
                    <!--Replies-box-->
                    <div class="widget-box">
                        <div class="widget-title bg_ly" data-toggle="collapse" href="#collapseG4"><span class="icon"><i class="icon-chevron-down"></i></span>
                            <h5>Latest 5 Replies</h5>
                        </div>
                        <div class="widget-content nopadding collapse in" id="collapseG4">
                            <ul class="recent-posts">
                                @foreach($replies as $reply)
                                    <li>
                                        <div class="user-thumb"> <img width="40" height="40" alt="User" src="{{ asset('images/backend_images/demo/reply.png') }}"> </div>
                                        <div class="article-post"> <span class="user-info"> By: {{$reply->user->name}} / Date: {{$reply->created_at}}  </span>
                                            <p><a href="{{ url('/admin/detail-meeting-comments/' . $reply->meeting_id) }}">Comment: {{$reply->reply}}  / File: {{$reply->file_r}}</a> </p>
                                        </div>
                                    </li>
                                @endforeach
                                <li>
                                    <a href="{{ url('admin/view-reply') }}"><button class="btn btn-warning btn-mini">View All</button></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--End-Replies-box-->
                    <!--Companies-box-->
                    <div class="widget-box">
                        <div class="widget-title"><span class="icon"><i class="icon-screenshot"></i></span>
                            <h5>Companies</h5>
                        </div>
                        <div class="widget-content nopadding fix_hgt">
                            <ul class="recent-posts">
                                <li>
                                    <a href="{{ url('admin/view-companies') }}"><button class="btn btn-warning btn-mini">View All</button></a>
                                </li>
                                @foreach($companies as $company)
                                <li>
                                    <div class="user-thumb"> <img width="40" height="40" alt="User" src="{{ asset('images/backend_images/demo/company.png') }}"> </div>
                                    <div class="article-post"><a href="{{ url('/admin/edit-company/' . $company->id) }}"> <span class="user-info">{{$company->name}}</span></a>
                                        <p>{{$company->address}}</p>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!--End-Companies-box-->
                </div>
            </div>
        </div>
    </div>

    <!--end-main-container-part-->
    @include('layouts.adminLayout.admin_scripts_dashboard')
@endsection