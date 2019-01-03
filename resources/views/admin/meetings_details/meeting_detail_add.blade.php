@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Meetings Details</a> <a href="#" class="current">Add Meeting Detail</a> </div>
            <h1><i class="icon-briefcase"></i>  Meetings Details</h1>
        </div>
        <div class="container-fluid"><hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-edit"></i> </span>
                            <h5>Add Meeting Detail</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" onsubmit ="return Validate()" action={{ url('admin/add-meeting-detail/' . $meetingID) }} name="meeting_detail_add" id="meeting_detail_add" novalidate="novalidate">{{ csrf_field() }}
                                <div class="control-group">
                                    <label class="control-label">Title</label>
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
                                    <label class="control-label">Select Country</label>
                                    <div class="controls">
                                        <select style="width:220px" name="company_id" id="company_id">
                                            <?php echo $companies_dropdown; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="Add Meeting Detail" class="btn btn-success">
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
            var subcat= document.getElementById("company_id");
            if (subcat.value == "Select company") {
                alert("Please Select Company !");
                return false;
            }
            return true;
        }
    </script>
@endsection