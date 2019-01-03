@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Project Details</a> <a href="#" class="current">Edit Project Detail</a> </div>
            <h1><i class="icon-cog"></i>  Project Details</h1>
        </div>
        <div class="container-fluid"><hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-edit"></i> </span>
                            <h5>Edit Project Detail</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" onsubmit ="return Validate()" action={{ url('admin/edit-project-detail/' . $projectDetails->id) }} name="project_detail_edit" id="project_detail_edit" novalidate="novalidate">{{ csrf_field() }}
                                <div class="control-group">
                                    <label class="control-label">Date</label>
                                    <div class="controls">
                                        <input type="date" name="date_pd" id="date_pd" value="{{$projectDetails->date_pd}}" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Title</label>
                                    <div class="controls">
                                        <input type="text" name="title" id="title" value="{{$projectDetails->title}}" />
                                    </div>
                                </div><div class="control-group">
                                    <label class="control-label">Description</label>
                                    <div class="controls">
                                        <textarea name="description" id="description" >{{$projectDetails->description}}</textarea>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Select Subtype</label>
                                    <div class="controls">
                                        <select style="width:220px" name="subtype_id" id="subtype_id">
                                            <?php echo $subtypes_dropdown; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="Edit Project Detail" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.adminLayout.admin_scripts_forms')
    <script>
        function Validate() {
            var subcat= document.getElementById("subtype_id");
            if (subcat.value == "Select Subtype") {
                alert("Please Select Subtype !");
                return false;
            }
            return true;
        }
    </script>
@endsection