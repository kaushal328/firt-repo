<div class="mt-3 ajax-field">
    <h3>DMP Plan</h3>
    <p>EMI based on income and expenses will be displayed here</p>
    <div class="row">
        <div class="col-lg-6">
            <input type="text" name="dmp_amount" value="" class="form-control" placeholder="Enter DMP Amount" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
        </div>
    </div>
    <span class="ajax-error" style="color:red;"></span>
</div>
<script>
    // Initially disable the "Pay Now" button
    $(".submit-button").prop("disabled", false);
</script>