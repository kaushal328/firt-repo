@include('admin.common.header')
<?php

$admin_id = session('admin');
?>
<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h4 class="mb-0"><span class="text-muted fw-light">Dashboard / </span> <a
                href="{{url('admin/customer')}}">Customer</a> / Transfer To</h4>
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
                            <h5 class="card-title">Transfer To</h5>
                            <a class="btn btn-sm btn-primary m-1" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-original-title="Transfer"
                                href="{{ route('admin.customer.customer_transfer_form',['customer_id'=>$id,'id'=>base64_encode($customer_transfer['id'] ?? base64_encode(0))])}}">
                                @if(!empty($customer_transfer))
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
                                                <td><strong>Transfer To Agent Name:</strong></td>
                                                <td>
                                                    {{ isset($customer_transfer->transfer_to_agent) 
                                                    ? $customer_transfer->transfer_to_agent->first_name . " " . $customer_transfer->transfer_to_agent->last_name : '--' }}

                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Transfer From Agent Name:</strong></td>
                                                <td>
                                                    {{ isset($customer_transfer->transfer_from_agent)   ? $customer_transfer->transfer_from_agent->first_name . " " . $customer_transfer->transfer_from_agent->last_name  : '--' }}

                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Transfer Date:</strong></td>
                                                <td>
                                                    {{$customer_transfer->transfer_date ?? '--'}}
                                                </td>

                                            </tr>
                                            <tr>
                                                <td><strong>Description:</strong></td>
                                                <td>
                                                    {{$customer_transfer->transfer_text ?? '--'}}
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