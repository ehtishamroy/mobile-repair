<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Newsletter Subscription</title>
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
            color: #333;
            padding: 10px;
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
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
        <h1>New Newsletter Subscription</h1>
    </div>
    <div class="content">
        <p>You have received a new newsletter subscription:</p>
        
        <div class="field">
            <span class="field-label">Name:</span>
            <div class="field-value">{{ $name ?? 'Not provided' }}</div>
        </div>
        
        <div class="field">
            <span class="field-label">Email:</span>
            <div class="field-value">{{ $email }}</div>
        </div>
        
        <div class="field">
            <span class="field-label">Subscribed At:</span>
            <div class="field-value">{{ now()->format('F j, Y g:i A') }}</div>
        </div>
    </div>
    <div class="footer">
        <p>This is an automated notification from {{ config('app.name') }}</p>
    </div>
</body>
</html>

