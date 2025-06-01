<!DOCTYPE html>
<html>

<head>
    <title>Debt Settlement Offer</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>Offer Sent Letter</h2>

    <p>Dear <strong>{{ ucfirst($customer->customer_name) }}</strong>,</p>

    <p>We are pleased to present you with a customized debt settlement offer through CDEF Debt. Based on our assessment
        of your financial situation, we propose the following plan:</p>

    <ul>
        <li>
            <strong>Offer Plan:</strong>
            @if(isset($customer_plan->plans))
            {{ $customer_plan->plans->offer_name }}
            @else
            {{"None"}}
            @endif
        </li>
        <li>
            <strong>Settlement Amount:</strong>
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

    <p>Upon accepting this offer, we will negotiate with your creditors and work towards a favorable settlement. Please
        sign and return this letter as confirmation of your consent.</p>
    <p>As per the <strong>Reserve Bank of India (RBI) guidelines</strong>, all debt settlements must comply with lawful
        financial practices, and we ensure full transparency in our negotiation process. Your cooperation in adhering to
        the agreed payment terms is essential for a successful resolution.</p>
    <p>Best Regards,</p>
    <p><strong>CDEF Debt Team</strong></p>
</body>

</html>