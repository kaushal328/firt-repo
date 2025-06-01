@include('admin.common.header')
<?php

$admin_id = session('admin');
?>
<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h4 class="mb-0"><span class="text-muted fw-light">Dashboard / </span> <a
                href="{{url('admin/customer')}}">Customer</a> / Loan Details</h4>
        <div>
            <a href="{{url('admin/customer')}}" class="btn btn-primary">Back</a>
        </div>
    </div>

    <div class="row">
        @include('admin.customers.partial.customer_details')
        <div class="col-md-8">
            @include('admin.customers.partial.nav', ['id' => $id, 'active_tab' => $active_tab])
            <div class="tab-pane fade active show" id="navs-top-loans" role="tabpanel">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Settlement Done</h5>
                        @if(!empty($bank_creditor_empty) && !empty($bank_type_empty))
                        <a class="btn btn-sm btn-primary m-1" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-original-title="Settlement"
                            href="{{ route('admin.customer.settlement_form',['customer_id'=>$id,'id'=>base64_encode(0)])}}">
                            Add New Settlement
                        </a>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered w-100">
                                <thead class="table-light text-nowrap">
                                    <tr>
                                        <th>No</th>
                                        <th>Loan No</th>
                                        <th>Bank Name</th>
                                        <th>Outstanding Loan Amount</th>
                                        <th>Settlement Offer</th>
                                        <th>Settlement Offer Amount </th>
                                        <th>Status</th>
                                        <th>Settlement Date</th>
                                        <th>Payment Amount</th>
                                        <th>Remark</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php
                                        $count = 0;
                                    ?>
                                    @if(!empty($customer_settlement) && $customer_settlement->count() > 0)

                                    @foreach($customer_settlement as $row)
                                    <tr data-id="{{ base64_encode($row['id']) }}" id="{{$id}}">
                                        <td>{{++$count}}</td>
                                        <td>{{$row->customers_loan->loan_id}}</td>
                                        <td>{{$row->bank_creditor->creditors_name}}</td>

                                        <td>₹ {{number_format($row->outstanding_loan_amount)}}</td>
                                        <td>{{$row->settlement_offer}} %</td>
                                        <td>₹ {{number_format($row->settlement_offer_amount)}}</td>
                                        <td>{{$row->status}}</td>
                                        <td>{{date("Y-m-d",strtotime($row->settlement_date))}}</td>


                                        <td>₹ {{number_format($row->payment_amount)}}</td>
                                        <td>{{$row->remark}}</td>
                                        <td class="p-3">
                                            <div class="d-flex align-items-sm-center justify-content-sm-center">
                                                <a class="btn btn-sm btn-icon m-1"
                                                    href="{{ route('admin.customer.settlement_form',['customer_id'=>$id,'id'=>base64_encode($row['id'])])}}">
                                                    <i class="ti ti-edit text-primary"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5">No data found</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div> <!-- table-responsive -->
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Settlement Offer</h5>
                        @if(!empty($bank_creditor_empty) && !empty($bank_type_empty))
                        <a class="btn btn-sm btn-primary m-1" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-original-title="Settlement Offer"
                            href="{{ route('admin.customer.customer_settlement_offer_form',['customer_id'=>$id,'id'=>base64_encode(0)])}}">
                            Add New Settlement Offer
                        </a>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered w-100">
                                <thead class="table-light text-nowrap">
                                    <tr>
                                        <th>No</th>
                                        <th>Loan No</th>
                                        <th>Bank Name</th>
                                        <th>Outstanding Loan Amount</th>
                                        <th>Settlement Offer (%)</th>
                                        <th>Settlement Offer Amount</th>
                                        <th>Settlement Offer Last Date</th>
                                        <th>Payment Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php
                                        $count = 0;
                                    ?>
                                    @if(!empty($customer_settlement_offer) && $customer_settlement_offer->count() > 0)

                                    @foreach($customer_settlement_offer as $row)
                                    <tr data-id="{{ base64_encode($row['id']) }}" id="{{$id}}">
                                        <td>{{++$count}}</td>
                                        <td>{{$row->customers_loan->loan_id}}</td>
                                        <td>{{$row->bank_creditor->creditors_name ?? '-'}}</td>
                                        <td> ₹ {{number_format($row->outstanding_loan_amount)}}</td>
                                        <td>{{$row->settlement_offer}} %</td>
                                        <td>₹ {{number_format($row->settlement_offer_amount )}}</td>
                                        <td>{{$row->settlement_offer_last_date}}</td>
                                        <td>₹ {{number_format($row->payment_amount)}}</td>
                                        <td class="p-3">
                                            <div class="d-flex align-items-sm-center justify-content-sm-center">
                                                <a class="btn btn-sm btn-icon m-1"
                                                    href="{{ route('admin.customer.customer_settlement_offer_form',['customer_id'=>$id,'id'=>base64_encode($row['id'])])}}">
                                                    <i class="ti ti-edit text-primary"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5">No data found</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div> <!-- table-responsive -->
                    </div>
                </div>
            </div>
        </div>
        @include('admin.common.footer')
        <script>
            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            })
            $(document).on('click', '.delete-record', function (e) {
                e.preventDefault();
                if (confirm("Are you sure you want to delete this record?")) {
                    const _this = $(this)
                    const url = "{{ route('admin.customer.loan.delete') }}";
                    $.post(url, {
                        id: _this.closest('tr').attr("data-id"),
                        customer_id: _this.closest('tr').attr("id")
                    }, function (res) {
                        processAjaxResponse(res)
                        if (res.status == 1) {
                            _this.closest('tr').remove();
                        }
                    }, 'json')
                }
            })
        </script>
        @include('admin.common.end')