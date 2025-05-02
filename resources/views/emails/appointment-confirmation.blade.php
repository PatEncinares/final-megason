<!DOCTYPE html>
<html>
<head>
    <title>Appointment Confirmation</title>
</head>
<body>
    <p>Hello {{ $user->name }},</p>

    <p>We have received your appointment request with Dr. {{ $appointment->doctor->name }} on 
        <strong>{{ \Carbon\Carbon::parse($appointment->date)->format('F d, Y') }}</strong> at 
        <strong>{{ \Carbon\Carbon::parse($appointment->real_time)->format('g:i A') }}</strong>.
    </p>

    <p>Your request is currently pending and will be reviewed by our staff. Once approved, the schedule will be officially confirmed.</p>

    <p>We will notify you once your appointment is approved. Thank you for choosing Megason Clinic</p>
</body>
</html>
