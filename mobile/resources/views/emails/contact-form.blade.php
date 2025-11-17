<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
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
            background: linear-gradient(135deg, #5B265D 0%, #7a3a7d 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background: #f9f9f9;
            padding: 30px;
            border: 1px solid #e0e0e0;
        }
        .field {
            margin-bottom: 20px;
        }
        .field-label {
            font-weight: bold;
            color: #5B265D;
            display: block;
            margin-bottom: 5px;
        }
        .field-value {
            background: white;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #ddd;
        }
        .message-box {
            background: white;
            padding: 15px;
            border-radius: 3px;
            border: 1px solid #ddd;
            white-space: pre-wrap;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>New Contact Form Submission</h1>
    </div>
    
    <div class="content">
        <div class="field">
            <span class="field-label">Name:</span>
            <div class="field-value">{{ $name }}</div>
        </div>
        
        <div class="field">
            <span class="field-label">Email:</span>
            <div class="field-value">{{ $email }}</div>
        </div>
        
        @if($phone)
        <div class="field">
            <span class="field-label">Phone:</span>
            <div class="field-value">{{ $phone }}</div>
        </div>
        @endif
        
        <div class="field">
            <span class="field-label">Message:</span>
            <div class="message-box">{{ $message }}</div>
        </div>
    </div>
    
    <div class="footer">
        <p>This email was sent from the contact form on {{ config('app.name') }}</p>
        <p>Reply to: {{ $email }}</p>
    </div>
</body>
</html>

