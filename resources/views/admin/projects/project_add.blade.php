@extends('layouts.adminLayout.admin_design')
@section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Projects</a> <a href="#" class="current">Add Project</a> </div>
            <h1><i class="icon-cogs"></i>  Projects</h1>
        </div>
        <div class="container-fluid"><hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-edit"></i> </span>
                            <h5>Add Project</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" onsubmit ="return Validate()" action={{ url('admin/add-project') }} name="project_add" id="project_add" novalidate="novalidate">{{ csrf_field() }}
                                <div class="control-group">
                                    <label class="control-label">Date</label>
                                    <div class="controls">
                                        <input type="date" name="date_p" id="date_p" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Project Name</label>
                                    <div class="controls">
                                        <input type="text" name="title" id="title" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Description</label>
                                    <div class="controls">
                                        <textarea name="description" id="description" ></textarea>
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
                                <div class="control-group">
                                    <label class="control-label">Select Type</label>
                                    <div class="controls">
                                        <select style="width:220px" name="type_id" id="type_id">
                                            <?php echo $types_dropdown; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="Add Project" class="btn btn-success">
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
            var category = document.getElementById("company_id");
            var city = document.getElementById("type_id");
            if (category.value == "Select company") {
                alert("Please Select Company !");
                return false;
            }
            if (city.value == "Select Type") {
                alert("Please Select Type !");
                return false;
            }
            return true;

        }
    </script>
@endsection