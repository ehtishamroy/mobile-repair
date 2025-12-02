<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quote Request Received</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #684471;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .content {
            background-color: #f9f9f9;
            padding: 30px;
            border: 1px solid #ddd;
            border-top: none;
        }

        .info-box {
            background-color: #e3f2fd;
            border-left: 4px solid #2196F3;
            padding: 15px;
            margin: 20px 0;
        }

        .contact-box {
            background-color: #fff;
            border: 2px solid #684471;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }

        .contact-box h3 {
            color: #684471;
            margin-top: 0;
        }

        .contact-item {
            margin: 10px 0;
            padding-left: 25px;
            position: relative;
        }

        .contact-item:before {
            content: "📍";
            position: absolute;
            left: 0;
        }

        .contact-item.phone:before {
            content: "📞";
        }

        .contact-item.email:before {
            content: "✉️";
        }

        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .details-table th {
            background-color: #684471;
            color: white;
            padding: 10px;
            text-align: left;
        }

        .details-table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 12px;
        }

        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #684471;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Quote Request Received</h1>
        <p>Reference: {{ $orderNumber }}</p>
    </div>

    <div class="content">
        <p>Dear {{ $customerName }},</p>

        <p>Thank you for your quote request! We have received your device repair inquiry.</p>

        <div class="info-box">
            <strong>⚠️ Important:</strong> To provide you with an accurate quote, we need to inspect your device in
            person. Please visit our store at your earliest convenience.
        </div>

        <h3>Your Request Details:</h3>
        <table class="details-table">
            <tr>
                <th>Reference Number</th>
                <td><strong>{{ $orderNumber }}</strong></td>
            </tr>
            <tr>
                <th>Device Model</th>
                <td>{{ $deviceModel }}</td>
            </tr>
            <tr>
                <th>Issues Reported</th>
                <td>{{ $issues }}</td>
            </tr>
            @if($comments && $comments !== 'None')
                <tr>
                    <th>Additional Comments</th>
                    <td>{{ $comments }}</td>
                </tr>
            @endif
            @if($qualityTierName)
                <tr>
                    <th>Quality/Part Type</th>
                    <td>{{ $qualityTierName }}</td>
                </tr>
            @endif
        </table>

        <div class="contact-box">
            <h3>Visit Our Store</h3>
            <p>Please bring your device to our store for a free inspection and accurate quote:</p>

            <div class="contact-item">
                <strong>Address:</strong><br>
                Unit-2, 260 Streatfield Road<br>
                Harrow, London<br>
                United Kingdom, HA3 9BY
            </div>

            <div class="contact-item phone">
                <strong>Phone:</strong><br>
                <a href="tel:+447503683786">+44 7503 683786</a>
            </div>

            <div class="contact-item email">
                <strong>Email:</strong><br>
                <a href="mailto:harrowmobiles@gmail.com">harrowmobiles@gmail.com</a>
            </div>
        </div>

        <h3>What to Expect:</h3>
        <ul>
            <li>Our technicians will inspect your device thoroughly</li>
            <li>We'll provide you with a detailed quote on the spot</li>
            <li>No obligation - you decide if you want to proceed</li>
            <li>Quick turnaround time for most repairs</li>
        </ul>

        <p><strong>Please bring this reference number with you: {{ $orderNumber }}</strong></p>

        <p>If you have any questions before visiting, feel free to contact us using the details above.</p>

        <p>We look forward to serving you!</p>

        <p>Best regards,<br>
            <strong>Harrow Mobiles Team</strong>
        </p>
    </div>

    <div class="footer">
        <p>This is an automated message. Please do not reply to this email.</p>
        <p>&copy; {{ date('Y') }} Harrow Mobiles. All rights reserved.</p>
    </div>
</body>

</html>