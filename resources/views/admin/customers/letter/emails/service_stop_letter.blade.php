<!DOCTYPE html>
<html>

<head>
    <title>Service Hold Notice</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>Service Hold Notice</h2>

    <p>Dear <strong>{{ ucfirst($customer->customer_name) }}</strong>,</p>

    <p>We regret to inform you that your debt settlement process has been put on hold due to:</p>

    <ul>
        <li><strong>Reason:</strong> [Non-payment/Lack of communication]</li>
    </ul>

    <p>To resume our services, please ensure compliance with the agreed terms:</p>

    <ul>
        <li><strong>Requirement:</strong> Payment of pending EMI</li>
        <li><strong>Details:</strong> [Amount]</li>
        <li><strong>Service Fee Payment:</strong> [If applicable]</li>
    </ul>

    <p>As per <strong>RBI’s fair practice codes</strong>, debt resolution should be honored as agreed to avoid legal implications.
        Failure to respond within <strong>[7 days]</strong> will result in service termination.</p>

    <p>Best Regards,</p>
    <p><strong>CDEF Debt Team</strong></p>
</body>

</html>
