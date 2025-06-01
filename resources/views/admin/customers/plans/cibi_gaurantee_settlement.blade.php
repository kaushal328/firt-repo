<div class="mt-3">
    <h3>CIBI Guarantee Settlement Plans</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tenure</th>
                <th>EMI</th>
                <th>Service Charge</th>
                <th>Total EMI</th>
                <th>Select</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tenure_month as $row)
            <?php
            $emi =  round($details['cibi']['totalOutstanding'] / $row);
            $serviceCharge = round($emi * 0.15);
            $totalEmi = round($emi + $serviceCharge);
            ?>
            <tr>
                <td>{{ $row }} Month</td>
                <td>₹ {{number_format($emi)}}</td>
                <td>₹ {{number_format($serviceCharge)}}</td>
                <td>₹ {{number_format($totalEmi)}}</td>
                <td>
                    <input type="radio" name="tenure" value="{{ $row }}" class="tenure-radio">
                </td>
            </tr>
            @endforeach
            <tr>
                <td><input type="number" id="tenureInput" class="form-control" placeholder="Enter custom tenure"></td>
                <td id="emiOutput"></td>
                <td id="serviceChargeOutput"></td>
                <td id="totalEmiOutput"></td>
                <td>
                    <input type="radio" name="tenure" id="tenureRadio" class="tenure-radio">
                </td>
            </tr>
        </tbody>
    </table>
    <span id="tenure_err" class="error tenure_err small" style="color:red;"></span>

</div>

<script>
    $(document).ready(function() {
        $(".submit-button").prop("disabled", true);
        $(document).on("change", ".tenure-radio", function() {
            $(".submit-button").prop("disabled", false);
        });
    });
</script>
<script>
    $(document).ready(function() {
        const totalOutstanding = "{{$details['cibi']['totalOutstanding']}}";

        $('#tenureInput').on('input', function() {
            const tenure = parseInt($(this).val()) || 0;

            const emi = tenure > 0 ? Math.round(totalOutstanding / tenure) : 0;
            const serviceCharge = Math.round(emi * 0.15);
            const totalEmi = emi + serviceCharge;
            $('#emiOutput').text(`₹ ${emi}`);
            $('#serviceChargeOutput').text(`₹ ${serviceCharge}`);
            $('#totalEmiOutput').text(`₹ ${totalEmi}`);
            $('#tenureRadio').val(tenure);
        });
    });
</script>