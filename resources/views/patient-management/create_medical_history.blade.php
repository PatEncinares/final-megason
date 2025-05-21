@extends('layouts.dashboard.main')

@section('content')
    <main>
        <div class="container-fluid" id="app">
            <h1 class="mt-4">
                <img class="save-medical-history card-img-top img-thumbnail" style="height: 60px; width: 60px"
                    src="{{ asset('assets/quick_links/patient.png') }}" alt="Patient Management">
                Patient Management
            </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Create Medical History</li>
            </ol>

            <form method="POST" action="{{ route('save-medical-history') }}"
                aria-label="{{ __('Create Medical History') }}">
                @csrf
                <input type="hidden" name="patient_id" value="{{ $data['patientAccount']['id'] }}">

                <div class="form-group row">
                    <label for="complains" class="col-md-4 col-form-label text-md-right">{{ __('Complains') }}</label>

                    <div class="col-md-6">
                        <small>*Note: Provide a detailed explanation of patient complains and symptoms</small>
                        <textarea name="complains" class="form-control" id="" cols="15" rows="5" required></textarea>

                        @if ($errors->has('complains'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('complains') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="diagnosis" class="col-md-4 col-form-label text-md-right">{{ __('Diagnosis') }}</label>

                    <div class="col-md-6">
                        <small>*Note: Provide a detailed diagnosis and findings</small>
                        <textarea name="diagnosis" class="form-control" id="" cols="15" rows="5" required></textarea>

                        @if ($errors->has('diagnosis'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('diagnosis') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="treatment" class="col-md-4 col-form-label text-md-right">{{ __('Treatment') }}</label>

                    <div class="col-md-6">
                        <small>*Note: Provide a detailed treatment procedures, schedule of medication etc.</small>
                        <textarea name="treatment" class="form-control" id="" cols="15" rows="5" required></textarea>

                        @if ($errors->has('treatment'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('treatment') }}</strong>
                            </span>
                        @endif
                    </div>

                </div>

                @php
                    $today = \Carbon\Carbon::today()->format('Y-m-d');
                @endphp

                <div class="form-group row">
                    <label for="last_visit" class="col-md-4 col-form-label text-md-right">{{ __('Date of Visit') }}</label>

                    <div class="col-md-6">
                        <input id="last_visit" name="last_visit"
                            class="form-control{{ $errors->has('last_visit') ? ' is-invalid' : '' }}" type="date"
                            value="{{ $today }}" max="{{ $today }}" required readonly>
                    </div>

                    @if ($errors->has('last_visit'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('last_visit') }}</strong>
                        </span>
                    @endif
                </div>

                {{-- <div class="form-group row">
                    <label for="next_visit"
                        class="col-md-4 col-form-label text-md-right">{{ __('Date of Next Visit') }}</label>

                    <div class="col-md-6">
                        @php
                            $tomorrow = \Carbon\Carbon::tomorrow()->format('Y-m-d');
                        @endphp

                        <input id="next_visit" name="next_visit"
                            class="form-control{{ $errors->has('next_visit') ? ' is-invalid' : '' }}" type="date"
                            min="{{ $tomorrow }}" value="{{ $tomorrow }}" required>

                    </div>

                    @if ($errors->has('next_visit'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('next_visit') }}</strong>
                        </span>
                    @endif

                </div> --}}

                {{-- Date --}}
                <div class="form-group row">
                    <label for="date_display" class="col-md-4 col-form-label text-md-right">Select Date:</label>
                    <div class="col-md-6">
                        <input type="text" id="date_display" class="form-control" placeholder="-- Select Date --"
                            readonly>
                        <input type="hidden" id="date" name="date">
                        <small id="slotCount" class="form-text text-muted mt-2 font-weight-bold"></small>
                    </div>
                </div>

                {{-- Time --}}
                <div class="form-group row">
                    <label for="real_time" class="col-md-4 col-form-label text-md-right">Select Time:</label>
                    <div class="col-md-6">
                        <select name="real_time" id="real_time" class="form-control" disabled>
                            <option value="">-- Select Time --</option>
                        </select>
                    </div>
                </div>

                <hr>


                {{-- <div class="form-group row">
                <label for="attending_doctor" class="col-md-4 col-form-label text-md-right">{{ __('Attending Doctor') }}</label>

                <div class="col-md-6">
                    <select name="attending_doctor" class="form-control" id="">
                        <option value="" selected disabled>-- Select Doctor --</option>
                        @foreach ($data['doctors'] as $doctor)
                            <option value="{{ $doctor['id'] }}">{{ $doctor['name'] }}</option>
                        @endforeach
                    </select>
                    
                </div>
            </div> --}}

                <div class="form-group row">
                    <label for="attending_doctor"
                        class="col-md-4 col-form-label text-md-right">{{ __('Attending Doctor') }}</label>

                    <div class="col-md-6">
                        @if (!empty($data['lockedDoctorId']))
                            <!-- Lock the attending doctor when a doctor is logged in -->
                            <input type="hidden" name="attending_doctor" value="{{ $data['lockedDoctorId'] }}">
                            <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                        @else
                            <select name="attending_doctor" class="form-control">
                                <option value="" selected disabled>-- Select Doctor --</option>
                                @foreach ($data['doctors'] as $doctor)
                                    <option value="{{ $doctor['id'] }}">{{ $doctor['name'] }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Medical
                            History</button>
                    </div>
                </div>
            </form>

            {{-- <patients-list :user_data="user_data"></patients-list> --}}
        </div>
    </main>
    @include('layouts.dashboard.footer')
    <script>
        let allowedDays = [];
        let doctorId = '{{ $doctorId ?? Auth::user()->id }}'; // fallback to logged in user

        function weekdayToIndex(day) {
            return {
                'Sunday': 0,
                'Monday': 1,
                'Tuesday': 2,
                'Wednesday': 3,
                'Thursday': 4,
                'Friday': 5,
                'Saturday': 6
            } [day];
        }

        function setupFlatpickr(allowed) {
            const visibleInput = document.getElementById('date_display');
            const hiddenInput = document.getElementById('date');

            const allowedIndexes = allowed.map(weekdayToIndex);

            flatpickr(visibleInput, {
                dateFormat: "Y-m-d",
                minDate: "today",
                disable: [date => !allowedIndexes.includes(date.getDay())],
                onChange: function(selectedDates, dateStr) {
                    hiddenInput.value = dateStr;
                    loadAvailableTimes(doctorId, dateStr);
                }
            });
        }

        function loadAvailableTimes(doctorId, dateStr) {
            fetch(`/doctor-availability/${doctorId}/${dateStr}`)
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
                        slotCount.innerText = `Remaining Slots: ${data.remaining_slots}`;
                        slotCount.classList.remove('text-danger');
                        generateTimeOptions(data.start_time, data.end_time);
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

        // Fetch schedule and setup on load
        document.addEventListener('DOMContentLoaded', () => {
            fetch(`/doctor-schedule/${doctorId}`)
                .then(res => res.json())
                .then(data => {
                    allowedDays = data.map(s => s.day_of_week.charAt(0).toUpperCase() + s.day_of_week.slice(1));
                    setupFlatpickr(allowedDays);
                });
        });
    </script>
    <style scoped>
        input#date_display[readonly] {
            background-color: #ffffff !important;
            color: #000000 !important;
            cursor: pointer;
        }
    </style>
@endsection
