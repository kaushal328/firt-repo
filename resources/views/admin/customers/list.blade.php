@include('admin.common.header')
<style>
    .text-success {
        color: green;
    }

    .text-danger {
        color: red;
    }
</style>
<!-- Content -->
@php
$admin_id = session('admin');
@endphp
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb" class="mb-2 d-flex align-items-center justify-content-between">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('admin/dashboard')}}">Dashboad</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{url('admin/customer')}}">Customers</a>
                </li>
                <li class="breadcrumb-item active">List</li>
            </ol>
        </nav>
        <div class="">
            <!-- Category List Table -->
            <div class="ajax-msg mt-1 mb-1"></div>
            <div class="card mb-3">
                <div class="card-header border-bottom">
                    <form>
                        <div class="row">
                            <div class="col-lg-3">
                                <label for="title" class="form-label">Customer Name</label>
                                <input type="text" class="form-control" name="customer_name" value="<?= isset($customer_name) ? $customer_name : '' ?>" />
                            </div>
                            <div class="col-lg-3">
                                <label for="title" class="form-label">Mobile No</label>
                                <input type="text" class="form-control" name="mobile_no" value="<?= isset($mobile_no) ? $mobile_no : '' ?>" />
                            </div>
                            <div class="col-lg-3">
                                <label for="title" class="form-label">Email Id</label>
                                <input type="text" class="form-control" name="email_id" value="<?= isset($email_id) ? $email_id : '' ?>" />
                            </div>

                            <div class="col-lg-3">
                                <button type="submit" class="btn btn-primary mt-4">Search</button>
                                <a class="btn btn-warning mt-4" href="{{url('admin/customer')}}">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive text-nowrap">
                    <div class="dataTables_wrapper dt-bootstrap5 no-footer">


                        @php
                        if (count($list)) {
                        $starts_from = $per_page * ($page - 1) + 1;
                        $end_to = $starts_from + $per_page - 1;
                        if ($end_to > $num_rows) {
                        $end_to = $num_rows;
                        }
                        $entries_text =
                        'Showing ' . $starts_from . ' to ' . $end_to . ' of ' . $num_rows . ' entries';
                        } else {
                        $entries_text = 'No data found!';
                        }
                        @endphp
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Lead No</th>
                                    <th>Customer Detail</th>
                                    <th>Finanial Details</th>
                                    @if(!in_array(4,explode(',',$admin_id['role'])))
                                    <th class="text-lg-center">Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @if($list->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center">No data found</td>
                                </tr>
                                @else
                                @foreach($list as $key => $val)
                                <tr data-id="{{ base64_encode($val['id']) }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <b>
                                            @if(!empty($val['lead']) && !empty($val['lead']['unique_id']))
                                            <a href="{{url('admin/customer/' . base64_encode($val['id']) . '/loan/')}}">
                                                {{ $val['lead']['unique_id']  }}
                                            </a>
                                            @else
                                            <a href="{{url('admin/customer/' . base64_encode($val['id']) . '/loan/')}}">
                                                {{ $val['Lead_logs']['unique_id']}}
                                            </a>
                                            @endif
                                        </b>
                                    </td>

                                    <td><b>{{ $val['customer_name']  }}</b><br>
                                        {{ 'Mobile -'.$val['mobile']}}<br>
                                        {{ 'Email -'.$val['email'] }}<br>
                                    </td>
                                    <td>
                                        <div class="">
                                            <a class="btn btn-sm btn-icon btn-warning m-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Income" href="{{url('admin/customer/' . base64_encode($val['id']) . '/income/')}}">
                                                <i class="fa-solid fa-credit-card text-white"></i>
                                            </a>
                                            <a class="btn btn-sm btn-icon btn-danger m-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Expense" href="{{url('admin/customer/' . base64_encode($val['id']) . '/expense/')}}">
                                                <i class="fa-solid fa-wallet text-white"></i>
                                            </a>
                                            <a class="btn btn-sm btn-icon btn-info m-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Loan" href="{{url('admin/customer/' . base64_encode($val['id']) . '/loan/')}}">
                                                <i class="fa-solid fa-building-columns text-white"></i>
                                            </a>
                                            <!-- <a class="btn btn-sm btn-icon btn-danger m-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Settlement" href="{{url('admin/customer/' . base64_encode($val['id']) . '/settlement/')}}">
                                                <i class="fa-solid fa-wallet text-white"></i>
                                            </a> -->
                                        </div>
                                    </td>
                                    @if(!in_array(4,explode(',',$admin_id['role'])))
                                    <td>
                                        <div class="d-flex align-items-sm-center justify-content-sm-center">
                                            <a class="btn btn-sm btn-icon m-1" href="{{ route('admin.customer.form', ['id' =>base64_encode($val['id']) ]) }}">
                                                <i class="ti ti-edit text-primary"></i>
                                            </a>
                                            <button class="badge btn {{ $val['is_active'] == 1 ? 'btn-primary' : 'btn-danger' }} change-status m-4"
                                                data-id="{{ $val['id'] }}"
                                                data-status="{{ $val['is_active'] }}">
                                                {{ $val['is_active'] == 1 ? 'Active' : 'De-Active' }}
                                            </button>
                                            <a class="btn btn-sm btn-icon m-1 delete-record" href="javascript:void(0)">
                                                <i class="ti ti-trash text-danger"></i>
                                            </a>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                                @endif

                            </tbody>
                        </table>
                        <div class="row mx-3 mt-2 mb-2">
                            <div class="col-md-12 col-xl-6 text-center text-xl-start pb-2 pb-lg-0 pe-0">
                                <div class="dataTables_info">{{ $entries_text }}</div>
                            </div>
                            <div class="col-md-12 col-xl-6 d-flex justify-content-center justify-content-xl-end">
                                <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                    {!! pagination($num_rows, $per_page, $page, $url) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

    @include('admin.common.footer')

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })
        $(document).on('click', '.delete-record', function(e) {
            e.preventDefault();

            if (confirm("Are you sure you want to delete this record?")) {
                const _this = $(this)
                const url = "{{ url('admin/customer/delete') }}";

                $.post(url, {
                    id: _this.closest('tr').attr("data-id")
                }, function(res) {
                    processAjaxResponse(res)
                    if (res.status == 1) {
                        _this.closest('tr').remove();
                    }
                }, 'json')
            }
        })
        $(document).on('click', '.change-status', function(e) {
            e.preventDefault();

            let button = $(this);
            let id = button.data('id');
            let currentStatus = button.data('status');
            let newStatus = currentStatus == 1 ? 0 : 1;
            let statusText = newStatus == 1 ? 'Active' : 'De-Active';
            let statusClass = newStatus == 1 ? 'btn-primary' : 'bg-label-danger';

            if (confirm("Are you sure you want to change the status?")) {
                $.post("{{ url('admin/customer/change-status') }}", {
                    id: id,
                    status: newStatus
                }, function(res) {
                    if (res.status == 1) {
                        button.text(statusText).removeClass("bg-label-success bg-label-danger").addClass(statusClass).data("status", newStatus);
                        alert("Status updated successfully!");
                        location.reload();
                    } else {
                        console.log("Error: Unable to update status.");
                    }
                }, 'json').fail(function() {
                    alert("Error: Server error occurred.");
                });
            }
        });
    </script>

    @include('admin.common.end')