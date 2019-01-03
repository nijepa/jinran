@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Users</a> </div>
            <h1><i class="icon-user"></i>  Users</h1>
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
                            <h5>View Users</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>E-mail</th>
                                    <th>Company</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if($users)
                                    @foreach($users as $user)
                                        <tr class="gradeX">
                                            <td class="center">{{$user->id}}</td>
                                            <td class="center">
                                                @if(!empty($user->photo_id))
                                                    <img src="{{ asset('/images/backend_images/users/'.$user->photo_id) }}" style="width:50px;">
                                                @endif
                                            </td>
                                            <td class="center">{{$user->name}}</td>
                                            <td class="center">{{$user->email}}</td>
                                            <td>{{$user->company ? $user->company->name : 'User has no company'}}</td>
                                            <td>{{$user->role ? $user->role->name : 'User has no role'}}</td>
                                            <td>{{$user->is_active == 1 ? 'Active' : 'Not Active'}}</td>
                                            <td class="center">{{$user->created_at->diffForHumans()}}</td>
                                            <td class="center">{{$user->updated_at->diffForHumans()}}</td>
                                            <td class="center">
                                                <a href="{{ url('/admin/edit-user/' . $user->id) }}" class="btn btn-primary btn-mini">Edit</a>
                                                <a id="delUser" rel="{{ $user->id }}" rel1="delete-user" href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a>
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