@include('admin.common.header')
<style>
    .flatpickr-calendar.hasTime.noCalendar.animate.arrowTop.arrowLeft.open {
        width: 22.5% !important;
    }
</style>

@php
if(isset($edit) && !empty($edit)) {
$id = $edit['id'];
$customer_name = $edit['customer_name'];
$mobile = $edit['mobile'];
$email = $edit['email'];
$address1 = $edit['address1'];
$address2 = $edit['address2'];
$pincode = $edit['pincode'];
$state_id = $edit['state_id'];
$country_id = $edit['country_id'];
$city = $edit['city'];

$permanent_address1 = $edit['permanent_address1'];
$permanent_address2 = $edit['permanent_address2'];
$permanent_pincode = $edit['permanent_pincode'];
$permanent_state_id = $edit['permanent_state_id'];
$permanent_country_id = $edit['permanent_country_id'];
$permanent_city = $edit['permanent_city'];
$status = $edit['status'];

$assigned_id = $edit['assigned_id'];
$is_active = $edit['is_active'];
$call_date = $edit['call_date'];
$call_time = $edit['call_time'];
$comment = $edit['comment'];
}else{
$id = '';
$customer_name = '';
$mobile = '';
$email = '';
$address1 = '';
$address2 = '';
$pincode = '';
$state_id = '';
$country_id = '';
$city = '';
$permanent_address1 = '';
$permanent_address2 = '';
$permanent_pincode = '';
$permanent_state_id = '';
$permanent_country_id = '';
$permanent_city = '';
$status = '';
$assigned_id = '';
$is_active = '';
$call_date = '';
$call_time = '';
$comment = '';
}
@endphp

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="mb-4 d-flex align-items-center justify-content-between">
            <h4 class="mb-0"><span class="text-muted fw-light">Dashboard / </span> Customer / Form</h4>
            <div>
                <a href="{{url('admin/customer')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <form class="form" id="ajax_form" method="POST" route="save-customer" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}" />
                    <div class="row">
                        <div class="col-12 ajax-msg"></div>
                        <div class="col-12 col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-tile mb-0">Customer Details</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row customers">
                                        <div class="col-lg-3 mb-3 ajax-field">
                                            <label class="form-label" for="name">Customer Name</label>
                                            <input type="text" class="form-control" id="customer_name" placeholder="Customer Name" name="customer_name" value="{{ $customer_name }}">
                                            <span id="customer_name_err" class="error customer_name_err small" style="color:red;"></span>
                                        </div>
                                        <div class="col-lg-3 mb-3 ajax-field">
                                            <label class="form-label" for="status">Country Code</label>
                                            <select class="form-control select2" name="country_code" data-style="btn-default">
                                                <option value="">Select Country Code</option>
                                                @if(isset($masterCountry) && !empty($masterCountry))
                                                @foreach($masterCountry as $c_val)
                                                <option value="{{ $c_val['country_code']}}" <?= $country_id == $c_val['id'] ? 'selected' : "" ?>>{{ $c_val['country_code'] . ' ' . $c_val['country_name'] }}
                                                </option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <span id="state_id_err" class="error state_id_err small" style="color:red;"></span>
                                        </div>
                                        <div class="col-lg-3 mb-3 ajax-field">
                                            <label class="form-label" for="mobile_no">Mobile No</label>
                                            <input type="text" class="form-control non_character" id="mobile_no" placeholder="Mobile No" name="mobile" value="{{ $mobile }}" maxlength="10">
                                            <span id="mobile_err" class="error mobile_err small" style="color:red;"></span>
                                        </div>

                                        <div class="col-lg-3 mb-3 ajax-field">
                                            <label class="form-label" for="email">Email Id</label>
                                            <input type="text" class="form-control" id="email" placeholder="Email Id" name="email" value="{{ $email }}">
                                            <span id="email_err" class="error email_err small" style="color:red;"></span>
                                        </div>

                                        <h5>Current Address</h5>
                                        <div class="col-lg-6 mb-3 ajax-field">
                                            <label class="form-label" for="address">Address 1</label>
                                            <textarea class="form-control" placeholder="Address 1" name="address1" rows="5" cols="50">{{ $address1 }}</textarea>
                                            <span id="address_err" class="error address_err small" style="color:red;"></span>
                                        </div>
                                        <div class="col-lg-6 mb-3 ajax-field">
                                            <label class="form-label" for="address">Address 2</label>
                                            <textarea class="form-control" placeholder="Address 2" name="address2" rows="5" cols="50">{{ $address2 }}</textarea>
                                            <span id="address_err" class="error address_err small" style="color:red;"></span>
                                        </div>

                                        <div class="col-lg-3 mb-3 ajax-field">
                                            <label class="form-label" for="pincode">Pincode</label>
                                            <input type="text" class="form-control non_character" id="pincode" placeholder="Pincode" name="pincode" value="{{ $pincode }}" maxlength="6">
                                            <span id="pincode_err" class="error pincode_err small" style="color:red;"></span>
                                        </div>

                                        <div class="col-lg-3 mb-3 ajax-field">
                                            <label class="form-label" for="State">State</label>
                                            <select class="form-control select2" name="state_id" data-style="btn-default">
                                                <option value="">Select State</option>
                                                @if(isset($masterState) && !empty($masterState))
                                                @foreach($masterState as $state_val)
                                                <option value="{{ $state_val['id']}}" <?= $state_id == $state_val['id'] ? 'selected' : "" ?>>{{ $state_val['state_name']}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <span id="state_id_err" class="error state_id_err small" style="color:red;"></span>
                                        </div>

                                        <div class="col-lg-3 mb-3 ajax-field">
                                            <label class="form-label" for="Country">Country</label>
                                            <select class="selectpicker w-100" name="country_id" data-style="btn-default">
                                                @if(isset($masterCountry) && !empty($masterCountry))
                                                @foreach($masterCountry as $c_val)
                                                <option value="{{ $c_val['id']}}" <?= $country_id == $c_val['id'] ? 'selected' : "" ?>>{{ $c_val['country_name']}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <span id="country_id_err" class="error country_id_err small" style="color:red;"></span>
                                        </div>

                                        <div class="col-lg-3 mb-3 ajax-field">
                                            <label class="form-label" for="city">City</label>
                                            <input type="text" class="form-control" id="city" placeholder="City" name="city" value="{{ $city }}">
                                            <span id="city_err" class="error city_err small" style="color:red;"></span>
                                        </div>

                                        <h5>Permanent Address</h5>
                                        <div class="col-lg-6 mb-3 ajax-field">
                                            <label class="form-label" for="permanent_address1">Permanent Address 1</label>
                                            <textarea class="form-control" placeholder="Permanent Address 1" name="permanent_address1" rows="5" cols="50">{{ $permanent_address1 }}</textarea>
                                            <span id="address_err" class="error address_err small" style="color:red;"></span>
                                        </div>
                                        <div class="col-lg-6 mb-3 ajax-field">
                                            <label class="form-label" for="permanent_address2">Permanent Address 2</label>
                                            <textarea class="form-control" placeholder="Permanent Address 2" name="permanent_address2" rows="5" cols="50">{{ $permanent_address2 }}</textarea>
                                            <span id="address_err" class="error address_err small" style="color:red;"></span>
                                        </div>

                                        <div class="col-lg-4 mb-3 ajax-field">
                                            <label class="form-label" for="pincode">Permanent Pincode</label>
                                            <input type="text" class="form-control non_character" id="permanent_pincode" placeholder="Permanent Pincode" name="permanent_pincode" value="{{ $permanent_pincode }}" maxlength="6">
                                            <span id="pincode_err" class="error pincode_err small" style="color:red;"></span>
                                        </div>

                                        <div class="col-lg-4 mb-3 ajax-field">
                                            <label class="form-label" for="State">Permanent State</label>
                                            <select class="form-control select2" name="permanent_state_id" data-style="btn-default">
                                                <option value="">Select State</option>
                                                @if(isset($masterState) && !empty($masterState))
                                                @foreach($masterState as $state_val)
                                                <option value="{{ $state_val['id']}}" <?= $permanent_state_id == $state_val['id'] ? 'selected' : "" ?>>{{ $state_val['state_name']}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <span id="state_id_err" class="error state_id_err small" style="color:red;"></span>
                                        </div>

                                        <div class="col-lg-4 mb-3 ajax-field">
                                            <label class="form-label" for="Country">Permanent Country</label>
                                            <select class="selectpicker w-100" name="permanent_country_id" data-style="btn-default">
                                                <option value="">Select Country</option>
                                                @if(isset($masterCountry) && !empty($masterCountry))
                                                @foreach($masterCountry as $c_val)
                                                <option value="{{ $c_val['id']}}" <?= $country_id == $c_val['id'] ? 'selected' : "" ?>>{{ $c_val['country_name']}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <span id="country_id_err" class="error country_id_err small" style="color:red;"></span>
                                        </div>

                                        <div class="col-lg-4 mb-3 ajax-field">
                                            <label class="form-label" for="permanent_city">Permanent City</label>
                                            <input type="text" class="form-control" id="permanent_city" placeholder="Permanent City" name="permanent_city" value="{{ $city }}">
                                            <span id="city_err" class="error city_err small" style="color:red;"></span>
                                        </div>



                                        <div class="col-lg-4 mb-3 ajax-field">
                                            <label class="form-label" for="status">Status</label>
                                            <select class="selectpicker w-100" name="is_active" data-style="btn-default">
                                                <option value="1" <?= $is_active == '1' ? 'selected' : '' ?>>Active</option>
                                                <option value="0" <?= $is_active == '0' ? 'selected' : '' ?>>Inactive</option>
                                            </select>
                                            <span class="ajax-error"></span>
                                        </div>

                                        <div class="col-lg-4 mb-3 ajax-field callback_div">
                                            <label class="form-label" for="date">Call Date </label>
                                            <input type="text" class="form-control datepicker" placeholder="Call Date" name="call_date" value="<?= !empty($call_date) ? date('d-m-Y', strtotime($call_date)) : "" ?>">
                                            <span id="call_date_err" class="error call_date_err small" style="color:red;"></span>
                                        </div>

                                        <div class="col-lg-4 mb-3 ajax-field callback_div">
                                            <label class="form-label">Call Time </label>
                                            <input type="text" class="form-control timepicker" placeholder="Call Time" name="call_time" value="<?= !empty($call_time) ? date('H:i', strtotime($call_time)) : "" ?>">
                                            <span id="call_time_err" class="error call_time_err small" style="color:red;"></span>
                                        </div>

                                        <div class="col-lg-12 mb-3 ajax-field">
                                            <label class="form-label" for="Comment">Comment</label>
                                            <textarea class="form-control" placeholder="Comment" name="comment" rows="5" cols="50">{{ $comment }}</textarea>
                                            <span id="address_err" class="error address_err small" style="color:red;"></span>
                                        </div>


                                        @if($edit)
                                        <div class="col-lg-4 mb-3 ajax-field">
                                            <label class="form-label" for="status">Lead Transfer</label>
                                            <select class="selectpicker w-100" name="assigned_id" data-style="btn-default">
                                                @if(isset($userList) && !empty($userList))
                                                <option value="">Select Option</option>
                                                @foreach($userList as $u_val)
                                                <option value="{{ $u_val['id']}}" <?= $assigned_id == $u_val['id'] ? 'selected' : "" ?>>{{ $u_val['username']}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <span id="assigned_id_err" class="error assigned_id_err small" style="color:red;"></span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success submit-button">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
<!-- Content wrapper -->
@include('admin.common.footer')
<script>
    $(document).ready(function() {
        $('.select2').select2();
        const timePicker = $('.timepicker');
        if (timePicker.length) {
            timePicker.flatpickr({
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true
            });
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('.non_character').on('input', function() {

            $(this).val($(this).val().replace(/[a-zA-Z]/g, ''));
        });
    });
</script>
@include('admin.common.end')