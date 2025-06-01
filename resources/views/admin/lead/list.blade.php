@include('admin.common.header')

<!-- Content -->

<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb" class="mb-2 d-flex align-items-center justify-content-between">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('admin/dashboard')}}">Dashboad</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{url('admin/lead')}}">Lead</a>
                </li>
                <li class="breadcrumb-item active">List</li>
            </ol>
            <a href="{{url('admin/lead/form')}}" class="btn btn-primary">Add Lead</a>
        </nav>

        <div class="mt-1 mb-1">
            <div class="ajax-msg mt-1 mb-1"></div>
            <div class="card mb-3">
                <div class="card-header border-bottom">
                    <form>
                        <div class="row">
                            <div class="col-lg-3">
                                <label for="title" class="form-label">Lead Name</label>
                                <input type="text" class="form-control" name="lead_name" value="<?= isset($lead_name) ? $lead_name : '' ?>" accept=".xls">
                            </div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary mt-4">Search</button>
                                <a class="btn btn-warning mt-4" href="{{url('admin/lead')}}">Reset</a>
                                <button class="btn btn-facebook waves-effect waves-light mt-4" name="export" value="1"><i class="tf-icons ti ti-download ti-xs me-2"></i>Download Excel</button>
                            </div>
                        </div>
                    </form>
                    <form action="{{route('lead.import_excel')}}" method="POST" enctype="multipart/form-data" class="mt-4 ajax-form">
                        @csrf
                        <div class="row">
                            <div class="col-lg-3">
                                <label for="excelFile" class="form-label ">Upload Excel File</label>
                                <input type="file" class="form-control @error('excel_file') is-invalid @enderror" name="excel_file" id="excelFile" />
                                @error('excel_file')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror

                                @if($errors->any())
                                <span class="text-danger small">{{ $errors->first('errors') }}</span>
                                @endif

                            </div>
                            <div class="col-lg-3">
                                <button type="submit" class="btn btn-success mt-4">Submit Excel</button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="table-responsive text-nowrap">
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
                                <th>Lead Id</th>
                                <th>Customer Detail</th>

                                <th>Status</th>
                                <th class="text-lg-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @if(!empty($list) && $list->count() > 0)
                            @foreach ($list as $index => $val)

                            <tr data-id="{{ base64_encode($val['id']) }}">
                                <td>{{ $index + 1 }}</td>

                                <td> <a class="" href=" {{url('admin/lead/' . base64_encode($val['id']) . '/lead-history/')}}">{{$val['unique_id']}}</a></td>
                                <td><b>{{ $val['customer_name']  }}</b><br>
                                    {{ 'Mobile -'.$val['mobile']}}<br>
                                    {{ $val['email'] ? 'Email -'.$val['email'] : "" }}
                                </td>


                                <td>{{ !empty($val['status']) ? statusName($val['status']) : "Not Select Lead Status"}}</td>
                                <td>
                                    <div class="d-flex align-items-sm-center justify-content-sm-center">

                                        <a class="btn btn-sm btn-icon" href="{{url('admin/lead/form/'.base64_encode($val['id']))}}"><i class="ti ti-edit text-primary"></i></a>
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
                const url = "{{ url('admin/lead/delete') }}";

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
            let statusClass = newStatus == 1 ? 'btn-primary' : 'btn-danger';

            if (confirm("Are you sure you want to change the status?")) {
                $.post("{{ url('admin/lead/update-status') }}", {
                    id: id,
                    status: newStatus
                }, function(res) {
                    if (res.status == 1) {
                        button.text(statusText).removeClass("btn-primary btn-danger").addClass(statusClass).data("status", newStatus);
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