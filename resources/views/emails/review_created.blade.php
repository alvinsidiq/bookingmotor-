<!DOCTYPE html>
<html>
<head>
    <title>New Review Submitted</title>
</head>
<body>
    <h1>New Review Submitted</h1>
    <p>A new review has been submitted for {{ $review->motorcycle->name }}.</p>
    <p><strong>User:</strong> {{ $review->user->name }}</p>
    <p><strong>Booking ID:</strong> {{ $review->booking_id }}</p>
    <p><strong>Rating:</strong> {{ $review->rating }}/5</p>
    <p><strong>Comment:</strong> {{ $review->comment ?? 'No comment provided.' }}</p>
    <p>Visit the admin panel to review this submission.</p>
</body>
</html>