<!DOCTYPE html>
<html>

<head>
    <title>Welcome to CDEF Debt</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333">
    <h2>Welcome Letter</h2>

    <p>
        Dear <strong>{{ ucfirst($customer->customer_name) }}</strong>,
    </p>

    <p>
        We welcome you to CDEF Debt and appreciate your trust in our
        services. Your debt resolution process is now in progress, and our
        team is actively working on your case.
    </p>

    <h3>Your Plan Details</h3>
    <ul>
        <li>
            <strong>Settlement Type:</strong>
            @if (isset($customer_plan->plans))
            {{ $customer_plan->plans->offer_name }}
            @else
            {{ "None" }}
            @endif
        </li>
        <li><strong>Agreed Amount:</strong> 
             @if(isset($customer_plan) && $customer_plan->plans->offer_name == "Onetime Settlement")
            ₹ {{ number_format($customer_plan->settlement_amount) }}
            @elseif(isset($customer_plan) && $customer_plan->plans->offer_name == "DMP Plan")
            ₹ {{ number_format($customer_plan->dmp_amount) }}
            @endif
        
        </li>
       
        <li>
            <strong>Payment Mode:</strong>
            @if(isset($customer_plan) && $customer_plan->plans->offer_name == "Onetime Settlement")
            One-time settlement of ₹ {{ number_format($customer_plan->settlement_amount ?? 0) }}
            @elseif(isset($customer_plan) && $customer_plan->total_emi && $customer_plan->tenure)
            EMI of ₹ {{ number_format($customer_plan->total_emi ?? 0) }} for {{ $customer_plan->tenure ?? "None" }}
            months
            @else
            None
            @endif
        </li>
        
        @if(!$customer_plan->plans->offer_name == "DMP Plan")
        <li>
            <strong>Our Service Fee:</strong>
            @if(isset($customer_plan) && $customer_plan->plans->offer_name == "Onetime Settlement")
            {{ $customer_plan->settlement_percentage == 0 ? "" : $customer_plan->settlement_percentage . "% of the
            settlement amount i.e." }}
            @elseif(isset($customer_plan) && $customer_plan->service_charge)
            {{ "₹ " . number_format($customer_plan->service_charge ?? 0) }}
            @else
            None
            @endif
        </li>
        @endif
    </ul>

    <p>
        In compliance with <storng>Indian Consumer Protection and Financial Laws</storng>, we
        assure you that your financial data remains confidential, and all
        settlements are legally processed. You may refer to RBI guidelines
        for further information on lawful financial resolutions.
    </p>

    <p>
        Please feel free to reach out for any assistance. We are here to
        guide you toward financial freedom.
    </p>

    <p>Best Regards,</p>
    <p><strong>CDEF Debt Team</strong></p>
</body>

</html>