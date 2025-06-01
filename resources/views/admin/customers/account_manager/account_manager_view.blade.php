@include('admin.common.header')
<?php

$admin_id = session('admin');
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h4 class="mb-0"><span class="text-muted fw-light">Dashboard / </span> <a
                href="{{ url('admin/customer') }}">Customer</a> / Account Manager</h4>
        <div>
            <a href="{{ url('admin/customer') }}" class="btn btn-primary">Back</a>
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
                            <h5 class="card-title">Account Manager</h5>
                            <a class="btn btn-sm btn-primary m-1" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-original-title="Account Manager"
                                href="{{ route('admin.customer.account_manager_form', ['customer_id' => $id, 'id' => base64_encode($account_manager['id'] ?? base64_encode(0))]) }}">
                                @if (!empty($account_manager))
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
                                                <td><strong>Account Manager Name:</strong></td>
                                                <td>
                                                    @if(isset($account_manager) &&
                                                    !empty($account_manager->account_manager))
                                                    {{$account_manager->account_manager->first_name ." ".$account_manager->account_manager->last_name }}
                                                    @else
                                                    ---
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Legal Manager Name:</strong></td>
                                                <td>
                                                    @if( isset($account_manager) &&
                                                    !empty($account_manager->legal_manager))
                                                    {{$account_manager->legal_manager->first_name ." ".$account_manager->legal_manager->last_name }}
                                                    @else
                                                    ---
                                                    @endif
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
       
        @include('admin.common.end')