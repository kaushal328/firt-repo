@include('admin.common.header')
<?php
$admin_id = session('admin');
use App\Models\MasterStatus;
$leadStage = null;
if (isset($edit['lead']) && isset($edit['lead']['status'])) {
    $leadStage = MasterStatus::where(['id' => $edit['lead']['status']])->first();
}
?>
<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h4 class="mb-0"><span class="text-muted fw-light">Dashboard / </span><a href="{{ url('admin/customer') }}">
                Customer </a> / Customer Plan</h4>
        <div>
            <a href="{{ url('admin/customer') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
    <div class="row">
        @include('admin.customers.partial.customer_details', ['edit' => $edit])
        <div class="col-md-8">
            @include('admin.customers.partial.nav', ['id' => $id, 'active_tab' => $active_tab])
            <div class="tab-pane fade  active show" id="customer-details" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <div class="ajax-msg"></div>
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between">
                                <h3 class="card-title">Customer Plan</h3>
                                @if (!empty($total_outstanding_amount) && !empty($current_emi) &&
                                !empty($total_loan_amt))
                                @if ($consultation_charges == 1)
                                <div class="col-lg-6">
                                    <div class="alert alert-success">
                                        <strong>Paid:</strong> One-Time Consultation charges of ₹ 699 have been
                                        paid.
                                    </div>
                                </div>
                                @elseif($consultation_charges == 2 || $consultation_charges == 0)
                                <div class="col-lg-8">
                                    <div class="alert alert-danger">
                                        <strong>Not Paid:</strong> One-Time Consultation charges are still
                                        pending.
                                    </div>
                                </div>
                                @endif
                                @endif
                            </div>
                            <form class="ajax_form" method="POST" action="{{ route('admin.save_customer_plan') }}">
                                @csrf

                                <input type="hidden" name="total_outstanding_amount"
                                    value="{{ $total_outstanding_amount }}">
                                <input type="hidden" name="current_emi" value="{{ $current_emi }}">
                                <input type="hidden" name="total_loan_amount" value="{{ $total_loan_amt }}">
                                <input type="hidden" name="customer_id" value="{{ base64_decode($id) }}">
                                <div class="card-body" id="customerDetailsForm" data-id="step-1">
                                    <div class="table-responsive">
                                        <table class="table table-bordered w-100">
                                            <thead class="table-light text-nowrap text-center">
                                                <tr>
                                                    <th>Total Outstanding Amount</th>
                                                    <th>Current EMI</th>
                                                    <th>Total Loan Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                @if (!empty($total_outstanding_amount) && !empty($current_emi) &&
                                                !empty($total_loan_amt))
                                                <tr>
                                                    <td>₹ {{ number_format($total_outstanding_amount) ?? '-' }}</td>
                                                    <td>₹ {{ number_format($current_emi) ?? '-' }}</td>
                                                    <td>₹ {{ number_format($total_loan_amt) ?? '-' }}</td>
                                                </tr>
                                                @else
                                                <tr>
                                                    <td colspan="3">No Data Found</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    @if (in_array(4, explode(',', $admin_id['role'])) || in_array(1, explode(',',
                                    $admin_id['role'])))

                                    @if (!empty($total_outstanding_amount) && !empty($current_emi) &&
                                    !empty($total_loan_amt))
                                    <div class="mt-3">
                                        <button class="btn btn-primary" id="" onclick="next_process(); return false;"
                                            type="button">Next</button>
                                    </div>
                                    @endif
                                    @endif
                                </div>

                                @if ($consultation_charges == 0)
                                <div class="card-body d-none" id="paymentOptions" data-id="step-2">
                                    <div class="mt-3">
                                        <h4>One-Time Consultation Charges</h4>
                                        <p>Pay <b>₹699</b> to proceed further.</p>
                                    </div>
                                    <div class="row">

                                        <div class="col-lg-3 mt-3">
                                            <button class="btn btn-primary" id="pay_later"
                                                onclick="proceedToPayment(2); return false;" type="button"
                                                data-pay-later="2">Pay Later</button>
                                        </div>
                                        <div class="col-lg-4 mt-3">
                                            <button class="btn btn-primary" id="pay_now"
                                                onclick="proceedToPayment(1); return false;" type="button"
                                                data-pay-now="1">Send payment link</button>
                                        </div>

                                    </div>
                                </div>
                                @endif

                                <div class="card-body d-none" id="offerDetails" data-id="step-3">
                                    <div class="mt-1">
                                        <h6>Select an Offer</h6>
                                        <div class="col-lg-6">
                                            <select id="offerSelect" class="form-control" name="customer_plan_offer_id">
                                                <option value="">Select an Offer</option>
                                                @foreach ($plan_offer as $row)
                                                <option value="{{ $row->id }}">{{ $row->offer_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <span id="customer_plan_offer_err"
                                                class="error customer_plan_offer_err small" style="color:red;"></span>
                                        </div>
                                    </div>
                                    <div class="" id="offerDetailsView"></div>
                                    <div class="mt-3">
                                        <button class="btn btn-success submit-button" type="submit">Activate plan
                                            now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @if ($customer_plan->isNotEmpty())
                        @if (!empty($total_outstanding_amount) && !empty($current_emi) && !empty($total_loan_amt))
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Chosen Customer Plan </h5>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered w-100">
                                        <thead class="table-light text-nowrap">
                                            <tr>
                                                <th>No</th>
                                                <th>Plan Name</th>
                                                <th>DMP Plan Amount</th>
                                                <th>Settlement amount (₹)</th>
                                                <th>Settlement (%)</th>
                                                <th>Service Charge</th>
                                                <th>Tenure (Month)</th>
                                                <th>EMI Amount</th>
                                                <th>Total EMI</th>
                                                <th>Plan Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <?php
                                                    $count = 0;
                                                    ?>
                                            @foreach ($customer_plan as $row)
                                            <tr>
                                                <td>{{ ++$count }}</td>
                                                <td>{{ $row->plans->offer_name ?? '' }}</td>
                                                <td>{{ $row->dmp_amount == 0 ? '--' : '₹' .
                                                    number_format($row->dmp_amount ?? '') }}</td>

                                                <td> {{ $row->settlement_amount == 0 ? '--' : '₹ ' .
                                                    number_format($row->settlement_amount) }}
                                                </td>
                                                <td> {{ $row->settlement_percentage == 0 ? '--' :
                                                    $row->settlement_percentage . ' %' }}
                                                </td>
                                                <td>₹
                                                    {{ $row->customer_plan_offer_id == 1
                                                    ? number_format($row->settlement_service_charge)
                                                    : number_format($row->service_charge) }}
                                                </td>

                                                <td>{{ $row->tenure ? $row->tenure . ' Month ' : ' -- ' }}
                                                </td>
                                                <td> {{ $row->emi_amt == 0 ? '--' : ' ₹ ' . number_format($row->emi_amt)
                                                    }}
                                                </td>
                                                <td> {{ $row->total_emi == 0 ? '--' : '₹ ' .
                                                    number_format($row->total_emi) }}
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge  {{ $row->is_active == 1 ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $row->is_active == 1 ? 'Active' : 'Deactive' }}
                                                    </span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.common.footer')
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    })

    var consultation_chrge = "{{ $consultation_charges }}";
    console.log(consultation_chrge);

    function next_process() {
        if (consultation_chrge == 0) {

            $('#customerDetailsForm').hide();
            $('#paymentOptions').removeClass('d-none').show();
        } else if (consultation_chrge == 1 || consultation_chrge == 2) {
            $('#customerDetailsForm').hide();
            $('#offerDetails').removeClass('d-none').show();
        }
    }

    function proceedToPayment(payment_status) {

        var pay_now = $("#pay_now").data('pay-now');
        var pay_later = $("#pay_later").data('pay_later');
        var customer_id = "{{ base64_decode($id) }}";

        if (payment_status == 1) {
            var pay_now = $("#pay_now");
            pay_now.attr('disabled', 'disabled');
            $("#pay_later").attr('disabled', 'disabled');
            pay_now.text('sending payment link....');
        } else {
            var pay_later = $("#pay_later");
            $("#pay_now").attr('disabled', 'disabled');
            pay_later.attr('disabled', 'disabled');
            //pay_now.text('paying later........');
        }

        if (pay_now || pay_later || payment_status) {
            $.ajax({
                url: '{{ route("admin.updated_consultation") }}',
                type: 'POST',
                data: {
                    customer_id: customer_id,
                    payment_status: payment_status,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {

                    if (response.status == 1) {

                        setTimeout(function () {
                            // window.location.href = response.redirect_url;
                            $('#paymentOptions').addClass('d-none');
                            $('#customerDetailsForm').addClass('d-none');
                            $('#offerDetails').removeClass('d-none').show();
                        }, 3000)
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX error: ", error);
                }
            });
        }
    }
    $(".submit-button").prop("disabled", true);
    $(document).ready(function () {
        var previousOffer = "";
        $(document).on('change', '#offerSelect', function (e) {
            e.preventDefault()
            var selectedOffer = $(this).val();
            var total_outstanding_amount = "{{ $total_outstanding_amount }}";
            var current_emi = "{{ $current_emi }}";
            var total_loan_amt = "{{ $total_loan_amt }}";

            $.ajax({
                url: '{{ route("admin.customer.get_offer_details") }}',
                type: 'POST',
                data: {
                    offer: selectedOffer,
                    total_outstanding_amount: total_outstanding_amount,
                    current_emi: current_emi,
                    total_loan_amt: total_loan_amt,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response && response.data) {
                        $('#offerDetailsView').html(response.data);
                    } else {
                        console.warn("Unexpected response format: ", response);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX error: ", error);
                }
            });
        });
    });

    // 
</script>
<script>
    $(document).ready(function () {
        // $('form').find(".submit-button").prop("disabled", true);
        $(document).on('submit', '.ajax_form', function (e) {
            e.preventDefault();
            clearAjaxErrors();
            const _this = $(this);
            const url = _this.attr('action');
            console.log(url);
            const data = _this.serializeArray();
            $.post(url, data, function (res) {
                processAjaxResponse(res, 1000);
            }, 'json');
        })
    })
</script>
@include('admin.common.end')