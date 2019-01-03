@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Types</a> <a href="#" class="current">Edit Type</a> </div>
            <h1><i class="icon-th-large"></i>  Types</h1>
        </div>
        <div class="container-fluid"><hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-edit"></i> </span>
                            <h5>Edit Type</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" action={{ url('admin/edit-type/' . $typeDetails->id) }} name="type_edit" id="type_edit" novalidate="novalidate">{{ csrf_field() }}
                                <div class="control-group">
                                    <label class="control-label">Type Name</label>
                                    <div class="controls">
                                        <input type="text" name="name" id="name" value="{{$typeDetails->name}}" />
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="Edit Type" class="btn btn-success">
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