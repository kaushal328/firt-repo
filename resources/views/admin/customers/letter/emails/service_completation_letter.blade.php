<!DOCTYPE html>
<html>

<head>
    <title>Service Completion Letter</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>Service Completion Letter</h2>
    <p>Dear <strong>{{ ucfirst($customer->customer_name) }}</strong>,</p>
    <p>Congratulations! Your debt settlement process has been successfully completed. Your finalized settlement details
        are:</p>

    <ul>
        <li><strong>Settlement Amount Paid:</strong> {{ '₹' . number_format($customer_plan_offer->payment_amount) ?? '0' }}</li>
        <li><strong>Service Fee Paid:</strong> {{  $customer_plan_offer->settlement_offer . '%' ?? '' }}</li>
        <li><strong>Creditor Confirmation:</strong> {{ $customer_plan_offer->creditor_confirmation ?? '' }}</li>
    </ul>

    <p>This process complies with <strong>Debt Settlement Guidelines under Indian Financial Law</strong>, ensuring your
        settlement is legally recognized. Please keep this letter for your records.</p>

    <p>If you need further assistance, feel free to contact us.</p>

    <p>Best Regards,</p>
    <p><strong>CDEF Debt Team</strong></p>
</body>

</html>
