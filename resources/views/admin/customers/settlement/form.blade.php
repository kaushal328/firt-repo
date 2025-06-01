@include('admin.common.header')
<style>
    .flatpickr-calendar.hasTime.noCalendar.animate.arrowTop.arrowLeft.open {
        width: 22.5% !important;
    }
</style>

<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h4 class="mb-0"><span class="text-muted fw-light">Dashboard / </span> Customer / Settlement Form</h4>
        <div>
            <a href="{{ route('admin.customer.settlement', ['id' => $id]) }}" class="btn btn-primary">Back</a>
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
                    <form class="form ajax_form" method="POST" action="{{route('admin.customer.settlement_save')}}">
                        @csrf
                        <input type="hidden" name="customer_id"
                            value="{{ $edit['customer_id'] ?? base64_decode($id) }}">
                        <input type="hidden" name="settlement_id" value="{{ $edit['id'] ?? '' }}">
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
                                                <label class="form-label" for="loan_id">Loan No</label>
                                                <select class="form-control select2" name="loan_no"
                                                    data-style="btn-default" id="loan_id">
                                                    <option value="">
                                                        Select
                                                    </option>
                                                    @if (isset($loan_no))
                                                    @foreach ($loan_no as $row)
                                                    <option value="{{ $row->id }}" {{ isset($edit['loan_id']) &&
                                                        $edit['loan_id']==$row->id ? 'selected' : '' }}
                                                        data-bank="{{$row->bank_creditor->id}}">
                                                        {{ $row->loan_number }}-{{ $row->bank_creditor->creditors_name
                                                        ?? '' }}
                                                    </option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="status">Status</label>
                                                <select class="form-control select2" name="status"
                                                    data-style="btn-default" id="status">
                                                    <option value="">
                                                        Select
                                                    </option>
                                                    @if (isset($status))
                                                    @foreach ($status as $k => $v)
                                                    <option value="{{ $v }}" {{ isset($edit['status']) &&
                                                        $edit['status']==$v ? 'selected' : '' }}>
                                                        {{$v}}
                                                    </option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="creditor_confirmation">Creditor
                                                    Confirmation</label>
                                                <select class="form-control select2" name="creditor_confirmation"
                                                    data-style="btn-default" id="creditor_confirmation">
                                                    <option value="">
                                                        Select
                                                    </option>
                                                    @if (isset($creditor_confirmation))
                                                    @foreach ($creditor_confirmation as $k => $v)
                                                    <option value="{{ $v }}" {{ isset($edit['creditor_confirmation']) &&
                                                        $edit['creditor_confirmation']==$v ? 'selected' : '' }}>
                                                        {{$v}}
                                                    </option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>

                                            
                                           
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="loan_amt">Outstanding Loan Amount</label>
                                                <input type="text" class="form-control" id="outstanding_loan_amount"
                                                    placeholder="Outstanding Loan Amount" name="outstanding_loan_amount"
                                                    value="{{$customer_loan['outstanding_loan_amt'] }}"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g,'')" readonly>
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="loan_amt">Settlement Offer (%)</label>
                                                <input type="text" class="form-control" id="settlement_offer"
                                                    placeholder="Settlement Offer" name="settlement_offer"
                                                    value="{{ $edit['settlement_offer'] ?? '' }}"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g,'')">
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="loan_amt">Settlement Offer Amount</label>
                                                <input type="text" class="form-control" id="settlement_offer_amount"
                                                    placeholder="Settlement Offer Amount" name="settlement_offer_amount"
                                                    value="{{ $edit['settlement_offer_amount'] ?? '' }}"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g,'')">
                                                <span class="ajax-error" style="color:red;"></span>

                                            </div>

                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="settlement_date">Settlement
                                                    offer last date</label>
                                                <input type="text" class="form-control datepicker" id="settlement_date"
                                                    placeholder="Settlement offer last date" name="settlement_date"
                                                    value="{{ isset($edit['settlement_date']) ? date('d-m-Y', strtotime($edit['settlement_date'])) : '' }}">
                                                <span class="ajax-error" style="color:red;"></span>

                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="payment_amount">Payment Amount</label>
                                                <input type="text" class="form-control" id="payment_amount"
                                                    placeholder="Payment Amount" name="payment_amount"
                                                    value="{{ $edit['payment_amount'] ?? '' }}"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g,'')">
                                                <span class="ajax-error" style="color:red;"></span>

                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="remark">Remark</label>
                                                <textarea class="form-control" name="remark"
                                                    placeholder="Remark">{{$edit['remark'] ?? ""}}</textarea>
                                                <span class="ajax-error" style="color:red;"></span>
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
    $(document).ready(function () {
        $('#loan_no').select2({
            width: '100%'
        });

    });
</script>
<script>
    $(document).ready(function () {
        var outstanding_loan_amount = parseFloat($("#outstanding_loan_amount").val());
        $(document).on('keyup', '#settlement_offer', function () {
            var settlement_offer = parseFloat($(this).val());
            if (!isNaN(settlement_offer) && !isNaN(outstanding_loan_amount)) {
                var percentage = (outstanding_loan_amount * settlement_offer) / 100;
                $("#settlement_offer_amount").val(percentage);
            }
        });
    })
</script>
<script>
    $(document).ready(function () {
        $(document).on('submit', '.ajax_form', function (e) {
            e.preventDefault();
            clearAjaxErrors();
            const _this = $(this);
            const url = _this.attr('action');
            const data = _this.serializeArray();
            const selectedOption = _this.find('option:selected');
            const bankId = selectedOption.data('bank');
            data.push({ name: 'bank_id', value: bankId });
            $.post(url, data, function (res) {
                processAjaxResponse(res, 1000);
            }, 'json');
        })
    })
</script>
@include('admin.common.end')