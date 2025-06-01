@include('admin.common.header')
@php
if(isset($edit) && !empty($edit)) {
$id = $edit['id'];
$lead_source_name = $edit['lead_source_name'];
}else{
$id = '';
$lead_source_name = '';
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
                    <a href="{{url('admin/master/lead-source')}}">Lead Source</a>
                </li>
                <li class="breadcrumb-item active">Add</li>
            </ol>
            <div>
                <a href="{{url('admin/master/lead-source')}}" class="btn btn-primary">Back</a>
            </div>
        </nav>
        <div class="row">
            <div class="col-md-6">
                <div class="ajax-msg"></div>
                <form class="form ajax_form" id="" method="POST" action="{{route('admin.master.lead_source_save')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$id}}">
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-tile mb-0">Lead source name</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row customers">
                                        <div class="col-lg-12 mb-3 ajax-field">
                                            <label class="form-label" for="Lead source name">Lead source name </label>
                                            <input type="text" name="lead_source_name" class="form-control" placeholder="Enter lead source name" value="{{$lead_source_name}}">
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