@include('admin.common.header')
<?php

$admin_id = session('admin');
?>
<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h4 class="mb-0"><span class="text-muted fw-light">Dashboard / </span> <a
                href="{{url('admin/customer')}}">Customer</a> / Customer Status</h4>
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
                            <h5 class="card-title">Customer Status</h5>
                            <a class="btn btn-sm btn-primary m-1" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-original-title="Customer Status"
                                href="{{ route('admin.customer.customer_status_form',['customer_id'=>$id,'id'=>base64_encode($customer_status['id'] ?? base64_encode(0))])}}">
                                @if(!empty($customer_status))
                                Edit
                                @else
                                Add
                                @endif
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <tbody>


                                            <tr>
                                                <td><strong>Plan Status:</strong></td>
                                                <td>
                                                    {{ isset($customer_status->plan_status) 
                                                    ? $customer_status->plan_status->status_name : '--' }}

                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Payment Status:</strong></td>
                                                <td>
                                                    {{ isset($customer_status->payment_status)   ? $customer_status->payment_status->payment_status_name   : '--' }}

                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total Full Payment - (Done Payment Number):</strong></td>
                                                <td>
                                                    {{$customer_status->payment_done_number ?? '--'}}
                                                </td>

                                            </tr>
                                            <tr>
                                              <td><strong>Total Full Payment (Value):</strong></td>
<td>
    @if($customer_status && isset($customer_status->payment_done_value))
        {{ number_format($customer_status->payment_done_value) }}
    @else
        --
    @endif
</td>

                                            </tr>
                                            <tr>
                                                <td><strong>Next Payment Date:</strong></td>
                                                <td>
                                                    {{$customer_status->next_payment_date ?? '--'}}
                                                </td>
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
        <script>

        </script>
        @include('admin.common.end')