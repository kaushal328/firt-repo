@include('admin.common.header')
<style>
    .flatpickr-calendar.hasTime.noCalendar.animate.arrowTop.arrowLeft.open {
        width: 22.5% !important;
    }
</style>
<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h4 class="mb-0"><span class="text-muted fw-light">Dashboard / </span> Customer / Documents</h4>
        <div>
            <a href="{{route('admin.customer.documents', ['id' => $id])}}" class="btn btn-primary">Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            @include('admin.customers.partial.customer')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="ajax-msg"></div>
                    <form class="form ajax-form" id="" method="POST" action="{{route('admin.customer.documents_save')}}">
                        @csrf
                        <input type="hidden" name="customer_id" value="{{$edit['customer_id'] ?? base64_decode($id) }}">
                        <input type="hidden" name="id" value="{{$edit['id'] ?? ''}}">
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="card-tile mb-0"></h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row customers">
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="copy of the loan agreements">copy of the loan agreements </label>
                                                <input type="hidden" name="loan_aggreement_document" value="" />
                                                <input type="hidden" name="all_documents[file]" value="">
                                                <input type="file" name="file" class="form-control" data-upload="file_upload" id="file_upload">
                                                <div class="uploaded-file mt-1">
                                                    @if(isset($documents) && !empty($documents->loan_aggreement_document))
                                                    <a href="{{ url('storage/app/uploads/loan_aggreement_document/'.$documents->loan_aggreement_document) }}" target="_blank">View Document</a>
                                                    @else
                                                    @endif
                                                </div>
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="Copy of credit file">Copy of credit file </label>
                                                <input type="hidden" name="credit_card_document" value="">
                                                <input type="file" name="file" class="form-control" data-upload="file_upload">

                                                <span class="ajax-error" style="color:red;"></span>
                                                <div class="uploaded-file mt-1">
                                                    @if(isset($documents) && !empty($documents->credit_card_document))
                                                    <a href="{{ url('storage/app/uploads/credit_card_document/'.$documents->credit_card_document) }}" target="_blank">View Document</a>
                                                    @else

                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="Proof of rent/housing loan">Proof of rent/housing loan</label>
                                                <input type="hidden" name="house_loan_document" value="">
                                                <input type="file" name="file" class="form-control" data-upload="file_upload">
                                                <span class="ajax-error" style="color:red;"></span>
                                                <div class="uploaded-file mt-1">
                                                    @if(isset($documents) && !empty($documents->house_loan_document))
                                                    <a href="{{ url('storage/app/uploads/house_loan_document/'.$documents->house_loan_document) }}" target="_blank">View Document</a>
                                                    @else

                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="Copy of wage slips and proof of other incomes">Copy of wage slips and proof of other incomes </label>
                                                <input type="hidden" name="wage_slips_other_income_document" value="">
                                                <input type="file" name="file" class="form-control" data-upload="file_upload">
                                                <span class="ajax-error" style="color:red;"></span>
                                                <div class="uploaded-file mt-1">
                                                    @if(isset($documents) && !empty($documents->wage_slips_other_income_document))
                                                    <a href="{{ url('storage/app/uploads/wage_slips_other_income_document/'.$documents->wage_slips_other_income_document) }}" target="_blank">View Document</a>
                                                    @else

                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="Aadhar card">Aadhar card</label>
                                                <input type="hidden" name="addhar_card_document">
                                                <input type="file" name="file" class="form-control" data-upload="file_upload">
                                                <span class="ajax-error" style="color:red;"></span>
                                                <div class="uploaded-file mt-1">
                                                    @if(isset($documents) && !empty($documents->addhar_card_document))
                                                    <a href="{{ url('storage/app/uploads/addhar_card_document/'.$documents->addhar_card_document) }}" target="_blank">View Document</a>
                                                    @else

                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="Pancard">Pancard</label>
                                                <input type="hidden" name="pancard_document" value="">
                                                <input type="file" name="file" class="form-control" data-upload="file_upload">
                                                <span class="ajax-error" style="color:red;"></span>
                                                <div class="uploaded-file mt-1">
                                                    @if(isset($documents) && !empty($documents->pancard_document))
                                                    <a href="{{ url('storage/app/uploads/pancard_document/'.$documents->pancard_document) }}" target="_blank">View Document</a>
                                                    @else

                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-success submit-button">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.common.footer')
<script>
    $(document).ready(function() {
        $(document).on('submit', '.ajax-form', function(e) {
            e.preventDefault();
            clearAjaxErrors();
            const _this = $(this);
            const url = _this.attr('action');
            const data = _this.serializeArray();
            $.post(url, data, function(res) {
                processAjaxResponse(res, 1000);
            }, 'json');
        })
    })
</script>
<script>
    $(document).on('change', '[name="file"]', function(e) {
        var el = $(this)[0];
        var current_this = $(this);
        var uploadType = $(this).data('upload');
        const url = "{{ url('admin/common/upload_files') }}";
        uploadFile(el, uploadType, current_this, url);
    });
</script>







@include('admin.common.end')