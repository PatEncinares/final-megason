<!DOCTYPE html>
<html>
<head>
    <title>Appointment Approved</title>
</head>
<body>
    <p>Hello {{ $user->name }},</p>

    <p>Your appointment with Dr. {{ $appointment->doctor->name }} on 
        <strong>{{ \Carbon\Carbon::parse($appointment->date)->format('F d, Y') }}</strong> at 
        <strong>{{ \Carbon\Carbon::parse($appointment->real_time)->format('g:i A') }}</strong> has been <strong>approved</strong>.
    </p>

    <p>We look forward to seeing you. Please arrive a few minutes before your scheduled time.</p>

    <p>Thank you!</p>
</body>
</html>
