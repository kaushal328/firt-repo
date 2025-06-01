@include('admin.common.header')

@php
if(isset($edit) && !empty($edit)) {
$id = $edit['id'];
$user_id = $edit['user_id'];
$client_name = $edit['client_name'];
$deadline_date = $edit['deadline_date'];
$customer_id = $edit['customer_id'];
$description = $edit['description'];
$title = $edit['title'];
}else{
$id = '';
$user_id = '';
$client_name = '';
$deadline_date = '';
$description = '';
$customer_id = '';
$title = "";
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
                    <a href="{{url('admin/agent-task')}}">Agent Task</a>
                </li>
                <li class="breadcrumb-item active">Add</li>
            </ol>
            <div>
                <a href="{{url('admin/agent-task')}}" class="btn btn-primary">Back</a>
            </div>
        </nav>
        <div class="row">
            <div class="col-md-12">

                <form class="form" id="ajax_form" method="POST" route="save-agent-task">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}" />
                    <input type="hidden" name="customer_id" id="customer_id" value="{{$customer_id}}" />
                    <div class="row">
                        <div class="col-12 ajax-msg"></div>
                        <div class="col-12 col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-tile mb-0">Assign Task To Agent</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row customers">
                                        <div class="col-lg-6 mb-3 ajax-field">
                                            <label class="form-label" for="user_id">Select Agent</label>
                                            <select class="selectpicker w-100" name="user_name" data-style="btn-default">
                                                <option value="">select</option>
                                                @if(!empty($agent_list) && is_iterable($agent_list))
                                                @foreach($agent_list as $row)
                                                <option value="{{$row->id}}" <?= $user_id == $row->id ? 'selected' : '' ?>>
                                                    {{$row->first_name . " " . $row->last_name}}
                                                </option>
                                                @endforeach

                                                @endif

                                            </select>
                                            <span id="user_name_err" class="error user_name_err small" style="color:red;"></span>
                                        </div>
                                        <div class="col-lg-6 mb-3 ajax-field">
                                            <label class="form-label" for="title">Title</label>
                                            <input type="text" class="form-control" id="" placeholder="Title" name="title" value="{{ $title }}">
                                            <span id="title_err" class="error title_err small" style="color:red;"></span>
                                        </div>

                                        <div class="col-lg-6 mb-3 ajax-field">
                                            <label class="form-label" for="Customer Name">Customer Name (Optional)</label>
                                            <select class="form-control customer_id" name="customer_id" data-placeholder="Customer Name">
                                            <option value="">select</option>   
                                            @if(!empty($customers))
                                                @foreach($customers as $row)
                                                <option value="{{$row->id}}" {{ $customer_id == $row->id ? 'selected' : '' }}>{{$row->customer_name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <span id="customer_id_err" class="error customer_id_err small" style="color:red;"></span>
                                        </div>



                                        <div class="col-lg-6 mb-3 ajax-field">
                                            <label class="form-label" for="deadline_date">Deadline Date</label>
                                            <input type="text" class="form-control datepicker" id="" placeholder="Deadline Date" name="deadline_date" value="{{ $deadline_date }}">
                                            <span id="deadline_date_err" class="error deadline_date_err small" style="color:red;"></span>
                                        </div>

                                        <div class="col-lg-6 mb-3 ajax-field">
                                            <label class="form-label" for="description">Description</label>
                                            <textarea class="form-control" name="description">{{$description}}</textarea>
                                            <span id="description_err" class="error description_err small" style="color:red;"></span>
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
    $(document).ready(function() {
        // Initialize Select2
        $('.customer_id').select2({
            placeholder: "Customer Name",
            allowClear: true
        });
    });
</script>