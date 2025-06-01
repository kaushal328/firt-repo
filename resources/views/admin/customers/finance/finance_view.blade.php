@include('admin.common.header')
<?php

$admin_id = session('admin');
?>
<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h4 class="mb-0"><span class="text-muted fw-light">Dashboard / </span> <a href="{{url('admin/customer')}}">Customer</a> / Reason for financial Difficulty</h4>
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
                            <h5 class="card-title">Reason for financial Difficulty</h5>
                            <a class="btn btn-sm btn-primary m-1" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-original-title="Finance"
                                href="{{ route('admin.customer.customer_finance_form',['customer_id'=>$id,'id'=>base64_encode($finance_view['id'] ?? base64_encode(0))])}}">
                                @if(!empty($finance_view))
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
                                                <td><strong>Reason:</strong></td>
                                                <td>
                                                    {{$finance_view->state_reason ?? "-"}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Reason For Refund:</strong></td>
                                                <td>
                                                    {{$finance_view->refund_reason->refund_reason ?? "-"}}
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