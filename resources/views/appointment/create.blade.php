@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/appointment.JPG') }}" alt="Patient Management">Appointment Management</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Create Appointment</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Create Appointment
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('save-appointment') }}">
                    @csrf

                    {{-- Patient --}}
                    @if(Auth::user()->type != 3)
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Select Patient:</label>
                            <div class="col-md-6">
                                <select name="patient_id" id="patient" class="form-control" required>
                                    <option value="" disabled selected>-- Select Patient --</option>
                                    @foreach($data['patients'] as $patient)
                                        <option value="{{ $patient['id'] }}" {{ old('patient_id') == $patient['id'] ? 'selected' : '' }}>
                                            {{ $patient['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @else
                        <input type="hidden" name="patient_id" value="{{ Auth::user()->id }}">
                    @endif

                    {{-- Doctor --}}
                    @if(Auth::user()->type != 2)
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Select Doctor:</label>
                            <div class="col-md-6">
                                <select name="doctor_id" id="doctor" class="form-control" required>
                                    <option value="" disabled selected>-- Select Doctor --</option>
                                    @foreach($data['doctors'] as $doctor)
                                        <option value="{{ $doctor['id'] }}" {{ old('doctor_id') == $doctor['id'] ? 'selected' : '' }}>
                                            {{ $doctor['doctorDetails']['specialization'] }} - {{ $doctor['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @else
                        <input type="hidden" id="doctor" name="doctor_id" value="{{ Auth::user()->id }}">
                    @endif

                    {{-- Date --}}
                    <div class="form-group row">
                        <label for="date" class="col-md-4 col-form-label text-md-right">Select Date:</label>
                        <div class="col-md-6">
                            <input type="text" id="date" name="date" class="form-control" required>
                            <small id="slotCount" class="form-text text-muted mt-2" style="font-weight: bold;"></small>
                        </div>
                    </div>

                    {{-- Time --}}
                    {{-- <div class="form-group row">
                        <label for="real_time" class="col-md-4 col-form-label text-md-right">Select Time:</label>
                        <div class="col-md-6">
                            <input type="time" id="real_time" name="real_time" class="form-control" required disabled onkeydown="return false;">
                        </div>
                    </div> --}}

                    <div class="form-group row">
                        <label for="real_time" class="col-md-4 col-form-label text-md-right">Select Time:</label>
                        <div class="col-md-6">
                            <select name="real_time" id="real_time" class="form-control" required disabled>
                                <option value="">-- Select Time --</option>
                            </select>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-calendar"></i> Set Appointment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    let doctorSchedule = {};
    let allowedDays = [];

    function weekdayToIndex(day) {
        return {
            'Sunday': 0,
            'Monday': 1,
            'Tuesday': 2,
            'Wednesday': 3,
            'Thursday': 4,
            'Friday': 5,
            'Saturday': 6
        }[day];
    }

    function setupFlatpickr() {
        const dateInput = document.getElementById('date');
        const timeInput = document.getElementById('real_time');
        const allowedDayIndexes = allowedDays.map(day => weekdayToIndex(day));

        if (dateInput._flatpickr) dateInput._flatpickr.destroy();

        flatpickr(dateInput, {
                dateFormat: "Y-m-d", // format sent to backend
                altInput: true,       // enables a pretty display format
                altFormat: "F j, Y",  // e.g., May 12, 2025
                minDate: "today",
                disable: [
                    function(date) {
                        return !allowedDayIndexes.includes(date.getDay());
                    }
                ],
                onChange: function(selectedDates, dateStr) {
                        const selected = selectedDates[0];
                        const weekday = selected.toLocaleDateString("en-US", {
                            weekday: 'long',
                            timeZone: 'Asia/Manila'
                        });

                        const doctorId = document.getElementById('doctor').value || {{ Auth::user()->type == 2 ? Auth::user()->id : 'null' }};

                        fetch(`/doctor-availability/${doctorId}/${dateStr}`)
                            .then(res => res.json())
                            .then(data => {
                                const timeInput = document.getElementById('real_time');
                                const slotCount = document.getElementById('slotCount');

                                if (!data.available || data.remaining_slots === 0) {
                                    alert("No available slots on this date.");
                                    timeInput.disabled = true;
                                    timeInput.innerHTML = '<option value="">-- No Slots --</option>';
                                    slotCount.innerText = 'Remaining Slots: 0 (Fully Booked)';
                                    slotCount.classList.add('text-danger');
                                    return;
                                }

                                timeInput.disabled = false;
                                generateTimeOptions(data.start_time, data.end_time);
                                slotCount.innerText = `Remaining Slots: ${data.remaining_slots}`;
                                slotCount.classList.remove('text-danger');
                            })
                            .catch(() => {
                                const slotCount = document.getElementById('slotCount');
                                alert("Failed to load availability.");
                                timeInput.disabled = true;
                                timeInput.innerHTML = '<option value="">-- Select Time --</option>';
                                slotCount.innerText = '';
                            });
                    }
            });

    }

     function formatAMPM(hour, minute) {
            const h = hour % 12 || 12;
            const m = String(minute).padStart(2, '0');
            const ampm = hour < 12 ? 'AM' : 'PM';
            return `${h}:${m} ${ampm}`;
        }

    function generateTimeOptions(start, end) {
            const select = document.getElementById('real_time');
            select.innerHTML = '<option value="">-- Select Time --</option>';

            const [startHour, startMin] = start.split(':').map(Number);
            const [endHour, endMin] = end.split(':').map(Number);

            const startTotal = startHour * 60 + startMin;
            const endTotal = endHour * 60 + endMin;

            for (let t = startTotal; t <= endTotal; t += 15) {
                const hour = Math.floor(t / 60);
                const minute = t % 60;
                const value = `${String(hour).padStart(2, '0')}:${String(minute).padStart(2, '0')}`;
                const label = formatAMPM(hour, minute);

                const option = document.createElement('option');
                option.value = value;
                option.textContent = label;
                select.appendChild(option);
            }
        }

    document.addEventListener('DOMContentLoaded', function () {
        const doctorSelect = document.getElementById('doctor');
        const timeInput = document.getElementById('real_time');
        const loggedInDoctorId = {{ Auth::user()->type == 2 ? Auth::user()->id : 'null' }};

        timeInput.disabled = true;

        function loadSchedule(doctorId) {
            fetch(`/doctor-schedule/${doctorId}`)
                .then(res => res.json())
                .then(data => {
                    doctorSchedule = {};
                    allowedDays = [];

                    data.forEach(s => {
                        const day = s.day_of_week.charAt(0).toUpperCase() + s.day_of_week.slice(1);
                        doctorSchedule[day] = {
                            start: s.start_time,
                            end: s.end_time
                        };
                        allowedDays.push(day);
                    });

                    setupFlatpickr();
                    document.getElementById('date').value = '';
                    timeInput.value = '';
                    timeInput.disabled = true;
                });
        }

        if (loggedInDoctorId) {
            loadSchedule(loggedInDoctorId);
        }

        if (doctorSelect && {{ Auth::user()->type }} != 2) {
            doctorSelect.addEventListener('change', function () {
                if (this.value) {
                    loadSchedule(this.value);
                }
            });
        }
    });
</script>

@include('layouts.dashboard.footer')
@endsection
