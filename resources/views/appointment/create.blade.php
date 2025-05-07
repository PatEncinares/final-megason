@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4">
            <img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/appointment.JPG') }}" alt="Patient Management">Appointment Management
        </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Create Appointment</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Create Appointment</div>
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

                    {{-- Specialization --}}
                    @if(Auth::user()->type != 2)
                    <div class="form-group row">
                        <label for="specialization_filter" class="col-md-4 col-form-label text-md-right">Specialization:</label>
                        <div class="col-md-6">
                            <select id="specialization_filter" class="form-control select2" name="specialization_id" required>
                                <option value="">-- Filter by Specialization --</option>
                                @foreach($data['specializations'] as $spec)
                                    <option value="{{ $spec->id }}">{{ $spec->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif

                    {{-- Doctor --}}
                    @if(Auth::user()->type != 2)
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Select Doctor:</label>
                        <div class="col-md-6">
                            <select name="doctor_id" id="doctor" class="form-control select2" required disabled>
                                <option value="" disabled selected>-- Select Doctor --</option>
                            </select>
                        </div>
                    </div>
                    @else
                        <input type="hidden" id="doctor" name="doctor_id" value="{{ Auth::user()->id }}">
                    @endif

                    {{-- Date --}}
                    <div class="form-group row">
                        <label for="date_display" class="col-md-4 col-form-label text-md-right">Select Date:</label>
                        <div class="col-md-6">
                            <input type="text" id="date_display" class="form-control" placeholder="-- Select Date --" required readonly>
                            <input type="hidden" id="date" name="date">
                            <small id="slotCount" class="form-text text-muted mt-2" style="font-weight: bold;"></small>
                        </div>
                    </div>

                    {{-- Time --}}
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
    const visibleInput = document.getElementById('date_display');
    const hiddenInput = document.getElementById('date');
    const allowedDayIndexes = allowedDays.map(day => weekdayToIndex(day));

    if (visibleInput._flatpickr) visibleInput._flatpickr.destroy();

    flatpickr(visibleInput, {
        dateFormat: "Y-m-d",
        minDate: "today",
        disable: [date => !allowedDayIndexes.includes(date.getDay())],
        onChange: function (selectedDates, dateStr) {
            hiddenInput.value = dateStr;

            const doctorId = document.getElementById('doctor').value;
            if (!doctorId) return;

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
                    document.getElementById('real_time').disabled = true;
                    document.getElementById('real_time').innerHTML = '<option value="">-- Select Time --</option>';
                    document.getElementById('slotCount').innerText = '';
                });
        }
    });
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

function formatAMPM(hour, minute) {
    const h = hour % 12 || 12;
    const m = String(minute).padStart(2, '0');
    const ampm = hour < 12 ? 'AM' : 'PM';
    return `${h}:${m} ${ampm}`;
}

$(document).ready(function () {
    const $doctor = $('#doctor');
    const $date = $('#date');
    const $time = $('#real_time');
    const $slotCount = $('#slotCount');

    $('#specialization_filter').select2({
        placeholder: '-- Filter by Specialization --',
        width: '100%',
        allowClear: true
    });

    $doctor.select2({
        placeholder: '-- Select Doctor --',
        width: '100%'
    });

    $('#specialization_filter').on('change', function () {
        const specId = $(this).val();
        if (!specId) return;

        $doctor.prop('disabled', true).html('<option value="">Loading...</option>');
        $date.val('');
        $time.prop('disabled', true).val('');
        $slotCount.text('');

        fetch(`/appointments/doctors-by-specialization/${specId}`)
            .then(res => res.json())
            .then(doctors => {
                let options = '<option value="">-- Select Doctor --</option>';
                doctors.forEach(doc => {
                    options += `<option value="${doc.id}">${doc.fullname}</option>`;
                });
                $doctor.html(options).prop('disabled', false);
                $doctor.trigger('change.select2');
            })
            .catch(() => {
                $doctor.html('<option value="">-- Failed to Load --</option>').prop('disabled', true);
            });
    });

    $doctor.on('change', function () {
        const doctorId = $(this).val();
        if (!doctorId) return;

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

                setTimeout(() => {
                    const flatpickrInstance = document.getElementById('date_display')._flatpickr;
                    if (flatpickrInstance && flatpickrInstance.altInput) {
                        const altInput = flatpickrInstance.altInput;
                        altInput.disabled = false;
                        altInput.placeholder = 'Select Date';
                    }
                }, 100);
            });
    });
});
</script>

<style>
input.flatpickr-input[readonly] {
    background-color: #ffffff !important;
    color: #000000 !important;
    cursor: pointer;
}
</style>

@include('layouts.dashboard.footer')
@endsection
