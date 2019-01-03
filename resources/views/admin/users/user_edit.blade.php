@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Users</a> <a href="#" class="current">Edit User</a> </div>
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
        <div class="container-fluid"><hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-edit"></i> </span>
                            <h5>Edit User</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" action={{ url('admin/edit-user/' . $userDetails->id) }} enctype="multipart/form-data" name="user_edit" id="user_edit" novalidate="novalidate">{{ csrf_field() }}
                                <div class="control-group">
                                    <label class="control-label">User Name</label>
                                    <div class="controls">
                                        <input type="text" name="name" id="name" value="{{$userDetails->name}}" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Image</label>
                                    <div class="controls">
                                        <div id="uniform-undefined">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <input name="image" id="image" type="file">
                                                        @if(!empty($userDetails->photo_id))
                                                            <input type="hidden" name="photo_cur" value="{{ $userDetails->photo_id }}">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if(!empty($userDetails->photo_id))
                                                            <img style="width:30px;" src="{{ asset('/images/backend_images/users/'.$userDetails->photo_id) }}"> | <a href="{{ url('/admin/delete-user-image/'.$userDetails->id) }}">Delete</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">E-mail</label>
                                    <div class="controls">
                                        <input type="email" name="email" id="email" value="{{$userDetails->email}}" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Select role</label>
                                    <div class="controls">
                                        <select style="width:220px" name="role_id" id="role_id">
                                            <?php echo $roles_dropdown; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Select company</label>
                                    <div class="controls">
                                        <select style="width:220px" name="company_id" id="company_id">
                                            <?php echo $companies_dropdown; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Password</label>
                                    <div class="controls">
                                        <input type="password" name="password" id="password" value="{{$userDetails->password}}" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Confirm password</label>
                                    <div class="controls">
                                        <input type="password" name="password2" id="password2" value="{{$userDetails->password}}" />
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="Edit User" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.adminLayout.admin_scripts_forms')
@endsection