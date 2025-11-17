<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
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
            border-bottom: 2px solid #28a745;
        }
        .success-icon {
            width: 60px;
            height: 60px;
            background-color: #28a745;
            border-radius: 50%;
            display: inline-block;
            line-height: 60px;
            color: white;
            font-size: 30px;
            margin-bottom: 15px;
        }
        h1 {
            color: #28a745;
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
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 8px 0;
        }
        .info-label {
            font-weight: 600;
            color: #666;
        }
        .info-value {
            color: #333;
        }
        .order-items {
            margin: 20px 0;
        }
        .order-item {
            display: flex;
            padding: 15px;
            border-bottom: 1px solid #eee;
            align-items: center;
        }
        .order-item:last-child {
            border-bottom: none;
        }
        .item-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
            margin-right: 15px;
        }
        .item-details {
            flex: 1;
        }
        .item-name {
            font-weight: 600;
            margin-bottom: 5px;
            color: #333;
        }
        .item-variant {
            font-size: 12px;
            color: #666;
            margin-bottom: 5px;
        }
        .item-quantity {
            font-size: 14px;
            color: #666;
        }
        .item-price {
            font-weight: 600;
            color: #333;
            text-align: right;
        }
        .totals {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
        }
        .total-row:last-child {
            border-bottom: none;
            border-top: 2px solid #333;
            margin-top: 10px;
            padding-top: 15px;
            font-size: 18px;
            font-weight: 600;
        }
        .address-section {
            display: flex;
            gap: 20px;
            margin: 20px 0;
        }
        .address-box {
            flex: 1;
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
        }
        .address-title {
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }
        .address-text {
            color: #666;
            line-height: 1.8;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #666;
            font-size: 14px;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: 600;
        }
        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 12px;
            font-weight: 600;
        }
        .badge-success {
            background-color: #28a745;
            color: white;
        }
        .badge-warning {
            background-color: #ffc107;
            color: #333;
        }
        @media only screen and (max-width: 600px) {
            .address-section {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <div class="success-icon">✓</div>
            <h1>Thank You for Your Order!</h1>
            <p>Your order has been received and is being processed.</p>
        </div>

        <div class="order-info">
            <div class="info-row">
                <span class="info-label">Order Number:</span>
                <span class="info-value"><strong>{{ $order->order_number }}</strong></span>
            </div>
            <div class="info-row">
                <span class="info-label">Order Date:</span>
                <span class="info-value">{{ $order->created_at->format('F d, Y h:i A') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Payment Status:</span>
                <span class="info-value">
                    <span class="badge badge-{{ $order->payment_status === 'paid' ? 'success' : 'warning' }}">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </span>
            </div>
            <div class="info-row">
                <span class="info-label">Order Status:</span>
                <span class="info-value">
                    <span class="badge badge-warning">{{ ucfirst($order->status) }}</span>
                </span>
            </div>
        </div>

        <h2>Order Items</h2>
        <div class="order-items">
            @foreach($order->items as $item)
            <div class="order-item">
                <img 
                    src="{{ ($item->product && $item->product->featured_image) ? url('storage/' . $item->product->featured_image) : url('front-assets/img/phone-1.svg') }}" 
                    alt="{{ $item->product_name }}"
                    class="item-image"
                />
                <div class="item-details">
                    <div class="item-name">{{ $item->product_name }}</div>
                    @if($item->variant_data && !empty($item->variant_data))
                    <div class="item-variant">
                        @foreach($item->variant_data as $variantName => $variantValue)
                            <strong>{{ $variantName }}:</strong> {{ $variantValue }}@if(!$loop->last), @endif
                        @endforeach
                    </div>
                    @endif
                    <div class="item-quantity">Quantity: {{ $item->quantity }}</div>
                </div>
                <div class="item-price">
                    {{ $currencySymbol }}{{ number_format($item->subtotal, 2) }}
                </div>
            </div>
            @endforeach
        </div>

        <div class="totals">
            <div class="total-row">
                <span>Sub-total:</span>
                <span>{{ $currencySymbol }}{{ number_format($order->subtotal, 2) }}</span>
            </div>
            @if($order->discount > 0)
            <div class="total-row">
                <span>Discount:</span>
                <span>-{{ $currencySymbol }}{{ number_format($order->discount, 2) }}</span>
            </div>
            @endif
            @if($order->shipping_cost > 0)
            <div class="total-row">
                <span>Shipping:</span>
                <span>{{ $currencySymbol }}{{ number_format($order->shipping_cost, 2) }}</span>
            </div>
            @endif
            @if($order->tax > 0)
            <div class="total-row">
                <span>VAT:</span>
                <span>{{ $currencySymbol }}{{ number_format($order->tax, 2) }}</span>
            </div>
            @endif
            <div class="total-row">
                <span>Total:</span>
                <span>{{ $currencySymbol }}{{ number_format($order->total, 2) }} {{ $settings->currency ?? 'GBP' }}</span>
            </div>
        </div>

        <div class="address-section">
            <div class="address-box">
                <div class="address-title">Shipping Address</div>
                <div class="address-text">
                    {{ $order->customer_name }}<br>
                    {{ $order->shipping_address }}<br>
                    {{ $order->city }}, {{ $order->state }}<br>
                    {{ $order->zip_code }}<br>
                    {{ $order->country }}
                </div>
            </div>
            <div class="address-box">
                <div class="address-title">Billing Address</div>
                <div class="address-text">
                    {{ $order->customer_name }}<br>
                    {{ $order->billing_address }}<br>
                    {{ $order->city }}, {{ $order->state }}<br>
                    {{ $order->zip_code }}<br>
                    {{ $order->country }}
                </div>
            </div>
        </div>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('frontend.track-order') }}?order={{ $order->order_number }}" class="button">Track Your Order</a>
        </div>
        <div style="text-align: center; margin: 10px 0;">
            <p style="font-size: 14px; color: #666;">
                Or copy this link: <a href="{{ route('frontend.track-order') }}?order={{ $order->order_number }}" style="color: #007bff; word-break: break-all;">{{ route('frontend.track-order') }}?order={{ $order->order_number }}</a>
            </p>
        </div>

        @if($order->notes)
        <div style="background-color: #f8f9fa; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <div style="font-weight: 600; margin-bottom: 10px;">Order Notes:</div>
            <div style="color: #666;">{{ $order->notes }}</div>
        </div>
        @endif

        <div class="footer">
            <p>If you have any questions about your order, please contact us.</p>
            <p style="margin-top: 20px; font-size: 12px; color: #999;">
                This is an automated email. Please do not reply to this message.
            </p>
        </div>
    </div>
</body>
</html>

