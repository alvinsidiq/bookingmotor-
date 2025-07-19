<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Booking Status Updated</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">
    <h2>Booking Status Updated</h2>
    <p>Dear {{ $booking->user->name }},</p>
    <p>Your booking status has been updated. Here are the details:</p>
    <ul>
        <li><strong>Booking ID:</strong> {{ $booking->id }}</li>
        <li><strong>Motorcycle:</strong> {{ $booking->motorcycle->name }}</li>
        <li><strong>Location:</strong> {{ $booking->location->name }}</li>
        <li><strong>Start Date:</strong> {{ $booking->start_date->format('Y-m-d H:i') }}</li>
        <li><strong>End Date:</strong> {{ $booking->end_date->format('Y-m-d H:i') }}</li>
        <li><strong>Total Cost:</strong> Rp {{ number_format($booking->total_cost, 0) }}</li>
        <li><strong>Status:</strong> {{ ucfirst($booking->status) }}</li>
        <li><strong>Payment Status:</strong> {{ ucfirst($booking->payment_status) }}</li>
    </ul>
    <p>Thank you for choosing Motorcycle Booking!</p>
</body>
</html>