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
                    <a href="{{url('admin/agent-task')}}">Agent Task</a>
                </li>
                <li class="breadcrumb-item active">List</li>
            </ol>
            <a href="{{url('admin/agent-task/form')}}" class="btn btn-primary">Add</a>
        </nav>

        <div class="">
            <!-- Category List Table -->
            <div class="ajax-msg mt-1 mb-1"></div>
            <div class="card mb-3">
                <div class="card-header border-bottom">
                @include('admin.common.filteration',['restrict'=>4,'url'=>"admin/agent-task"])
                    
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
                                <th>No</th>
                                <th>Agent name</th>
                                <th>Client Name</th>
                         
                                <th>Task Name</th>
                                <th>Deadline Date</th>
                                <th>Status</th>
                                <th class="text-lg-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php
                            $count = 0;
                            ?>
                            @forelse($list as $row)
                            <tr data-id="{{ base64_encode($row['id']) }}">
                                <td>{{ ++$count }}</td>
                                <td>{{ $row->user->first_name . " " . $row->user->last_name }}</td>
                                <td>{{ $row->customer->customer_name ?? "----" }}</td>
                             
                                <td>{{ $row->title  ?? ""}}</td>
                                <td>{{date("d-m-Y",strtotime($row->deadline_date))  }}</td>
                                <td>Task Description</td>
                                <td>
                                    <div class="d-flex align-items-sm-center justify-content-sm-center">
                                        <a class="btn btn-sm btn-icon m-1" href="{{ url('admin/agent-task/form/' . base64_encode($row['id'])) }}">
                                            <i class="ti ti-edit text-primary"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                    <div class="row mx-3 row mx-3 mt-2 mb-2">
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
                const url = "{{ url('admin/ptp-tracker/delete') }}";
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
    </script>
@yield('customScript')
    @include('admin.common.end')