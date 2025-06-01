@include('admin.common.header')
<?php

$admin_id = session('admin');
?>
<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h4 class="mb-0"><span class="text-muted fw-light">Dashboard / </span> <a
                href="{{url('admin/customer')}}">Customer</a> / Call History</h4>
        <div>
            <a href="{{url('admin/customer')}}" class="btn btn-primary">Back</a>
        </div>
    </div>
    <div class="row">
        @include('admin.customers.partial.customer_details')
        <div class="col-md-8">
            @include('admin.customers.partial.nav', ['id' => $id, 'active_tab' => $active_tab])
            <div class="">
                <div class="tab-pane fade active show" id="navs-top-loans" role="tabpanel">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Call History</h5>
                            <a class="btn btn-sm btn-primary m-1" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-original-title="Call History"
                                href="{{ route('admin.customer.customer_call_history_form',['customer_id'=>$id,'id'=>base64_encode(0)])}}">
                                Add
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="table-responsive">
                                    @php
                                    if (count($list)) {
                                    $starts_from = $per_page * ($page - 1) + 1;
                                    $end_to = $starts_from + $per_page - 1;
                                    if ($end_to > $num_rows) {
                                    $end_to = $num_rows;
                                    }
                                    $entries_text = 'Showing ' . $starts_from . ' to ' . $end_to . ' of ' . $num_rows .
                                    '
                                    entries';
                                    } else {
                                    $entries_text = 'No data found!';
                                    }
                                    @endphp

                                    <table class="table table-bordered w-100">
                                        <thead class="table-light text-nowrap text-center">
                                            <tr>
                                                <td>No</td>
                                                <td>Date</td>
                                                <td>Stage</td>
                                                <td>Disposition</td>
                                                <td>Remark</td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            @if(!empty($list))
                                            @foreach($list as $row)
                                            <?php
                                            $count =0;
                                        ?>
                                            <tr>
                                                <td class="p-3">{{++$count}}</td>
                                                <td class="p-3">{{$row->call_date}}</td>
                                                <td class="p-3">{{$row->stage->stage_name}}</td>
                                                <td class="p-3">{{$row->disposition->name}}</td>
                                                <td class="p-3">{{$row->remark}}</td>
                                                <td class="p-3">
                                                    <div class="d-flex align-items-sm-center justify-content-sm-center">
                                                        <a class="btn btn-sm btn-icon m-1"
                                                            href="{{ route('admin.customer.customer_call_history_form',['customer_id'=>$id,'id'=>base64_encode($row['id'])])}}">
                                                            <i class="ti ti-edit text-primary"></i>
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
                                        <div
                                            class="col-md-12 col-xl-6 d-flex justify-content-center justify-content-xl-end">
                                            <div class="dataTables_paginate paging_simple_numbers"
                                                id="DataTables_Table_0_paginate">
                                                {!! pagination($num_rows, $per_page, $page, $url) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.common.footer')
        <script>

        </script>
        @include('admin.common.end')