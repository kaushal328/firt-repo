@include('admin.common.header')
<?php

$admin_id = session('admin');
?>
<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h4 class="mb-0"><span class="text-muted fw-light">Dashboard / </span> <a href="{{url('admin/customer')}}">Customer</a> / Expense Details</h4>
        <div>
            <a href="{{url('admin/customer')}}" class="btn btn-primary">Back</a>
        </div>
    </div>
    <div class="row">
        @include('admin.customers.partial.customer_details',['edit'=>$edit])
        <div class="col-md-8">
            @include('admin.customers.partial.nav',['id'=>$id,'active_tab'=>$active_tab])
            <div class="tab-pane fade  active show" id="navs-top-expense" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Expense Details</h5>
                                @if(!in_array(4,explode(',',$admin_id['role'])))
                                <a class="btn btn-sm btn-primary m-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Expense" href="{{ route('admin.customer.expense-form',['customer_id'=>$id,'id'=>base64_encode($expense_details['id'] ?? 'null')])}}">
                                    @if(!empty($expense_details))
                                    Edit
                                    @else
                                    Add
                                    @endif
                                </a>
                                @endif
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">

                                    <tbody>
                                        @if(!empty($expense_details))
                                        <tr>
                                            <td colspan="2" class="text-center"><strong>Living Expenses</strong></td>

                                        </tr>
                                        <tr>
                                            <td><strong>Rent/Maintenance (Per Month)</strong></td>
                                            <td>₹ {{number_format($expense_details['rent']) ?? ""}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Grocery Expenses (Per Month)</strong></td>
                                            <td>₹ {{number_format($expense_details['grocery']) ?? ""}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Electricity Bill (Per Month)</strong></td>
                                            <td>₹ {{number_format($expense_details['electricity_bill']) ?? ""}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Gas Bill (Per Month)</strong></td>
                                            <td>₹ {{number_format($expense_details['gas_bill']) ?? ""}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Phone Bill (Per Month)</strong></td>
                                            <td>₹ {{number_format($expense_details['phone_bill']) ?? ""}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Other Utility (Per Month)</strong></td>
                                            <td>₹ {{number_format($expense_details['other_utility']) ?? ""}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Total Living Expenses (Per Month)</strong></td>
                                            <td>₹ {{number_format($expense_details['total_living_expense']) ?? ""}}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="2" class="text-center"><strong>Lifestyle Expenses</strong></th>
                                        </tr>
                                        <tr>
                                            <td><strong>Travel/Fuel (Per Month)</strong></td>
                                            <td>₹ {{number_format($expense_details['travel']) ?? ""}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Digital Subscription (Per Month)</strong></td>
                                            <td>₹ {{number_format($expense_details['digital_subcription']) ?? ""}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Dining Out (Per Month)</strong></td>
                                            <td>₹ {{number_format($expense_details['dining_out']) ?? ""}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>House Help (Per Month)</strong></td>
                                            <td>₹ {{number_format($expense_details['house_help']) ?? ""}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Outing (Per Month)</strong></td>
                                            <td>₹ {{number_format($expense_details['outing']) ?? ""}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Total Lifestyle Expenses (Per Month)</strong></td>
                                            <td>₹ {{number_format($expense_details['total_lifestyle_expense']) ?? ""}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>
                                                    <h5>TOTAL EXPENSES (Per Month)</h5>
                                                </strong></td>
                                            <td>
                                                <h5>₹ {{number_format($expense_details['total_expenses']) ?? ""}}</h5>
                                            </td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td colspan="2" class="text-center"><strong>Living Expenses</strong></td>

                                        </tr>
                                        <tr>
                                            <td><strong>Rent/Maintenance (Per Month)</strong>-</td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Grocery Expenses (Per Month)</strong></td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Electricity Bill (Per Month)</strong></td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Gas Bill (Per Month)</strong></td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Phone Bill (Per Month)</strong></td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Other Utility (Per Month)</strong></td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Total Living Expenses (Per Month)</strong></td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <th colspan="2" class="text-center"><strong>Lifestyle Expenses</strong></th>
                                        </tr>
                                        <tr>
                                            <td><strong>Travel/Fuel (Per Month)</strong></td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Digital Subscription (Per Month)</strong></td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Dining Out (Per Month)</strong></td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td><strong>House Help (Per Month)</strong></td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Outing (Per Month)</strong></td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Total Lifestyle Expenses (Per Month)</strong></td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td><strong>TOTAL EXPENSES (Per Month)</strong></td>
                                            <td>-</td>
                                        </tr>
                                        @endif
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