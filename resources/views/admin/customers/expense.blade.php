@include('admin.common.header')

<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h4 class="mb-0"><span class="text-muted fw-light">Dashboard / Customer</span> Expense Form</h4>
        <div>
            <a href="{{route('admin.customer.expense', ['id' => $id])}}" class="btn btn-primary">Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-12 col-lg-8">
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
                <div class="col-12 col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4 class="card-tile mb-0"></h4>
                        </div>
                        <div class="card-body">
                            <div class="ajax-msg"></div>
                            <form class="form" id="ajax_form" route="save-expense" method="post">
                                @csrf
                                <div class="ajax-msg"></div>
                                <input type="hidden" name="customer_id" value="{{base64_decode($id)}}">
                                <input type="hidden" name="expense_id" value="{{$edit['id'] ?? ''}}">
                                <table class="table">
                                    <tbody>
                                        <!-- Living Expenses -->
                                        <tr>
                                            <th colspan="2" class="fw-bold">
                                                <h5>Living Expenses</h5>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="fw-semibold">Rent/Maintenance (Per Month):</th>
                                            <td>
                                                <div class="ajax-field">
                                                    <input type="text" class="form-control" id="rent_maintenance" name="rent" placeholder="₹ Rent/Maintenance (Per Month)" value="{{$edit['rent'] ?? ''}}">
                                                    <span id="rent_err" class="error rent_err small" style="color:red;"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="fw-semibold">Grocery Expenses (Per Month)</th>
                                            <td>
                                                <div class="ajax-field">
                                                    <input type="text" class="form-control" id="grocery_expenses" name="grocery" placeholder="₹ Grocery Expenses (Per Month)" value="{{$edit['grocery'] ?? ''}}">
                                                    <span id="grocery_err" class="error grocery_err small" style="color:red;"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="fw-semibold">Electricity Bill (Per Month)</th>
                                            <td>
                                                <div class="ajax-field">
                                                    <input type="text" class="form-control" id="electricity_bill" name="electricity_bill" placeholder="₹ Electricity Bill (Per Month)" value="{{$edit['electricity_bill'] ?? ''}}">
                                                    <span id="electricity_bill_err" class="error electricity_bill_err small" style="color:red;"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="fw-semibold">Gas Bill (Per Month)</th>
                                            <td>
                                                <div class="ajax-field">
                                                    <input type="text" class="form-control" id="gas_bill" name="gas_bill" placeholder="₹ Gas Bill (Per Month)" value="{{$edit['gas_bill'] ?? ''}}">
                                                    <span id="gas_bill_err" class="error gas_bill_err small" style="color:red;"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="fw-semibold">Phone Bill (Per Month)</th>
                                            <td>
                                                <div class="ajax-field">
                                                    <input type="text" class="form-control" id="phone_bill" name="phone_bill" placeholder="₹ Phone Bill (Per Month)" value="{{$edit['phone_bill'] ?? ''}}">
                                                    <span id="phone_bill_err" class="error phone_bill_err small" style="color:red;"></span>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="fw-semibold">Other Utility (Per Month):</th>
                                            <td>
                                                <div class="ajax-field">
                                                    <input type="text" class="form-control" id="other_utility" name="other_utility" placeholder="₹ Other Utility (Per Month)" value="{{$edit['other_utility'] ?? ''}}">
                                                    <span id="other_utility_err" class="error other_utility_err small" style="color:red;"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="fw-semibold">
                                                <h6>Total Living Expenses (Per Month)</h6>
                                            </th>
                                            <td>
                                                <div class="ajax-field">
                                                    <input type="text" class="form-control" id="total_living_expenses" name="total_living_expense" placeholder="₹ Total Living Expenses (Per Month)" value="{{$edit['total_living_expense'] ?? ''}}" readonly>
                                                    <span id="total_living_expense_err" class="error total_living_expense_err small" style="color:red;"></span>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Lifestyle Expenses -->
                                        <tr>
                                            <th colspan="2" class="fw-bold">
                                                <h5>Lifestyle Expenses</h5>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="fw-semibold">Travel/Fuel (Per Month)</th>
                                            <td>
                                                <div class="ajax-field">
                                                    <input type="text" class="form-control" id="travel_fuel" name="travel" placeholder="₹ Travel/Fuel (Per Month)" value="{{$edit['travel'] ?? ''}}">
                                                    <span id="travel_err" class="error travel_err small" style="color:red;"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="fw-semibold">Digital Subscription (Per Month)</th>
                                            <td>
                                                <div class="ajax-field">
                                                    <input type="text" class="form-control" id="digital_subscription" name="digital_subcription" placeholder="₹ Digital Subscription (Per Month)" value="{{$edit['digital_subcription'] ?? ''}}">
                                                    <span id="digital_subcription_err" class="error digital_subcription_err small" style="color:red;"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="fw-semibold">Dining Out (Per Month)</th>
                                            <td>
                                                <div class="ajax-field">
                                                    <input type="text" class="form-control" id="dining_out" name="dining_out" placeholder="₹ Dining Out (Per Month)" value="{{$edit['dining_out'] ?? ''}}">
                                                    <span id="dining_out_err" class="error dining_out_err small" style="color:red;"></span>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="fw-semibold">House Help (Per Month)</th>
                                            <td>
                                                <div class="ajax-field">
                                                    <input type="text" class="form-control" id="house_help" name="house_help" placeholder="₹ House Help (Per Month)" value="{{$edit['house_help'] ?? ''}}">
                                                    <span id="house_help_err" class="error house_help_err small" style="color:red;"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="fw-semibold">Outing (Per Month)</th>
                                            <td>
                                                <div class="ajax-field">
                                                    <input type="text" class="form-control" id="outing" name="outing" placeholder="₹ Outing (Per Month)" value="{{$edit['outing'] ?? ''}}">
                                                    <span id="outing_err" class="error outing_err small" style="color:red;"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="fw-semibold">
                                                <h6>Total Lifestyle Expenses (Per Month)</h6>
                                            </th>
                                            <td>
                                                <div class="ajax-field">
                                                    <input type="text" class="form-control" id="total_lifestyle_expenses" name="total_lifestyle_expense" placeholder="₹ Total Lifestyle Expenses (Per Month)" value="{{$edit['total_lifestyle_expense'] ?? ''}}" readonly>
                                                    <span id="total_lifestyle_expense_err" class="error total_lifestyle_expense_err small" style="color:red;"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="fw-semibold">
                                                <h5>TOTAL EXPENSES (Per Month)</h5>
                                            </th>
                                            <td>
                                                <div class="ajax-field">
                                                    <input type="text" class="form-control" id="total_expenses" name="total_expenses" placeholder="₹ TOTAL EXPENSES (Per Month)" value="₹ {{$edit['total_expenses'] ?? ''}}" readonly>
                                                    <span id="total_expenses_err" class="error total_expenses_err small" style="color:red;"></span>
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

        function calculateLivingExpenses() {
            var rentMaintenance = parseFloat($('#rent_maintenance').val()) || 0;
            var groceryExpenses = parseFloat($('#grocery_expenses').val()) || 0;
            var electricityBill = parseFloat($('#electricity_bill').val()) || 0;
            var gasBill = parseFloat($('#gas_bill').val()) || 0;
            var phoneBill = parseFloat($('#phone_bill').val()) || 0;
            var otherUtility = parseFloat($('#other_utility').val()) || 0;

            var totalLiving = rentMaintenance + groceryExpenses + electricityBill + gasBill + phoneBill + otherUtility;
            $('#total_living_expenses').val('' + totalLiving.toFixed(2));
            calculateTotalExpenses();
        }


        function calculateLifestyleExpenses() {
            var travelFuel = parseFloat($('#travel_fuel').val()) || 0;
            var digitalSubscription = parseFloat($('#digital_subscription').val()) || 0;
            var diningOut = parseFloat($('#dining_out').val()) || 0;
            var houseHelp = parseFloat($('#house_help').val()) || 0;
            var outing = parseFloat($('#outing').val()) || 0;

            var totalLifestyle = travelFuel + digitalSubscription + diningOut + houseHelp + outing;
            $('#total_lifestyle_expenses').val('' + totalLifestyle.toFixed(2));
            calculateTotalExpenses();
        }


        function calculateTotalExpenses() {
            var totalLiving = parseFloat($('#total_living_expenses').val().replace(/[^0-9.]/g, '')) || 0;
            var totalLifestyle = parseFloat($('#total_lifestyle_expenses').val().replace(/[^0-9.]/g, '')) || 0;
            var totalExpenses = totalLiving + totalLifestyle;
            $('#total_expenses').val('' + totalExpenses.toFixed(2));
        }



        $('#rent_maintenance, #grocery_expenses, #electricity_bill, #gas_bill, #phone_bill, #other_utility').on('input', function() {
            calculateLivingExpenses();
        });

        $('#travel_fuel, #digital_subscription, #dining_out, #house_help, #outing').on('input', function() {
            calculateLifestyleExpenses();
        });


        calculateLivingExpenses();
        calculateLifestyleExpenses();


        $('input[type="text"]').on('input', function() {
            var value = $(this).val();
            $(this).val(value.replace(/[^0-9.]/g, ''));
        });
    });
</script>


@include('admin.common.end')