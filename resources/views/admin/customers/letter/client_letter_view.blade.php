@include('admin.common.header')
@php
$admin_id = session('admin');
@endphp
<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h4 class="mb-0"><span class="text-muted fw-light">Dashboard / </span> <a
                href="{{url('admin/customer')}}">Customer</a> / Letter</h4>
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
                            <h5 class="card-title">Customer Letter</h5>
                            @if(empty($customer_plan))
                            <div>
                                <span class="badge bg-warning text-dark">Plan Inactive. To send a letter, please
                                    activate the plan first.</span>
                            </div>
                            @endif
                        </div>

                        <div class="ajax-msg m-2"></div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-12">

                                    <div class="table-responsive">
                                        @if(!empty($customer_plan))
                                        <table class="table table-bordered w-100">
                                            <thead class="table-light text-nowrap">
                                                <tr>
                                                    <th>Letter Type</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="">
                                                @foreach($clientLetter as $row)
                                                <tr>
                                                    <td class="p-3">{{$row->letter_type_name}}</td>
                                                    <td class="p-3">
                                                        <button class="btn btn-primary btn-sm view-letter" type="button"
                                                            data-letter="{{$row->letter_type_name}}"
                                                            data-id="{{ $row->id }}" data-type="view">View</button>
                                                        <button class="btn btn-primary btn-sm view-letter" type="button"
                                                            data-letter="{{$row->letter_type_name}}"
                                                            data-id="{{ $row->id }}" data-type="edit">Edit</button>
                                                        <button class="btn btn-primary btn-sm send_email" type="button"
                                                            data-id="{{ $row->id }}" id="send_email">Send</button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(!empty($customer_plan) && !empty($list))
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Letter Logs </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                @php
                                if (count($list)) {
                                $starts_from = $per_page * ($page - 1) + 1;
                                $end_to = $starts_from + $per_page - 1;
                                if ($end_to > $num_rows) {
                                $end_to = $num_rows;
                                }
                                $entries_text = 'Showing ' . $starts_from . ' to ' . $end_to . ' of ' . $num_rows . '
                                entries';
                                } else {
                                $entries_text = 'No data found!';
                                }
                                @endphp
                                <table class="table table-bordered w-100">
                                    <thead class="table-light text-nowrap text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Letter Type</th>
                                            <th>Date & Time</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @php
                                        $count =0;
                                        @endphp
                                        @if(!$list->isEmpty())
                                        @foreach($list as $row)
                                        <tr>
                                            <td>{{++$count}}</td>
                                            <td>{{$row->letter_type->letter_type_name ?? ""}}</td>
                                            <td>{{date("d/m/Y",strtotime($row->send_date))}}</td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>

                                        </tr>
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
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Customer Letter</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="view-content"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary send_email" data-id="">Send
                        Email</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Customer Letter</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="edit-view-content"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary send_email" id="send_email" data-id="">Send
                        Email</button>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.common.footer')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.view-letter', function (e) {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        console.log(type)
        var customer_id = "{{base64_decode($id)}}";

        $.ajax({
            url: '{{route("admin.customer.view")}}',
            type: 'POST',
            data: {
                id: id,
                customer_id: customer_id
            },
            success: function (response) {
                if (response.status == 1) {
                    if (type == "edit") {
                        $('#exampleModalEdit .modal-body .edit-view-content').html('<textarea id="ckeditor"></textarea>');
                        $('#ckeditor').val(response.data.view);
                        $('#exampleModalEdit').find('.send_email').attr('data-id', response.data.letter_id);

                        CKEDITOR.replace('ckeditor');
                        $('#exampleModalEdit').modal('show');
                    } else {
                        $('#exampleModal .modal-body .view-content').html(response.data.view);
                        $('#exampleModal').find('.send_email').attr('data-id', response.data.letter_id);
                        $('#exampleModal').modal('show');
                    }

                } else {
                    console.log(response.status || 'Unable to load the content.');
                }
            },
            error: function () {
                console.log('An error occurred while loading the view.');
            }
        });
    });
    $(document).on('click', '.send_email', function (e) {
        e.preventDefault();
        var customer_letter_id = $(this).attr('data-id');
        var customer_id = "{{base64_decode($id)}}";
        var letter_type = $(this).attr('data-letter');
        $.ajax({
            url: '{{route("admin.customer.send_customer_email")}}',
            type: 'POST',
            data: {
                customer_letter_id: customer_letter_id,
                customer_id: customer_id
            },
            success: function (response) {
                if (response.status == 1) {
                    console.log(response.data);
                    $('#exampleModal').modal('hide');
                    processAjaxResponse(response, 1000);
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                } else {
                    console.log(response.msg || 'Unable to load the content.');
                }
            },
            error: function () {
                console.log('An error occurred while loading the view.');
            }
        });
    })
</script>

@include('admin.common.end')