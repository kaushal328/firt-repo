@include('admin.common.header')
<style>
    .flatpickr-calendar.hasTime.noCalendar.animate.arrowTop.arrowLeft.open {
        width: 22.5% !important;
    }
</style>
<?php

if ($edit) {
    $education_status = $edit['education_status'];
    $employement_status = $edit['employement_status'];
    $employement_duration = $edit['employement_duration'];
    $office_street = $edit['office_street'];
    $office_state = $edit['office_state'];
    $office_city = $edit['office_city'];
    $office_pincode = $edit['office_pincode'];
    $employment_firm =  $edit['employment_firm'];
} else {
    $education_status = [];
    $employement_status = [];
    $employement_duration = [];
    $office_state = "";
    $office_street = "";
    $office_city = "";
    $office_pincode = "";
    $employment_firm =  "";
}

?>
  
<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h4 class="mb-0"><span class="text-muted fw-light">Dashboard / </span> Customer / Employment Qualification</h4>
        <div>
            <a href="{{route('admin.customer.employee_qual', ['id' => $id])}}" class="btn btn-primary">Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            @include('admin.customers.partial.customer')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="ajax-msg"></div>
                    <form class="form ajax-form" id="" method="POST" action="{{route('admin.customer.employee_qual_save')}}">
                        @csrf
                        <input type="hidden" name="customer_id" value="{{$edit['customer_id'] ?? base64_decode($id) }}">
                        <input type="hidden" name="id" value="{{$edit['id'] ?? ''}}">
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="card-tile mb-0"></h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row customers">
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="remark">Education Status</label>
                                                <select class="form-control" id="education_status" name="education_status">
                                                    <option value="">Select</option>
                                                  
                                                    @foreach($edu_status as $k => $v)
                                                    <option value="{{ $v }}" {{ $education_status == $v ? 'selected' : '' }}>{{ $v }}</option>
                                                    @endforeach

                                                </select>
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="remark">Employment Status</label>
                                                <select class="form-control" id="employement_status" name="employement_status">
                                                    <option value="">Select</option>

                                                    @foreach($employee_status as $row)
                                                    
                                                    <option value="{{$row->id}}" {{ $employement_status == $row->id ? 'selected' : '' }}>{{$row->employee_status_name}}</option>
                                                    @endforeach

                                                </select>
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="remark">How long with employer</label>
                                                <select class="form-control" id="employement_duration" name="employement_duration">
                                                    <option value="">Select</option>
                                                    @foreach($employee_duration as $row)
                                                    <option value="{{$row->id}}" {{ $employement_duration == $row->id ? 'selected' : '' }}>{{$row->duration}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="remark">Office Street</label>
                                                <textarea class="form-control" name="office_street" placeholder="Office Street">{{$office_street}}</textarea>
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="remark">Office City</label>
                                                <input type="text" name="office_city" id="office_city" class="form-control" placeholder="Office City" value="{{$office_city}}">
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="remark">Office Pincode</label>
                                                <input type="text" name="office_pincode" id="office_pincode" class="form-control" placeholder="Office Pincode" maxlength="6" value="{{$office_pincode}}">
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="Office State">Office State</label>
                                                <input type="text" name="office_state" id="office_state" class="form-control" placeholder="Office State"  value="{{$office_state}}">
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="Employment Firm">Employment Firm</label>
                                                <input type="text" name="employment_firm" id="employment_firm" class="form-control" placeholder="Employment Firm" value="{{$employment_firm}}">

                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
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
    </div>
</div>


@include('admin.common.footer')
<script>
    $(document).ready(function() {

        $('#education_status').select2({
            width: '100%'
        });
        $('#employement_status').select2({
            width: '100%'
        });
        $('#employement_duration').select2({
            width: '100%'
        });

    });

    $(document).ready(function() {
        $(document).on('submit', '.ajax-form', function(e) {
            e.preventDefault();
            clearAjaxErrors();

            const _this = $(this);

            // _this.find('.submit-button').attr('disabled', 'disabled');
            // _this.find('.submit-button').text('Saving...');
            const url = _this.attr('action');
            const data = _this.serializeArray();
            $.post(url, data, function(res) {
                // _this.find('.submit-button').removeAttr('disabled');
                // _this.find('.submit-button').text('Save');
                processAjaxResponse(res, 1000);
            }, 'json');
        })
    })
</script>
@include('admin.common.end')