@include('admin.common.header')
<style>
    .flatpickr-calendar.hasTime.noCalendar.animate.arrowTop.arrowLeft.open {
        width: 22.5% !important;
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h4 class="mb-0"><span class="text-muted fw-light">Dashboard / </span> Customer / Loan Form</h4>
        <div>
            <a href="{{route('admin.customer.loan', ['id' => $id])}}" class="btn btn-primary">Back</a>
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
                    <form class="form" id="ajax_form" method="POST" route="save-custome-loan" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="customer_id" value="{{$edit['customer_id'] ?? base64_decode($id) }}">
                        <input type="hidden" name="loan_id" value="{{$edit['id'] ?? ''}}">
                        <div class="row">
                            <div class="col-12 ajax-msg"></div>
                            <div class="col-12 col-lg-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="card-tile mb-0"></h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row customers">
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="loan_type_id">Loan Type</label>
                                                <select class="form-control select2 loan_type" name="loan_type" data-style="btn-default">
                                                    <option value="">
                                                        Select
                                                    </option>
                                                    @if(isset($loanType))
                                                    @foreach($loanType as $row)
                                                    <option value="{{ $row->id }}" {{ isset($edit['loan_type_id']) && $edit['loan_type_id'] == $row->id ? 'selected' : '' }}>
                                                        {{ $row->name }}
                                                    </option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <span id="loan_type_err" class="error loan_type_err small" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="bank_type">Bank Type</label>
                                                <select class="form-control select2 bank_type_id" name="bank_type" data-style="btn-default" id="bank_type_id">
                                                    <option value="">
                                                        Select
                                                    </option>
                                                    @if(isset($bantype))
                                                    @foreach($bantype as $row)
                                                    <option value="{{ $row->id }}" {{ isset($edit['bank_type_id']) && $edit['bank_type_id'] == $row->id ? 'selected' : '' }}>
                                                        {{ $row->bank_type_name }}
                                                    </option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <span id="bank_type_err" class="error bank_type_err small" style="color:red;"></span>
                                            </div>

                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="bank_type">Creditor profile name</label>
                                                <select class="form-control select2 bank_creditor_dropdown" name="bank_creditor" data-style="btn-default" id="bank_creditor_dropdown">

                                                </select>
                                                <span id="bank_creditor_err" class="error bank_creditor_err small" style="color:red;"></span>
                                            </div>

                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="loan_number">Loan No</label>
                                                <input type="text" class="form-control" id="loan_number" placeholder="Loan No" name="loan_number" value="{{ $edit['loan_number'] ?? '' }}" oninput="this.value = this.value.replace(/[^0-9]/g,'')">
                                                <span id="loan_number_err" class="error loan_number_err small" style="color:red;"></span>
                                            </div>



                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="loan_amt">Loan Amount</label>
                                                <input type="text" class="form-control" id="loan_amt" placeholder="Loan Amount" name="loan_amt" value="{{ $edit['loan_amt'] ?? '' }}" oninput="this.value = this.value.replace(/[^0-9]/g,'')">
                                                <span id="loan_amt_err" class="error loan_amt_err small" style="color:red;"></span>
                                            </div>

                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="monthly_emi">Monthly EMI (INR)</label>
                                                <input type="text" class="form-control" id="monthly_emi" placeholder="Monthly EMI (INR)" name="monthly_emi" value="{{ $edit['monthly_emi'] ?? '' }}" oninput="this.value = this.value.replace(/[^0-9]/g,'')">
                                                <span id="monthly_emi_err" class="error monthly_emi_err small" style="color:red;"></span>
                                            </div>

                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="emi_date">EMI Date</label>
                                                <input type="text" class="form-control datepicker" id="emi_date" placeholder="EMI Date" name="emi_date" value="{{ isset($edit['emi_date']) ? date('d-m-Y', strtotime($edit['emi_date'])) : '' }}">
                                                <span id="emi_date_err" class="error emi_date_err small" style="color:red;"></span>
                                            </div>

                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="last_emi_payment_date">Last EMI Payment Date</label>
                                                <input type="text" class="form-control datepicker" id="last_emi_payment_date" placeholder="Last EMI Payment Date" name="last_emi_payment_date" value="{{ isset($edit['last_emi_payment_date']) ? date('d-m-Y', strtotime($edit['last_emi_payment_date'])) : '' }}">
                                                <span id="last_emi_payment_date_err" class="error last_emi_payment_date_err small" style="color:red;"></span>
                                            </div>

                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="outstanding_loan_amt">Outstanding Loan Amount (INR)</label>
                                                <input type="text" class="form-control" id="outstanding_loan_amt" placeholder="Outstanding Loan Amount (INR)" name="outstanding_loan_amt" value="{{ $edit['outstanding_loan_amt'] ?? '' }}" oninput="this.value = this.value.replace(/[^0-9]/g,'')">
                                                <span id="outstanding_loan_amt_err" class="error outstanding_loan_amt_err small" style="color:red;"></span>
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
        $('#bank_creditor_dropdown').html('<option value="">No data found</option>');
        $(document).on('change', '#bank_type_id', function() {
            let bankTypeId = $(this).val();
            if (bankTypeId) {
                $.ajax({
                    url: '{{route("admin.get_bank_creditors")}}',
                    type: 'POST',
                    data: {
                        bank_type_id: bankTypeId
                    },
                    success: function(response) {
                        let options = '<option value="">Select Creditor</option>';

                        if (response.status == 1) {
                            if (response.data && response.data.length > 0) {
                                response.data.forEach(function(creditor) {
                                    options += `<option value="${creditor.id}">${creditor.creditors_name}</option>`;
                                });
                                $('#bank_creditor_dropdown').html(options);
                            } else {
                                options += '<option value="">No data found</option>';

                            }
                            let preselected_creditor = '{{ $edit["bank_creditor_id"] ?? "" }}';
                            if (preselected_creditor) {
                                $('.bank_creditor_dropdown').val(preselected_creditor);
                            }
                        } else {

                            $('.bank_creditor_dropdown').html('<option value="">No data found</option>');
                        }

                    },
                    error: function() {
                        console.log('Something went wrong while fetching creditors.');
                    },
                });
            } else {
                $('#bank_creditor_dropdown').html('<option value="">No data found</option>');
            }
        });
        let preselected = $('.bank_type_id').find('option:selected').val();
        if (preselected) {
            setTimeout(() => {
                let trigger = $('.bank_type_id').trigger('change');
            }, 1000)
        }
    });
</script>
<script>
    $(document).ready(function() {
        function calculateTotal() {
            var salary = parseFloat($('#salary').val()) || 0;
            var businessIncome = parseFloat($('#business_income').val()) || 0;
            var otherIncome = parseFloat($('#other_income').val()) || 0;
            var familySupport = parseFloat($('#family_support').val()) || 0;
            var total = salary + businessIncome + otherIncome + familySupport;
            $('#total_income').val(total.toFixed(2));
        }
        $('#salary, #business_income, #other_income, #family_support').on('input', function() {
            calculateTotal();
        });
        calculateTotal();
        $('#bank_creditor_dropdown').select2({
            width: '100%'
        });
        $('.loan_type').select2({
            width: '100%'
        });
        $('#bank_type_id').select2({
            width: '100%'
        });
    });
</script>
@include('admin.common.end')