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
                            <h5 class="card-title">Employment Qualification Details</h5>

                            <a class="btn btn-sm btn-primary m-1" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-original-title="Employment Qualification"
                                href="{{ route('admin.customer.employee_qual_form',['customer_id'=>$id,'id'=>base64_encode($emp_qualification['id'] ?? base64_encode(0))])}}">
                                @if(!empty($emp_qualification))
                                Add qualification
                                @else
                                Add qualification
                                @endif
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td><strong>Education Status:</strong></td>
                                                <td>
                                                    {{$emp_qualification->education_status ?? "-"}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Employment Status:</strong></td>
                                                <td>
                                                    {{$emp_qualification->employee_status->employee_status_name ?? "-"}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>How long with employer :</strong></td>
                                                <td>
                                                    {{$emp_qualification->employee_duration->duration ?? "-"}}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><strong>Office Street:</strong></td>
                                                <td>
                                                    {{$emp_qualification->office_street ?? "-"}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Office City :</strong></td>
                                                <td>
                                                    {{$emp_qualification->office_city ?? "-"}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Office Pincode:</strong></td>
                                                <td>
                                                    {{$emp_qualification->office_pincode ?? "-"}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Office State :</strong></td>
                                                <td>
                                                    {{$emp_qualification->office_state ?? "-"}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Employment Firm:</strong></td>
                                                <td>
                                                    {{$emp_qualification->employment_firm ?? "-"}}
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