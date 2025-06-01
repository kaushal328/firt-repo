@include('admin.common.header')
<?php

$admin_id = session('admin');
?>
<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h4 class="mb-0"><span class="text-muted fw-light">Dashboard / </span> <a href="{{url('admin/customer')}}">Customer</a> / Income Details</h4>
        <div>
            <a href="{{url('admin/customer')}}" class="btn btn-primary">Back</a>
        </div>
    </div>
    <div class="row">
        @include('admin.customers.partial.customer_details',['edit'=>$edit])

        <div class="col-md-8">
            @include('admin.customers.partial.nav',['id'=>$id,'active_tab'=>$active_tab])
            <div class="">
                <div class="tab-pane fade active show" id="navs-top-income" role="tabpanel">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Income Details</h5>

                            @if(!in_array(4,explode(',',$admin_id['role'])))
                            <a class="btn btn-sm btn-primary m-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Income" href="{{ route('admin.customer.income-form',['customer_id'=>$id,'id'=>base64_encode($income_details['id'] ?? 'null')])}}">
                                @if($income_details)
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
                                    @if(isset($income_details) && !empty($income_details))
                                    <tr>
                                        <td><strong>Salary</strong></td>
                                        <td>₹ {{number_format($income_details['salary'])}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Business Income</strong></td>
                                        <td>₹ {{number_format($income_details['business_income'])}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Other Income</strong></td>
                                        <td>₹ {{number_format($income_details['business_income'])}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Family Income</strong></td>
                                        <td>₹ {{number_format($income_details['family_support'])}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>
                                                <h5>Total (Per Month)</h5>
                                            </strong></td>
                                        <td>
                                            <h5>₹ {{number_format($income_details['total_income'])}}</h5>
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td><strong>Salary</strong></td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Business Income</strong></td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Other Income</strong></td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Family Income</strong></td>
                                        <td>-</td>
                                    <tr>
                                        <td><strong>Total (Per Month)</strong></td>
                                        <td>-</td>
                                    </tr>
                                    </tr>
                                    @endif



                                </tbody>
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