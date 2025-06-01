@include('admin.common.header')
<?php

use App\Models\MasterStatus;

$leadStage = MasterStatus::where(['id' => $edit['lead']['status']])->first();


?>
<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h4 class="mb-0"><span class="text-muted fw-light">Dashboard / </span> Customer / Customer Details</h4>
        <div>
            <a href="{{url('admin/customer')}}" class="btn btn-primary">Back</a>
        </div>
    </div>


    <div class="row">
        @include('admin.customers.partial.customer_details',['edit'=>$edit])
        <div class="col-md-8">
            @include('admin.customers.partial.nav',['id'=>$id,'active_tab'=>$active_tab])
            <div class="tab-content">
                <div class="tab-pane fade  active show" id="customer-details" role="tabpanel">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Customer Details</h5>
                            <a class="btn btn-sm btn-primary m-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Customers" href="{{ url('admin/customer/form/' . base64_encode($edit['id'])) }}">
                                Edit
                            </a>
                        </div>

                    </div>
                </div>
                <div class="tab-pane fade {{ $type == 'income' ? 'active show' : '' }}" id="navs-top-income" role="tabpanel">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Income Details</h5>


                            <a class="btn btn-sm btn-primary m-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Income" href="{{url('admin/customer/income-form/'. base64_encode($edit['id']))}}">
                                Edit
                            </a>

                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">


                                <tbody>
                                    @if(!empty($income_details))
                                    <tr>
                                        <td><strong>Salary</strong></td>
                                        <td>₹ {{$income_details['salary']}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Business Income</strong></td>
                                        <td>₹ {{$income_details['business_income']}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Other Income</strong></td>
                                        <td>₹ {{$income_details['business_income']}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Family Income</strong></td>
                                        <td>₹ {{$income_details['family_support']}}</td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td><strong>Salary</strong></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Business Income</strong></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Other Income</strong></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Family Income</strong></td>
                                        <td></td>
                                    </tr>
                                    @endif



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade  {{ $type == 'expense'  ? 'active show' : '' }}" id="navs-top-expense" role="tabpanel">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">Expense Details</h5>

                                    <a class="btn btn-sm btn-primary m-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Expense" href="{{url('admin/customer/expense-form/'. base64_encode($edit['id']))}}">
                                        Edit
                                    </a>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <table class="table table-bordered">

                                            <tbody>
                                                @if(!empty($expense_details))
                                                <tr>
                                                    <td colspan="2" class="text-center"><strong>Living Expenses</strong></td>

                                                </tr>
                                                <tr>
                                                    <td><strong>Rent/Maintenance (Per Month)</strong></td>
                                                    <td>₹ {{$expense_details['rent'] ?? ""}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Grocery Expenses (Per Month)</strong></td>
                                                    <td>₹ {{$expense_details['grocery'] ?? ""}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Electricity Bill (Per Month)</strong></td>
                                                    <td>₹ {{$expense_details['electricity_bill'] ?? ""}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Gas Bill (Per Month)</strong></td>
                                                    <td>₹ {{$expense_details['gas_bill'] ?? ""}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Phone Bill (Per Month)</strong></td>
                                                    <td>₹ {{$expense_details['phone_bill'] ?? ""}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Other Utility (Per Month)</strong></td>
                                                    <td>₹ {{$expense_details['other_utility'] ?? ""}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Total Living Expenses (Per Month)</strong></td>
                                                    <td>₹ {{$expense_details['total_living_expense'] ?? ""}}</td>
                                                </tr>
                                                <tr>
                                                    <th colspan="2" class="text-center"><strong>Lifestyle Expenses</strong></th>
                                                </tr>
                                                <tr>
                                                    <td><strong>Travel/Fuel (Per Month)</strong></td>
                                                    <td>₹ {{$expense_details['travel'] ?? ""}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Digital Subscription (Per Month)</strong></td>
                                                    <td>₹ {{$expense_details['digital_subcription'] ?? ""}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Dining Out (Per Month)</strong></td>
                                                    <td>₹ {{$expense_details['dining_out'] ?? ""}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>House Help (Per Month)</strong></td>
                                                    <td>₹ {{$expense_details['house_help'] ?? ""}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Outing (Per Month)</strong></td>
                                                    <td>₹ {{$expense_details['outing'] ?? ""}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Total Lifestyle Expenses (Per Month)</strong></td>
                                                    <td>₹ {{$expense_details['total_lifestyle_expense'] ?? ""}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>TOTAL EXPENSES (Per Month)</strong></td>
                                                    <td>₹ {{$expense_details['total_expenses'] ?? ""}}</td>
                                                </tr>
                                                @else
                                                <tr>
                                                    <td colspan="2" class="text-center"><strong>Living Expenses</strong></td>

                                                </tr>
                                                <tr>
                                                    <td><strong>Rent/Maintenance (Per Month)</strong></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Grocery Expenses (Per Month)</strong></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Electricity Bill (Per Month)</strong></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Gas Bill (Per Month)</strong></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Phone Bill (Per Month)</strong></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Other Utility (Per Month)</strong></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Total Living Expenses (Per Month)</strong></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="2" class="text-center"><strong>Lifestyle Expenses</strong></th>
                                                </tr>
                                                <tr>
                                                    <td><strong>Travel/Fuel (Per Month)</strong></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Digital Subscription (Per Month)</strong></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Dining Out (Per Month)</strong></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>House Help (Per Month)</strong></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Outing (Per Month)</strong></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Total Lifestyle Expenses (Per Month)</strong></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>TOTAL EXPENSES (Per Month)</strong></td>
                                                    <td></td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade {{ $type == 'loan'  ? 'active show' : '' }}" id="navs-top-loans" role="tabpanel">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Loan Details</h5>
                            <a class="btn btn-sm btn-primary m-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Customers Loans" href="{{url('admin/customer/loan-form/'. base64_encode($edit['id']))}}">
                                Edit
                            </a>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">

                            </div>
                            <table class="table table-border">
                                <thead class="table-light">
                                    <tr>

                                        <th>Loan Id</th>
                                        <th>Loan No</th>
                                        <th>Loan Type</th>
                                        <th>Loan Amount</th>
                                        <th>Monthly Emi</th>
                                        <th>EMI Date</th>
                                        <th>Last EMI Date</th>
                                        <th>Outstanding Loan Amount (INR)</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @if(!empty($loan_details) && $loan_details->count() > 0)
                                    @foreach($loan_details as $row)
                                    <tr>
                                        <td>#{{$row->loan_id}}</td>
                                        <td>{{$row->loan_number}}</td>
                                        <td>{{$row->loan_id}}</td>
                                        <td>{{$row->customer_loan->name}}</td>
                                        <td>₹ {{ number_format($row->monthly_emi, 0) }}</td> <!-- Removes decimals -->
                                        <td>{{ date('d-m-Y', strtotime($row->emi_date)) }}</td>
                                        <td>{{ date('d-m-Y', strtotime($row->last_emi_payment_date)) }}</td>
                                        <td>₹ {{ number_format($row->outstanding_loan_amt, 0) }}</td> <!-- Removes decimals -->
                                    </tr>

                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="8">No data found</td>
                                    </tr>
                                    @endif
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade {{ $type == 'plan' ? 'active show' : '' }}" id="navs-top-plans" role="tabpanel">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Plan Details</h5>
                            <a class="btn btn-sm btn-primary m-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Plan Details" href="">
                                Edit
                            </a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">


                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade {{ $type == 'payment-details' ? 'active show' : '' }}" id="navs-top-payment-history" role="tabpanel">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Payments Details</h5>
                            <a class="btn btn-sm btn-primary m-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Payment Details" href="">
                                Edit
                            </a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">


                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        @include('admin.common.footer')
        <script>

        </script>


        @include('admin.common.end')