@include('admin.common.header')
<?php

$admin_id = session('admin');
?>
<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h4 class="mb-0"><span class="text-muted fw-light">Dashboard / </span> <a href="{{url('admin/customer')}}">Customer</a> / Personal Details</h4>
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
                            <h5 class="card-title">Personal Details</h5>
                            <a class="btn btn-sm btn-primary m-1" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-original-title="Personal Details"
                                href="{{ route('admin.customer.personal_details_form',['customer_id'=>$id,'id'=>base64_encode($perosnal_detail['id'] ?? base64_encode(0))])}}">
                                @if(!empty($perosnal_detail))
                                Edit Personal Details
                                @else
                                Add Personal Details
                                @endif
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td><strong>Next salary payment date:</strong></td>
                                                <td>
                                                    {{$perosnal_detail->next_salary_date ?? "-"}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Whatsapp Number:</strong></td>
                                                <td>
                                                    {{$perosnal_detail->whatapp_no ?? "-"}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Aadhar card :</strong></td>
                                                <td>
                                                    {{$perosnal_detail->addhar_no ?? "-"}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Pancard:</strong></td>
                                                <td>
                                                    {{$perosnal_detail->pan_card_no ?? "-"}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Marital Status:</strong></td>
                                                <td>
                                                    {{$perosnal_detail->marital_status ?? "-"}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Date of Birth:</strong></td>
                                                <td>
                                                    {{$perosnal_detail->date_of_birth ?? "-"}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Age of Children:</strong></td>
                                                <td>
                                                    {{$perosnal_detail->children_age ?? "-"}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Number of Children:</strong></td>
                                                <td>
                                                    {{$perosnal_detail->no_children ?? "-"}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Salary Account:</strong></td>
                                                <td>
                                                    {{$perosnal_detail->salary_bank->creditors_name ?? "-"}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>ECS Account:</strong></td>
                                                <td>
                                                    {{$perosnal_detail->ecs_account_bank->creditors_name ?? "-"}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Change Salary Account:</strong></td>
                                                <td>
                                                {{ optional($perosnal_detail)->change_salary_account_id == 1 ? "yes" : "no" }}

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