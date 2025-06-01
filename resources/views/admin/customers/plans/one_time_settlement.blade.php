<div class="mt-3">
    <h3>Onetime Settlement Plans</h3>

    <input type="hidden" name="service_charge_total_outstanding_amt" value="{{$details['serviceCharge1']}}">
    <p class="mt-4"><strong>Service Charge on Total Outstanding: </strong>₹ {{number_format($details['serviceCharge1'])}} (<b>Excluding GST</b>)</p>
    <div><strong>Settlement Percentage:</strong><span id="percentageDisplay"></span></div>
    <div class="row">
        <div class="col-lg-6">
            <select class="form-control settlement_percentage mt-2 mb-2" id="settlement_percentage" name="settlement_percentage" data-id="settlement_percentage">
                @foreach($percentage as $row)
                <option value="{{$row}}"> {{$row}} %</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-6 mt-2">

            <button class="btn btn-primary mb-2" onclick="calculateSettlementAmount(); return false;" id="settleButton">Calculate</button>
            <span id="err" class="error err small" style="color:red;"></span>
        </div>
    </div>
    <div id="settlementDetails"></div>
    <input type="hidden" name="settlement_amount" value="">
    <input type="hidden" name="settlement_service_charge" value="">
</div>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  -->
<script>
    $(document).ready(function() {
        // Initially disable the "Pay Now" button
        $(".submit-button").prop("disabled", true);


        $(document).on('change', '#settlement_percentage', function() {
            var selectedOffer = $(this).val();
            if (selectedOffer) {
                $('#percentageDisplay').text(selectedOffer + '%');
            }
        });


        $('#settlement_percentage').trigger('change');


        window.calculateSettlementAmount = function() {
            var selectedOffer = $('#settlement_percentage').val();
            var outstanding_amt = "{{$details['serviceCharge1']}}";

            if (selectedOffer && outstanding_amt) {
                $.ajax({
                    url: '{{ route("calculate.settlement") }}',
                    type: 'POST',
                    data: {
                        percentage: selectedOffer,
                        outstanding_amt: outstanding_amt,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        console.log(res.data.settlementAmount)
                        if (res.data.settlementAmount && res.data.serviceCharges) {
                            $('[name="settlement_amount"]').val(`${res.data.settlementAmount}`);
                            $('[name="settlement_service_charge"]').val(`${res.data.serviceCharges}`);
                            $('#settlementDetails').html(`
                            <p><strong>Settlement Amount:</strong> ₹ ${res.data.settlementAmount}</p>
                            <p><strong>Service Charge on Settlement Amount:</strong> ₹ ${res.data.serviceCharges} (<b>Excluding GST</b>)</p>`);
                            // $(".submit-button").prop("disabled", false);
                            $(".submit-button").prop("disabled", res.data.button_enabled);
                        } else {
                            $('#settlementDetails').html('<p>Calculation failed.</p>');
                            $(".submit-button").prop("disabled", true);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error: " + error);
                        $('#settlementDetails').html('<p>An error occurred. Please try again later.</p>');
                        $(".submit-button").prop("disabled", true);
                    }
                });
            } else {
                $('#settlementDetails').html('<p>Please select a percentage and ensure the outstanding amount is available.</p>');
                $(".submit-button").prop("disabled", true);
            }
        };
    });
</script>