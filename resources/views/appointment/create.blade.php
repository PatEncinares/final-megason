    @extends('layouts.dashboard.main')

    @section('content')
    <main>
        <div class="container-fluid" id="app">
            <h1 class="mt-4">
                <img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/appointment.JPG') }}" alt="Patient Management">Appointment Management
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Create Appointment</li>
            </ol>
            <a href="{{ url()->previous() }}" class="btn btn-secondary d-print-none mb-2">
                <i class="fa fa-arrow-left"></i> Back
            </a>
            <div class="card mb-4">
                <div class="card-header"><i class="fas fa-table mr-1"></i>Create Appointment</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('save-appointment') }}">
                        @csrf
                    
                        {{-- Show all validation errors --}}
                        {{-- @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    --}}
                        {{-- Patient --}}
                        @if(Auth::user()->type != 3)
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Select Patient:</label>
                            <div class="col-md-6">
                                <select name="patient_id" id="patient" class="form-control {{ $errors->has('patient_id') ? 'is-invalid' : '' }}" >
                                    <option value="" disabled {{ old('patient_id') ? '' : 'selected' }}>-- Select Patient --</option>
                                    @foreach($data['patients'] as $patient)
                                        <option value="{{ $patient['id'] }}" {{ old('patient_id') == $patient['id'] ? 'selected' : '' }}>
                                            {{ $patient['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('patient_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('patient_id') }}</strong>
                                    </span>
                                @endif
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
                                <select id="specialization_filter" class="form-control select2 {{ $errors->has('specialization_id') ? 'is-invalid' : '' }}" name="specialization_id">
                                    <option value="">-- Filter by Specialization --</option>
                                    @foreach($data['specializations'] as $spec)
                                        <option value="{{ $spec->id }}" {{ old('specialization_id') == $spec->id ? 'selected' : '' }}>
                                            {{ $spec->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('specialization_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('specialization_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        
                        {{-- Doctor --}}
                        @if(Auth::user()->type != 2)
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Select Doctor:</label>
                            <div class="col-md-6">
                                <select name="doctor_id" id="doctor" class="form-control select2 {{ $errors->has('doctor_id') ? 'is-invalid' : '' }}" disabled>
                                    <option value="" disabled selected>-- Select Doctor --</option>
                                </select>
                                @if ($errors->has('doctor_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('doctor_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @else
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Doctor:</label>
                            <div class="col-md-6">
                                <input type="hidden" id="loggedin_doctor_id" name="doctor_id" value="{{ Auth::user()->id }}">
                                <input type="text" class="form-control" value="{{ Auth::user()->name }}" disabled>
                            </div>
                        </div>
                        @endif

                        {{-- Date --}}
                        <div class="form-group row">
                            <label for="date_display" class="col-md-4 col-form-label text-md-right">Select Date:</label>
                            <div class="col-md-6">
                                <input type="text" id="date_display" class="form-control" placeholder="-- Select Date --" readonly>
                                <input type="hidden" id="date" name="date" value="{{ old('date') }}">
                                <small id="slotCount" class="form-text text-muted mt-2" style="font-weight: bold;"></small>
                                @if ($errors->has('date'))
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    
                        {{-- Time --}}
                        <div class="form-group row">
                            <label for="real_time" class="col-md-4 col-form-label text-md-right">Select Time:</label>
                            <div class="col-md-6">
                                <select name="real_time" id="real_time" class="form-control {{ $errors->has('real_time') ? 'is-invalid' : '' }}" disabled >
                                    <option value="">-- Select Time --</option>
                                </select>
                                @if ($errors->has('real_time'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('real_time') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    
                        {{-- Submit --}}
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-calendar"></i> Set Appointment
                                </button>
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

                // const doctorId = document.getElementById('doctor').value;
                const doctorId = document.getElementById('doctor') ? document.getElementById('doctor').value : document.getElementById('loggedin_doctor_id').value;

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

         $('#patient').select2({
            placeholder: '-- Select Patient --',
            allowClear: true,
            width: '100%'
        });
        
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
    @if(Auth::user()->type == 2)
    const doctorId = '{{ Auth::user()->id }}';
    // Simulate selection for logged-in doctor
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

            // Optional: pre-trigger time slot generation if a date is already selected
            const existingDate = document.getElementById('date').value;
            if (existingDate) {
                fetch(`/doctor-availability/${doctorId}/${existingDate}`)
                    .then(res => res.json())
                    .then(data => {
                        const timeInput = document.getElementById('real_time');
                        const slotCount = document.getElementById('slotCount');

                        if (!data.available || data.remaining_slots === 0) {
                            timeInput.disabled = true;
                            timeInput.innerHTML = '<option value="">-- No Slots --</option>';
                            slotCount.innerText = 'Remaining Slots: 0 (Fully Booked)';
                            slotCount.classList.add('text-danger');
                        } else {
                            timeInput.disabled = false;
                            generateTimeOptions(data.start_time, data.end_time);
                            slotCount.innerText = `Remaining Slots: ${data.remaining_slots}`;
                            slotCount.classList.remove('text-danger');
                        }
                    });
            }
        })
        .catch(() => {
            console.warn("Failed to auto-load schedule for doctor.");
        });

@endif

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
