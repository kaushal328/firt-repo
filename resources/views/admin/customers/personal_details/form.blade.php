@include('admin.common.header')
<style>
    .flatpickr-calendar.hasTime.noCalendar.animate.arrowTop.arrowLeft.open {
        width: 22.5% !important;
    }
</style>
<?php
if ($edit) {
    $next_salary_date = $edit['next_salary_date'];
    $whatapp_no = $edit['whatapp_no'];
    $addhar_no     = $edit['addhar_no'];
    $pan_card_no = $edit['pan_card_no'];
    $mar_status = $edit['marital_status'];
    $date_of_birth = $edit['date_of_birth'];
    $children_age = $edit['children_age'];
    $no_children =  $edit['no_children'];
    $salary_bank =  $edit['salary_bank_id'];
    $ecs_account_bank =  $edit['ecs_account_bank_id'];
    $change_salary_account =  $edit['change_salary_account_id'];
} else {
    $next_salary_date = "";
    $whatapp_no = "";
    $addhar_no     = "";
    $mar_status = "";
    $pan_card_no = "";
    $date_of_birth = "";
    $children_age = "";
    $no_children =  "";
    $salary_bank =  "";
    $ecs_account_bank =  "";
    $change_salary_account =  "";
}

?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h4 class="mb-0"><span class="text-muted fw-light">Dashboard / </span> Customer / Personal Details</h4>
        <div>
            <a href="{{route('admin.customer.personal_details', ['id' => $id])}}" class="btn btn-primary">Back</a>
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
                    <form class="form ajax_form" method="POST" action="{{route('admin.customer.personal_details_save')}}">
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
                                                <label class="form-label" for="next_salary_date">Next salary payment date</label>
                                                <input type="text" class="form-control datepicker" id="next_salary_date" placeholder="Next salary payment date" name="next_salary_date" value="{{$next_salary_date}}">
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="whatapp_no">Whatsapp Number</label>
                                                <input type="text" class="form-control" id="whatapp_no" placeholder="Whatsapp Number" name="whatapp_no" value="{{ $whatapp_no }}" oninput="this.value = this.value.replace(/[^0-9]/g,'')">
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="addhar_no">Aadhar card</label>
                                                <input type="text" class="form-control" id="addhar_no" placeholder="Aadhar card" name="addhar_no" maxlength="12" value="{{ $addhar_no }}">
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="pancard">Pancard</label>
                                                <input type="text" class="form-control" id="pancard" placeholder="Pancard" name="pan_card_no" value="{{ $pan_card_no }}">
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="remark">Marital Status</label>
                                                <select class="form-control" id="marital_status" name="marital_status">
                                                    <option value="">Select</option>
                                                    @foreach($marital_status as $row)

                                                    <option value="{{$row}}" {{$mar_status == $row ? 'selected':''}}>{{$row}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="remark">Date of Birth</label>
                                                <input type="text" class="form-control datepicker" id="date_of_birth" placeholder="Date of Birth" name="date_of_birth" value="{{ $date_of_birth }}">
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="remark">Age of Children</label>
                                                <input type="text" class="form-control" id="children_age" placeholder="Age of Children" name="children_age" value="{{ $children_age }}">
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="remark">Number of Children</label>
                                                <input type="text" class="form-control" id="no_children" placeholder="Number of Children" name="no_children" value="{{$no_children}}">

                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="remark">Salary Account</label>
                                                <select class="form-control" id="salary_bank" name="salary_bank">
                                                    <option value="">Select</option>
                                                    @foreach($bank_list as $row)
                                                    <option value="{{$row->id}}" {{$salary_bank == $row->id ? 'selected' :''}}>{{$row->creditors_name}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="ecs_account_bank">ECS Account</label>
                                                <select class="form-control" id="ecs_account_bank" name="ecs_account_bank">
                                                    <option value="">Select Bank</option>
                                                    @foreach($bank_list as $row)
                                                    <option value="{{$row->id}}" {{$ecs_account_bank == $row->id ? 'selected' :''}}>{{$row->creditors_name}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="remark">Change Salary Account</label>
                                                <select class="form-control" id="change_salary_account" name="change_salary_account">
                                                    <option value="">Select Bank</option>
                                                    <option value="1" {{$change_salary_account == '1' ? 'selected' :''}}>Yes</option>
                                                    <option value="2" {{$change_salary_account == '2' ? 'selected' :''}}>No</option>
                                                </select>
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
        $('#marital_status').select2({
            width: '100%'
        });
        $('#change_salary_account').select2({
            width: '100%'
        });
        $('#ecs_account_bank').select2({
            width: '100%'
        });
        $('#salary_bank').select2({
            width: '100%'
        });

    });
</script>
<script>
    $(document).ready(function() {
        $(document).on('submit', '.ajax_form', function(e) {
            e.preventDefault();
            clearAjaxErrors();
            const _this = $(this);
            const url = _this.attr('action');
            const data = _this.serializeArray();
            $.post(url, data, function(res) {
                processAjaxResponse(res, 1000);
            }, 'json');
        })
    })
</script>
@include('admin.common.end')