@include('admin.common.header')
<?php

$admin_id = session('admin');
?>
<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h4 class="mb-0"><span class="text-muted fw-light">Dashboard / </span> <a href="{{url('admin/customer')}}">Customer</a> / Documents</h4>
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
                            <h5 class="card-title">Documents</h5>
                            <a class="btn btn-sm btn-primary m-1" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-original-title="Documents"
                                href="{{ route('admin.customer.documents_form',['customer_id'=>$id,'id'=>base64_encode($documents['id'] ?? base64_encode(0))])}}">
                                @if(!empty($documents))
                                Edit documents
                                @else
                                Add documents
                                @endif
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td><strong>The copy of the loan agreements:</strong></td>
                                                <td>
                                                    @if(isset($documents) && !empty($documents->loan_aggreement_document))
                                                    <a href="{{ url('storage/app/uploads/loan_aggreement_document/'.$documents->loan_aggreement_document) }}" target="_blank">View Document</a>
                                                    @else
                                                    ---
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Copy of credit file:</strong></td>
                                                <td>
                                                    @if( !empty($documents->credit_card_document))
                                                    <a href="{{ url('storage/app/uploads/credit_card_document/'.$documents->credit_card_document) }}" target="_blank">View Document</a>
                                                    @else
                                                    ---
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Proof of rent/housing loan :</strong></td>
                                                <td>
                                                    @if(isset($documents) && !empty($documents->house_loan_document))
                                                    <a href="{{ url('storage/app/uploads/house_loan_document/'.$documents->house_loan_document) }}" target="_blank">View Document</a>
                                                    @else
                                                    ---
                                                    @endif
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><strong>Copy of wage slips and proof of other incomes:</strong></td>
                                                <td>
                                                    @if(isset($documents) && !empty($documents->wage_slips_other_income_document))
                                                    <a href="{{ url('storage/app/uploads/wage_slips_other_income_document/'.$documents->wage_slips_other_income_document) }}" target="_blank">View Document</a>
                                                    @else
                                                    ---
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Aadhar card:</strong></td>
                                                <td>
                                                    @if(isset($documents) && !empty($documents->addhar_card_document))
                                                    <a href="{{ url('storage/app/uploads/addhar_card_document/'.$documents->addhar_card_document) }}" target="_blank">View Document</a>
                                                    @else
                                                    ---
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Pancard:</strong></td>
                                                <td>
                                                    @if(isset($documents) && !empty($documents->pancard_document))
                                                    <a href="{{ url('storage/app/uploads/pancard_document/'.$documents->pancard_document) }}" target="_blank">View Document</a>
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
        <script>

        </script>
        @include('admin.common.end')