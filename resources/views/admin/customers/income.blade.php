@include('admin.common.header')

<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h4 class="mb-0"><span class="text-muted fw-light">Dashboard / </span> Customer / Income Form</h4>
        <div>
            <a href="{{route('admin.customer.income', ['id' => $id])}}" class="btn btn-primary">Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="card mb-4">

                        <div class="card-body">
                            @include('admin.customers.partial.customer',compact('customer'))

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="card mb-4">

                        <div class="card-body">
                            <form class="form" id="ajax_form" route="save-income" method="post">
                                <div class="ajax-msg"></div>

                                @csrf
                                <input type="hidden" name="customer_id" value="{{$edit['customer_id'] ?? base64_decode($id) }}">
                                <input type="hidden" name="income_id" value="{{$edit['id'] ?? ''}}">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th class="fw-semibold">Salary (Per month):</th>
                                            <td>
                                                <div class="ajax-field">
                                                    <input type="text" class="form-control" id="salary" name="salary" placeholder="₹ Salary (Per month)" value="{{$edit['salary'] ?? '' }}">
                                                    <span id="salary_err" class="error salary_err small" style="color:red;"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="">
                                            <th class="fw-semibold mt-4">Business Income:</th>
                                            <td>
                                                <div class="ajax-field">
                                                    <input type="text" class="form-control" id="business_income" name="business_income" placeholder="₹ Business Income" value="{{$edit['business_income'] ?? '' }}">
                                                    <span id="business_income_err" class="error business_income_err small" style="color:red;"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="fw-semibold">Other Income:</th>
                                            <td>
                                                <div class="ajax-field">
                                                    <input type="text" class="form-control" id="other_income" name="other_income" placeholder="₹ Other Income" value="{{$edit['other_income'] ?? '' }}">
                                                    <span id="other_income_err" class="error other_income_err small" style="color:red;"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="fw-semibold">Family Support:</th>
                                            <td>
                                                <div class="ajax-field">
                                                    <input type="text" class="form-control" id="family_support" name="family_support" placeholder="₹ Family Support" value="{{$edit['family_support'] ?? '' }}">
                                                    <span id="family_support_err" class="error family_support_err small" style="color:red;"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="fw-semibold">
                                                <h5>Total (Per Month):</h5>
                                            </th>
                                            <td>
                                                <div class="ajax-field">
                                                    <input type="text" class="form-control" id="total_income" name="total_income" placeholder="₹ Total (Per Month)" value="{{$edit['total_income'] ?? '' }}" readonly>
                                                    <span id="total_income_err" class="error total_income_err small" style="color:red;"></span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>


                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-success submit-button">Save Details</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
@include('admin.common.footer')
<script>
    $(document).ready(function() {
        function calculateTotal() {
            var salary = parseFloat($('#salary').val()) || 0;
            var businessIncome = parseFloat($('#business_income').val()) || 0;
            var otherIncome = parseFloat($('#other_income').val()) || 0;
            var familySupport = parseFloat($('#family_support').val()) || 0;
            var total = salary + businessIncome + otherIncome + familySupport;
            $('#total_income').val(' ' + total.toFixed(2));
        }
        $('#salary, #business_income, #other_income, #family_support').on('input', function() {
            calculateTotal();
        });
        calculateTotal();
        $('input[type="text"]').on('input', function() {
            var value = $(this).val();
            $(this).val(value.replace(/[^0-9.]/g, ''));
        });
    });
</script>


@include('admin.common.end')