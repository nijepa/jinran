@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Companies</a> <a href="#" class="current">Add Company</a> </div>
            <h1><i class="icon-screenshot"></i>  Companies</h1>
        </div>
        <div class="container-fluid"><hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-edit"></i> </span>
                            <h5>Add Company</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" onsubmit ="return Validate()" action={{ url('admin/add-company') }} enctype="multipart/form-data" name="company_add" id="company_add" novalidate="novalidate">{{ csrf_field() }}
                                <div class="control-group">
                                    <label class="control-label">Logo</label>
                                    <div class="controls">
                                        <input type="file" name="photo_id" id="photo_id" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Company Name</label>
                                    <div class="controls">
                                        <input type="text" name="name" id="name" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Address</label>
                                    <div class="controls">
                                        <input type="text" name="address" id="address" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Select City</label>
                                    <div class="controls">
                                        <select style="width:220px" name="city_id" id="city_id">
                                            <?php echo $cities_dropdown; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Phone</label>
                                    <div class="controls">
                                        <input type="text" name="phone" id="phone" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Mobile</label>
                                    <div class="controls">
                                        <input type="text" name="mobile" id="mobile" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">E-mail</label>
                                    <div class="controls">
                                        <input type="text" name="email" id="email" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Web site</label>
                                    <div class="controls">
                                        <input type="text" name="website" id="website" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Select Category</label>
                                    <div class="controls">
                                        <select style="width:220px" name="category_id" id="category_id">
                                            <?php echo $categories_dropdown; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="Add Company" class="btn btn-success">
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
                var category = document.getElementById("category_id");
                var city = document.getElementById("city_id");
                if (category.value == "Select category") {
                    alert("Please Select Category !");
                    return false;
                }
                if (city.value == "Select city") {
                    alert("Please Select City !");
                    return false;
                }
                return true;

        }
    </script>
@endsection