<!DOCTYPE html>
<html>
<head>
    <title>Appointment Canceled</title>
</head>
<body>
    <p>Hello {{ $user->name }},</p>

    <p>We regret to inform you that your appointment with Dr. {{ $appointment->doctor->name }} on 
        <strong>{{ \Carbon\Carbon::parse($appointment->date)->format('F d, Y') }}</strong> at 
        <strong>{{ \Carbon\Carbon::parse($appointment->real_time)->format('g:i A') }}</strong> has been <strong>canceled</strong>.
    </p>

    <p>Thank you for your understanding.</p>
</body>
</html>
