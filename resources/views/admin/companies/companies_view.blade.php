@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Companies</a> </div>
            <h1><i class="icon-screenshot"></i>  Companies</h1>
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
                            <h5>View Companies</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Logo</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Phone</th>
                                    <th>Mobile</th>
                                    <th>E-mail</th>
                                    <th>Web-site</th>
                                    <th>Category</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if($companies)
                                    @foreach($companies as $company)
                                        <tr>
                                            <td>{{$company->id}}</td>
                                            <td class="center">
                                                @if(!empty($company->photo_id))
                                                    <img src="{{ asset('/images/backend_images/companies/'.$company->photo_id) }}" style="width:50px;">
                                                @endif
                                            </td>
                                            <td>{{$company->name}}</td>
                                            <td>{{$company->address}}</td>
                                            <td>{{$company->city ? $company->city->name : 'Company has no city'}}</td>
                                            <td>{{$company->phone}}</td>
                                            <td>{{$company->mobile}}</td>
                                            <td>{{$company->email}}</td>
                                            <td>{{$company->website}}</td>
                                            <td>{{$company->category ? $company->category->name : 'Company has no category'}}</td>
                                            <td style="width:130px">
                                                <a href="#myModal{{$company->id}}" data-toggle="modal"class="btn btn-info btn-mini">View</a>
                                                <a href="{{ url('/admin/edit-company/' . $company->id) }}" class="btn btn-primary btn-mini">Edit</a>
                                                <a id="delCompany" rel="{{ $company->id }}" rel1="delete-company" href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a>
                                            </td>
                                        </tr>
                                        <div id="myModal{{$company->id}}" class="modal hide">
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">×</button>
                                                <h3>Company: {{$company->name}}</h3>
                                            </div>
                                            <div class="modal-body">
                                                <p>ID: {{$company->id}}</p>
                                                <p>Address: {{$company->address}}</p>
                                                <p>City: {{$company->city ? $company->city->name : 'Company has no city'}}</p>
                                                <p>Phone: {{$company->phone}}</p>
                                                <p>Mobile: {{$company->mobile}}</p>
                                                <p>E-mail: {{$company->email}}</p>
                                                <p>Web site: {{$company->website}}</p>
                                                <p>Category: {{$company->category ? $company->category->name : 'Company has no category'}}</p>
                                                <p>Created: {{$company->created_at->diffForHumans()}}</p>
                                                <p>Updated: {{$company->updated_at->diffForHumans()}}</p>
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