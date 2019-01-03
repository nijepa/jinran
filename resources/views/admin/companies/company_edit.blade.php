@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Companies</a> <a href="#" class="current">Edit Company</a> </div>
            <h1><i class="icon-screenshot"></i>  Companies</h1>
        </div>
        <div class="container-fluid"><hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-edit"></i> </span>
                            <h5>Edit Company</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" onsubmit ="return Validate()" action={{ url('admin/edit-company/' . $companyDetails->id) }} enctype="multipart/form-data" name="company_edit" id="company_edit" novalidate="novalidate">{{ csrf_field() }}
                                <div class="control-group">
                                    <label class="control-label">Logo</label>
                                    <div class="controls">
                                        <div id="uniform-undefined">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <input name="photo_id" id="photo_id" type="file">
                                                        @if(!empty($companyDetails->photo_id))
                                                            <input type="hidden" name="photo_cur" value="{{ $companyDetails->photo_id }}">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if(!empty($companyDetails->photo_id))
                                                            <img style="width:30px;" src="{{ asset('/images/backend_images/companies/'.$companyDetails->photo_id) }}"> | <a href="{{ url('/admin/delete-company-image/'.$companyDetails->id) }}">Delete</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Company Name</label>
                                    <div class="controls">
                                        <input type="text" name="name" id="name" value="{{$companyDetails->name}}" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Address</label>
                                    <div class="controls">
                                        <input type="text" name="address" id="address" value="{{$companyDetails->address}}" />
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
                                        <input type="text" name="phone" id="phone" value="{{$companyDetails->phone}}" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Mobile</label>
                                    <div class="controls">
                                        <input type="text" name="mobile" id="mobile" value="{{$companyDetails->mobile}}" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">E-mail</label>
                                    <div class="controls">
                                        <input type="email" name="email" id="email" value="{{$companyDetails->email}}" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Web site</label>
                                    <div class="controls">
                                        <input type="text" name="website" id="website" value="{{$companyDetails->website}}" />
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
                                    <input type="submit" value="Edit Company" class="btn btn-success">
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
            if (category.value == "Select Category") {
                alert("Please Select Category !");
                return false;
            }
            if (city.value == "Select City") {
                alert("Please Select City !");
                return false;
            }
            return true;

        }
    </script>
@endsection