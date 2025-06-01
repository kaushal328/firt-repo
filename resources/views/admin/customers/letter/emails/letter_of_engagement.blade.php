<!DOCTYPE html>
<html>

<head>
    <title>Letter of Engagement (LOE)</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>Letter of Engagement (LOE)</h2>

    <p>Dear <strong>{{ ucfirst($customer->customer_name) }}</strong>,</p>

    <p>This Letter of Engagement confirms your agreement to engage CDEF Debt for debt settlement services. By signing
        this document, you authorize us to communicate with your creditors, negotiate settlements, and manage your debt
        resolution process.</p>

    <h3>Terms & Details</h3>
    <ul>
        <li> We will handle creditor negotiations on your behalf.</li>

        @if (isset($customer_plan) && $customer_plan->plans->offer_name == 'Onetime Settlement')
        <li> You agree to pay a service fee of {{ $customer_plan->settlement_percentage . '%' }} of the settled
            amount.</li>
        @endif
        @if(isset($customer_plan) && $customer_plan->plans->offer_name == "Onetime Settlement")

        <li> Your selected payment method is <strong>₹ {{ number_format($customer_plan->settlement_amount)
                }}</strong> as per the agreed plan.</li>
        @elseif(isset($customer_plan) && $customer_plan->total_emi && $customer_plan->tenure)
        Your selected payment method is ₹ {{ number_format($customer_plan->total_emi ?? 0) }} for {{
        $customer_plan->tenure ?? "None" }} months as per the agreed plan
        @endif
        <li> You will not negotiate with creditors independently during this engagement.</li>
        <li> Settlement is subject to creditor acceptance.</li>
        <li> As per the <strong>Debt Recovery Tribunal (DRT) and RBI guidelines</strong>, all financial settlements must
            be documented, and you must comply with the agreed payment structure.</li>
    </ul>

    <p>Kindly sign and return this LOE to initiate the process.</p>

    <p>Sincerely,</p>
    <p><strong>CDEF Debt Team</strong></p>
</body>

</html>