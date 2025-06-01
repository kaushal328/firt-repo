@include('admin.common.header')
<style>
    .flatpickr-calendar.hasTime.noCalendar.animate.arrowTop.arrowLeft.open {
        width: 22.5% !important;
    }
</style>
<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h4 class="mb-0"><span class="text-muted fw-light">Dashboard / </span> Customer / Reason for financial
            Difficulty</h4>
        <div>
            <a href="{{ route('admin.customer.customer_finance', ['id' => $id]) }}" class="btn btn-primary">Back</a>
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
                <div class="col-8">
                    <div class="ajax-msg"></div>
                    <form class="form ajax-form" id="" method="POST"
                        action="{{ route('admin.customer.customer_finance_save') }}">
                        @csrf
                        <input type="hidden" name="customer_id"
                            value="{{ $edit['customer_id'] ?? base64_decode($id) }}">
                        <input type="hidden" name="id" value="{{ $edit['id'] ?? '' }}">
                        <div class="row">
                            <div class="col-9 col-lg-9">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="card-tile mb-0"></h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row customers">
                                            <div class="col-lg-12 mb-3 ajax-field">
                                                <label class="form-label" for="State your reason here">State your reason
                                                    here (Textbox word limit 1000)</label>
                                                <textarea class="form-control" name="state_reason" id="state_reason" maxlength="1000" rows="5"
                                                    placeholder="State your reason here">{{ $edit['state_reason'] ?? '' }}</textarea>
                                                <span class="banner_text_length"
                                                    style="color: green;">{{ strlen($edit['state_reason'] ?? '') }}</span>
                                                / 1000 Max Characters
                                                <br>
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mb-3 ajax-field">
                                                <label class="form-label" for="Reason for refunds">Reason for refunds
                                                </label>
                                                <select class="form-control" id="refund_reason" name="refund_reason">
                                                    <option value="">Select</option>
                                                    @if (isset($refund_reason))
                                                        @foreach ($refund_reason as $row)
                                                            <option value="{{ $row->id }}"
                                                                {{ isset($edit['refund_reason_id']) == $row->id ? 'selected' : '' }}>
                                                                {{ $row->refund_reason }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <span class="ajax-error" style="color:red;"></span>
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
    $('#refund_reason').select2({
        width: '100%'
    });
    $(document).ready(function() {
        $('#state_reason').bind('keyup', function(e) {
            if ($(this).val().length <= '1000') {
                console.log($(this).val().length)
                $('.banner_text_length').html(($(this).val().length)).css('color', 'green');
            } else {
                $('.banner_text_length').html(($(this).val().length)).css('color', 'red');
            }
        });
    })
</script>
@include('admin.common.end')
