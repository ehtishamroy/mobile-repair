<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #5B265D;
        }
        .success-icon {
            width: 60px;
            height: 60px;
            background-color: #5B265D;
            border-radius: 50%;
            display: inline-block;
            line-height: 60px;
            color: white;
            font-size: 30px;
            margin-bottom: 15px;
        }
        h1 {
            color: #5B265D;
            margin: 10px 0;
            font-size: 24px;
        }
        h2 {
            color: #333;
            font-size: 20px;
            margin-top: 25px;
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        .order-info {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: bold;
            color: #666;
        }
        .info-value {
            color: #333;
        }
        .total-row {
            font-size: 18px;
            font-weight: bold;
            color: #5B265D;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 2px solid #5B265D;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #5B265D;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            text-align: center;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <div class="success-icon">✓</div>
            <h1>Repair Order Confirmed!</h1>
            <p>Thank you for choosing our repair service. Your order has been received and is being processed.</p>
        </div>

        <div class="order-info">
            <div class="info-row">
                <span class="info-label">Order Number:</span>
                <span class="info-value">#{{ $order->order_number }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Service:</span>
                <span class="info-value">{{ $order->service->name ?? 'N/A' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Order Date:</span>
                <span class="info-value">{{ $order->created_at->format('d M, Y g:i A') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Status:</span>
                <span class="info-value" style="text-transform: capitalize;">{{ $order->status }}</span>
            </div>
        </div>

        <h2>Customer Details</h2>
        <div class="order-info">
            <div class="info-row">
                <span class="info-label">Name:</span>
                <span class="info-value">{{ $order->customer_name }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Phone:</span>
                <span class="info-value">{{ $order->customer_phone }}</span>
            </div>
        </div>

        <h2>Device Details</h2>
        <div class="order-info">
            <div class="info-row">
                <span class="info-label">Device Model:</span>
                <span class="info-value">{{ $order->device_model }}</span>
            </div>
            @if($order->deviceType)
            <div class="info-row">
                <span class="info-label">Device Type:</span>
                <span class="info-value">{{ $order->deviceType->name }}</span>
            </div>
            @endif
            @if($order->selected_issues && count($order->selected_issues) > 0)
            <div class="info-row">
                <span class="info-label">Selected Issues:</span>
                <span class="info-value">
                    @php
                        $issueNames = \App\Models\RepairIssue::whereIn('id', $order->selected_issues)->pluck('name')->toArray();
                    @endphp
                    {{ implode(', ', $issueNames) }}
                </span>
            </div>
            @else
            <div class="info-row">
                <span class="info-label">Issue:</span>
                <span class="info-value">Inspection Required</span>
            </div>
            @endif
            @if($order->issue_description)
            <div class="info-row">
                <span class="info-label">Description:</span>
                <span class="info-value">{{ $order->issue_description }}</span>
            </div>
            @endif
        </div>

        @if($order->address)
        <h2>Shipping Address</h2>
        <div class="order-info">
            <p style="margin: 0; white-space: pre-line;">{{ $order->address }}</p>
        </div>
        @endif

        <h2>Order Summary</h2>
        <div class="order-info">
            @if($order->subtotal > 0)
            <div class="info-row">
                <span class="info-label">Repair Cost:</span>
                <span class="info-value">{{ $currencySymbol }}{{ number_format($order->subtotal, 2) }}</span>
            </div>
            @endif
            @if($order->inspection_fee > 0)
            <div class="info-row">
                <span class="info-label">Inspection Fee:</span>
                <span class="info-value">{{ $currencySymbol }}{{ number_format($order->inspection_fee, 2) }}</span>
            </div>
            @endif
            <div class="info-row total-row">
                <span>Total Amount:</span>
                <span>{{ $currencySymbol }}{{ number_format($order->total, 2) }}</span>
            </div>
        </div>

        <div class="footer">
            <p>If you have any questions, please contact our support team.</p>
            <p>&copy; {{ date('Y') }} {{ $settings->site_name ?? 'Harrow Mobiles' }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>

