@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Cities</a> <a href="#" class="current">Add City</a> </div>
            <h1><i class="icon-building"></i>  Cities</h1>
        </div>
        <div class="container-fluid"><hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-edit"></i> </span>
                            <h5>Add City</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" onsubmit ="return Validate()" action="{{ url('admin/add-city') }}" name="city_add" id="city_add" novalidate="novalidate">{{ csrf_field() }}
                                <div class="control-group">
                                    <label class="control-label">City Name</label>
                                    <div class="controls">
                                        <input type="text" name="name" id="name" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Select Country</label>
                                    <div class="controls">
                                        <select style="width:220px" name="country_id" id="country_id">
                                            <?php echo $countries_dropdown; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="Add City" class="btn btn-success">
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
            var subcat= document.getElementById("country_id");
            if (subcat.value == "Select Country") {
                alert("Please Select Country !");
                return false;
            }
            return true;
        }
    </script>
@endsection