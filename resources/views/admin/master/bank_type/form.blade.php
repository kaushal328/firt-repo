@include('admin.common.header')

@php
if(isset($edit) && !empty($edit)) {
$id = $edit['id'];
$bank_type_name = $edit['bank_type_name'];


}else{
$id = '';


$bank_type_name = '';
}
@endphp

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb" class="mb-2 d-flex align-items-center justify-content-between">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('admin/dashboard')}}">Dashboad</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Master</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{url('admin/master/bank-type')}}">Bank Type</a>
                </li>
                <li class="breadcrumb-item active">Add</li>
            </ol>
            <div>
                <a href="{{url('admin/master/bank-type')}}" class="btn btn-primary">Back</a>
            </div>
        </nav>
        <div class="row">
            <div class="col-md-6">

                <form class="form" id="ajax_form" method="POST" route="bank-type-save">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}" />

                    <div class="row">
                        <div class="col-12 ajax-msg"></div>
                        <div class="col-12 col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-tile mb-0">Bank Type Details</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row customers">
                                        <div class="col-lg-12 mb-3 ajax-field">
                                            <label class="form-label" for="bank_type_name">Bank type name</label>
                                            <input type="text" class="form-control" id="bank_type_name" placeholder="Bank type name" name="bank_type_name" value="{{ $bank_type_name }}">
                                            <span id="bank_type_name_err" class="error bank_type_name_err small" style="color:red;"></span>
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
    <!-- / Content -->
</div>
<!-- Content wrapper -->
@include('admin.common.footer')
@include('admin.common.end')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });




    });
</script>