@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Subtypes</a> <a href="#" class="current">Add Subtype</a> </div>
            <h1><i class="icon-th"></i>  Subtypes</h1>
        </div>
        <div class="container-fluid"><hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-edit"></i> </span>
                            <h5>Add Type</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" action={{ url('admin/add-subtype') }} name="subtype_add" id="subtype_add" novalidate="novalidate">{{ csrf_field() }}
                                <div class="control-group">
                                    <label class="control-label">Subtype Name</label>
                                    <div class="controls">
                                        <input type="text" name="name" id="name" />
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="Add Subtype" class="btn btn-success">
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