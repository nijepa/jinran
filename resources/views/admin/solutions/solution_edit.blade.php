@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Solutions</a> <a href="#" class="current">Edit Solution</a> </div>
            <h1><i class="icon-wrench"></i>  Solutions</h1>
        </div>
        <div class="container-fluid"><hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-edit"></i> </span>
                            <h5>Edit Solution</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" action={{ url('admin/edit-solution/' . $solutions->id) }} enctype="multipart/form-data" name="solution_edit" id="solution_edit" novalidate="novalidate">{{ csrf_field() }}
                                <div class="control-group">
                                    <label class="control-label">Date</label>
                                    <div class="controls">
                                        <input type="date" name="date_s" id="date_s" value="{{$solutions->date_s}}" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Description</label>
                                    <div class="controls">
                                        <textarea name="description" id="description" >{{$solutions->description}}</textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">File</label>
                                    <div class="controls">
                                        <div id="uniform-undefined">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <input name="file" id="file" type="file">
                                                        @if(!empty($solutions->file))
                                                            <input type="hidden" name="photo_cur" value="{{ $solutions->file }}">
                                                            <a href="{{ asset('images/backend_images/solutions/' . $solutions->file) }}">{{ $solutions->file  }}</a> | <a href="{{ url('/admin/delete-solution-file/'.$solutions->id) }}">Delete</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <input type="submit" value="Edit Solution" class="btn btn-success">
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