@include('admin.common.header')
<style>
    .flatpickr-calendar.hasTime.noCalendar.animate.arrowTop.arrowLeft.open {
        width: 22.5% !important;
    }
</style>
<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h4 class="mb-0"><span class="text-muted fw-light">Dashboard / </span> Customer / Customer Status</h4>
        <div>
            <a href="{{route('admin.customer.customer_status', ['id' => $id])}}" class="btn btn-primary">Back</a>
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
                    <form class="form ajax-form" id="" method="POST" action="{{route('admin.customer.customer_status_save')}}">
                        @csrf
                        <input type="hidden" name="customer_id" value="{{$edit['customer_id'] ?? base64_decode($id) }}">
                        <input type="hidden" name="id" value="{{$edit['id'] ?? ''}}">
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="card-tile mb-0">Customer Status</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row customers">
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="plan_status">Plan Status</label>
                                                <select class="form-control select2" name="plan_status" data-style="btn-default" id="plan_status">
                                                    <option value="">
                                                        Select
                                                    </option>
                                                    @if(isset($status))
                                                    @foreach($status as $row)
                                                    <option value="{{ $row->id }}" {{ isset($edit['plan_status_id']) && $edit['plan_status_id'] == $row->id ? 'selected' : '' }}>
                                                        {{ $row->status_name }}
                                                    </option>
                                                    @endforeach
                                                    @endif

                                                </select>
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="payment_done_status">Payment Status</label>
                                                <select class="form-control select2" name="payment_done_status" data-style="btn-default" id="payment_done_status">
                                                    <option value="">
                                                        Select
                                                    </option>
                                                    @if(isset($payment_status))
                                                    @foreach($payment_status as $row)
                                                    <option value="{{ $row->id }}" {{ isset($edit['payment_done_status']) && $edit['payment_done_status'] == $row->id ? 'selected' : '' }}>
                                                        {{ $row->payment_status_name }}
                                                    </option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="payment_done_number">Total Full Payment - Done Payment Number</label>
                                                <input type="text" class="form-control " id="payment_done_number" placeholder="Total Full Payment - Done Payment Number" name="payment_done_number" value="{{ isset($edit['payment_done_number']) ? $edit['payment_done_number'] : '' }}">
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="payment_done_value">Total Full Payment - Value</label>
                                                <input type="text" class="form-control " id="payment_done_value" placeholder="Total Full Payment - Value" name="payment_done_value" value="{{ isset($edit['payment_done_value']) ? $edit['payment_done_value'] : '' }}">
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="next_payment_date">Expected Next Payment Date (DD-MM-YYY)</label>
                                                <input type="text" class="form-control datepicker" id="next_payment_date" placeholder="Expected Next Payment Date (DD-MM-YYY)" name="next_payment_date" value="{{ isset($edit['next_payment_date']) ? date('d-m-Y', strtotime($edit['next_payment_date'])) : '' }}">
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
    $(document).ready(function() {
        $('#plan_status').select2({
            width: '100%'
        });
        $('#payment_done_status').select2({
            width: '100%'
        });
    });
</script>
@include('admin.common.end')