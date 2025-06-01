<!DOCTYPE html>
<html>

<head>
    <title>Debt Settlement Agreement</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>Debt Settlement Agreement</h2>

    <p>Dear <strong>{{ ucfirst($customer->customer_name) }}</strong>,</p>

    <p>I hope this message finds you well. Please find the details of our Debt Settlement Agreement outlined below for
        your review and acknowledgment:</p>

    <hr>

    <h3>Terms & Conditions</h3>
    <ul>
        <li>CDEF Debt will negotiate with creditors on your behalf.</li>



        @if (isset($customer_plan) && $customer_plan->plans->offer_name == 'Onetime Settlement')
        <li>The agreed settlement amount is <strong>₹
                {{ number_format($customer_plan->settlement_amount) }}</strong>, payable via
            {{ $customer_plan->plans->offer_name }}.
        </li>
        @elseif(isset($customer_plan) && $customer_plan->plans->offer_name == 'DMP Plan')
        <li>The agreed settlement amount is <strong>₹
                {{ number_format($customer_plan->dmp_amount) }}</strong>, payable via
            <strong>{{ $customer_plan->plans->offer_name }}</strong>.
        </li>
        @elseif(isset($customer_plan) && $customer_plan->total_emi)
        <li>The agreed settlement amount is <strong>₹ {{ number_format($customer_plan->total_emi) }}</strong>,
            payable via EMI {{ $customer_plan->plans->offer_name }} for
            {{ $customer_plan->tenure ?? 'None' }} Months .</li>
        @else
        @endif



        @if (isset($customer_plan) && $customer_plan->plans->offer_name == 'Onetime Settlement')
        <li>A service fee of <strong>{{ $customer_plan->settlement_percentage }}%</strong> applies, payable before
            settlement completion.</li>
        @endif
        <li>Client agrees not to engage with creditors directly.</li>
        <li>CDEF Debt does not guarantee settlement approval by creditors.</li>
        <li>Under the <strong>Insolvency and Bankruptcy Code, 2016</strong>, debt restructuring and settlements will
            follow regulatory norms, ensuring fair practices.</li>
    </ul>

    <p>By signing this agreement, you acknowledge the above terms and provide your consent to proceed with the debt
        settlement process.</p>

    <hr>
    <h3>Action Required</h3>
    <p>Kindly review the agreement and confirm your acceptance by replying to this email or by signing and returning the
        attached document.</p>

    <ul>
        <li><strong>Client Signature:</strong></li>
        <li><strong>Date: </strong>{{ Date('d/m/Y') }}</li>
        <li><strong>CDEF Debt Representative:</strong></li>
    </ul>
    <p>If you have any questions or require further clarification, feel free to reach out at your earliest convenience.
        We look forward to assisting you with the debt settlement process.</p>
    <p>Best regards,</p>
    <p><strong>{{ ucfirst($customer->customer_name) }}</strong></p>
    <p>CDEF Debt Representative</p>
    <p>Your Contact Information</p>
</body>

</html>