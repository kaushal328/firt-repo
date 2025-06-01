@include('admin.common.header')
<?php

$admin_id = session('admin');
?>
<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h4 class="mb-0"><span class="text-muted fw-light">Dashboard / </span> <a href="{{url('admin/customer')}}">Customer</a> / Loan Details</h4>
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
                            <h5 class="card-title">Loan History</h5>

                            @if(!in_array(4,explode(',',$admin_id['role'])))
                            <a class="btn btn-sm btn-primary m-1" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-original-title="Customer Loan"
                                href="{{ route('admin.customer.loan-form',['customer_id'=>$id,'id'=>base64_encode(0)])}}">
                                Add New Loan
                            </a>

                            @endif
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered w-100">
                                    <thead class="table-light text-nowrap">
                                        <tr>
                                            <th>No</th>
                                            <th>Loan Id</th>
                                            <th>Loan No</th>
                                            <th>Loan Type</th>
                                            <th>Bank Type</th>
                                            <th>Creditor Profile Name</th>
                                            <th>Loan Amount</th>
                                            <th>Monthly EMI</th>
                                            <th>EMI Start Date</th>
                                            <th>Last EMI Date</th>
                                            <th>Outstanding Loan Amount (INR)</th>
                                            @if(!in_array(4,explode(',',$admin_id['role'])))
                                            <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php
                                            $count = 0;
                                        ?>
                                        @if(!empty($loan_details) && $loan_details->count() > 0)

                                        @foreach($loan_details as $row)
                                        <tr data-id="{{ base64_encode($row['id']) }}" id="{{$id}}">
                                        <td class="p-3">{{++$count}}</td>
                                            <td class="p-3">#{{$row->loan_id}}</td>
                                            <td class="p-3">{{$row->loan_number ?? ""}}</td>
                                            <td class="p-3">{{$row->loan_type->name ?? ""}}</td>
                                            <td class="p-3">{{$row->bank_creditor->bank_type->bank_type_name ?? "---"}}</td>
                                            <td class="p-3">{{$row->bank_creditor->creditors_name ?? "---"}}</td>

                                            <td class="p-3">₹ {{number_format($row->loan_amt)}}</td>
                                            <td class="p-3">₹ {{ number_format($row->monthly_emi) }}</td>
                                            <td class="p-3">{{ date('d-m-Y', strtotime($row->emi_date)) }}</td>
                                            <td class="p-3">{{ date('d-m-Y', strtotime($row->last_emi_payment_date)) }}</td>
                                            <td class="p-3">₹ {{ number_format($row->outstanding_loan_amt) }}</td>
                                            @if(!in_array(4,explode(',',$admin_id['role'])))
                                            <td class="p-3">
                                                <div class="d-flex align-items-sm-center justify-content-sm-center">
                                                    <a class="btn btn-sm btn-icon m-1" href="{{ route('admin.customer.loan-form',['customer_id'=>$id,'id'=>base64_encode($row['id'])])}}">
                                                        <i class="ti ti-edit text-primary"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-icon m-1 delete-record" href="javascript:void(0)">
                                                        <i class="ti ti-trash text-danger"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="9" class="p-3">No data found</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                    </div>
                    @if(!empty($total_outstanding_amount) && !empty($total_loan_amt) && !empty($current_emi))
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Customer Total Loan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Total Outstanding amount:</strong> ₹ {{number_format($total_outstanding_amount) ?? 0}}
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Total Loan Amount:</strong> ₹ {{number_format($total_loan_amt) ?? 0}}
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Total Emi:</strong> ₹ {{number_format($current_emi) ?? 0}}
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Bank Type:</strong> {{$bank_type->bank_creditor->bank_type->bank_type_name ?? ""}}
                                </div>
                                <div class="col-md-8">
                                    <p><strong>Creditor Profile Name:</strong> {{$bank_type->bank_creditor->creditors_name ?? ""}}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

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
                    const url = "{{ route('admin.customer.loan.delete') }}";

                    $.post(url, {
                        id: _this.closest('tr').attr("data-id"),
                        customer_id: _this.closest('tr').attr("id")
                    }, function(res) {
                        processAjaxResponse(res)
                        if (res.status == 1) {
                            _this.closest('tr').remove();
                        }
                    }, 'json')
                }
            })
        </script>
        @include('admin.common.end')