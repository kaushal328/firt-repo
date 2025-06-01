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
            <div class="">
                <div class="tab-pane fade active show" id="navs-top-loans" role="tabpanel">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Customer Overview</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td><strong>Total Income:</strong></td>
                                                <td>
                                                    @if($total_income )
                                                    ₹ {{ number_format($total_income) }}
                                                    @else
                                                    -
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total Expense:</strong></td>
                                                <td>
                                                    @if($total_expense)
                                                    ₹ {{ number_format($total_expense) }}
                                                    @else
                                                    -
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Loan Type:</strong></td>
                                                <td>
                                                    @if(isset($loan_type->loan_type->name) &&
                                                    $loan_type->loan_type->name)
                                                    {{ $loan_type->loan_type->name }}
                                                    @else
                                                    -
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total Outstanding Amount:</strong></td>
                                                <td>
                                                    @if(isset($total_outstanding_amount) && $total_outstanding_amount)
                                                    ₹ {{ number_format($total_outstanding_amount) }}
                                                    @else
                                                    -
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total EMI:</strong></td>
                                                <td>
                                                    @if(isset($current_emi) && $current_emi)
                                                    ₹ {{ number_format($current_emi) }}
                                                    @else
                                                    -
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total Loan Amount:</strong></td>
                                                <td>
                                                    @if(isset($total_loan_amt) && $total_loan_amt)
                                                    ₹ {{ number_format($total_loan_amt) }}
                                                    @else
                                                    -
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Monthly Saving:</strong></td>
                                                <td>
                                                    @if(isset($monthly_saving) && $monthly_saving)
                                                    ₹ {{ number_format($monthly_saving) }}
                                                    @else
                                                    -
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Actually Monthly Saving:</strong></td>
                                                <td>
                                                    @if(isset($actually_monthly_saving) && $actually_monthly_saving)
                                                    ₹ {{ number_format($actually_monthly_saving) }}
                                                    @else
                                                    -
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Actually Monthly Saving:</strong></td>
                                                <td>
                                                    @if(isset($actually_monthly_saving) && $actually_monthly_saving)
                                                    ₹ {{ number_format($actually_monthly_saving) }}
                                                    @else
                                                    -
                                                    @endif
                                                </td>
                                            </tr>

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Customer Plan Overview</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td><strong>Plan Name:</strong></td>
                                                <td>

                                                    {{ $customer_plan->plans->offer_name ?? "" }}

                                                </td>
                                            </tr>
                                            <tr>
                                                @if($customer_plan->plans->offer_name == "Onetime Settlement")
                                                <td><strong>Settlement Amount:</strong></td>
                                                <td>
                                                    ₹ {{ number_format($customer_plan->settlement_amount)}}
                                                </td>
                                                @else
                                                <td><strong>Plan Active Date:</strong></td>
                                                <td>
                                                    {{ date('d-m-Y',strtotime($customer_plan->emi_start_date)) ?? ""}}
                                                </td>
                                                @endif
                                            </tr>
                                            <tr>
                                                @if($customer_plan->plans->offer_name == "Onetime Settlement")
                                              
                                                <td><strong>Settlement Percentage (%):</strong></td>
                                                <td>
                                                    {{ $customer_plan->settlement_percentage ?? "" }}
                                                </td>
                                                @else
                                                <td><strong>Tenure (Months):</strong></td>
                                                <td>
                                                    {{ $customer_plan->tenure ?? "" }} Months
                                                </td>
                                              
                                                @endif
                                            </tr>
                                            <tr>
                                                @if($customer_plan->plans->offer_name == "Onetime Settlement")
                                                
                                                @else
                                                <td><strong>EMI Amount:</strong></td>
                                                <td>
                                                    ₹ {{ number_format($customer_plan->total_emi ?? "") }}
                                                </td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td><strong>Plan Status:</strong></td>
                                                <td>
                                                    <span class="badge  bg-success">{{ $customer_plan->is_active == 1 ? "Active" :"De-active" }}</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                @if($customer_plan->plans->offer_name == "Onetime Settlement")
                                                
                                                @else
                                                <td><strong>Plan End Date:</strong></td>
                                                <td>
                                                    {{ date('d-m-Y',strtotime($customer_plan->emi_end_date)) ?? "" }}
                                                </td>
                                                @endif
                                            </tr>



                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.common.footer')

        @include('admin.common.end')