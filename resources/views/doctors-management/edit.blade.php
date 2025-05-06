@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/doctor.png') }}" alt="Patient Management">Doctors Management</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Edit Doctor</li>
        </ol>

        <form method="POST" action="{{ route('update-doctor') }}" aria-label="{{ __('Edit Doctor') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $data['doctorsDetail']['id'] }}">
            <input type="hidden" name="user_id" value="{{ $data['doctorsAccount']['id'] }}">

            <div class="form-group row">
                <label for="fullname" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                <div class="col-md-6">
                    <input id="fullname" type="text" class="form-control{{ $errors->has('fullname') ? ' is-invalid' : '' }}" name="fullname" value="{{ $data['doctorsAccount']['name'] }}" required autofocus>

                    @if ($errors->has('fullname'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('fullname') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                <div class="col-md-6">
                    <select name="gender" id="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" required>
                        <option value="" disabled>-- Select gender --</option>
                        <option value="male" {{ $data['doctorsDetail']['gender'] == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $data['doctorsDetail']['gender'] == 'female' ? 'selected' : '' }}>Female</option>
                    </select>

                    @if ($errors->has('gender'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('gender') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            {{-- <div class="form-group row">
                <label for="specialization" class="col-md-4 col-form-label text-md-right">{{ __('Specialization') }}</label>

                <div class="col-md-6">
                    <input id="specialization" type="text" class="form-control{{ $errors->has('specialization') ? ' is-invalid' : '' }}" name="specialization" value="{{ $data['doctorsDetail']['specialization'] }}" required autofocus>

                    @if ($errors->has('specialization'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('specialization') }}</strong>
                        </span>
                    @endif
                </div>
            </div> --}}

            <div class="form-group row">
                <label for="specialization_id" class="col-md-4 col-form-label text-md-right">{{ __('Specialization') }}</label>
            
                <div class="col-md-6">
                    <select id="specialization_id" name="specialization_id" class="form-control select2" required>
                        <option value="" disabled selected>-- Select Specialization --</option>
                        @foreach($data['specialization'] as $spec)
                            <option value="{{ $spec->id }}" {{ $data['doctorsDetail']['specialization_id'] == $spec->id ? 'selected' : '' }}>
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

            <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                <div class="col-md-6">
                    <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ $data['doctorsDetail']['address'] }}" required autofocus>

                    @if ($errors->has('address'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Schedule</label>
                <div class="col-md-6">
                    @php
                        $existingSchedules = $data['doctorsDetail']->schedules->keyBy('day_of_week');
                        $days = ['Monday','Tuesday','Wednesday','Thursday','Friday'];
                    @endphp
            
                    @foreach ($days as $day)
                        @php $sched = isset($existingSchedules[$day]) ? $existingSchedules[$day] : null; @endphp
            
                        <div class="border p-3 mb-3">
                            <div class="form-check mb-2">
                                <input class="form-check-input day-toggle" type="checkbox"
                                       id="enable-{{ $day }}"
                                       name="schedules[{{ $day }}][enabled]"
                                       value="1"
                                       data-day="{{ $day }}"
                                       {{ $sched ? 'checked' : '' }}>
                                <label class="form-check-label font-weight-bold" for="enable-{{ $day }}">{{ $day }} Available</label>
                            </div>
            
                            <div class="form-row">
                                <div class="form-group col">
                                    <label>Start Time</label>
                                    <input type="time"
                                           name="schedules[{{ $day }}][start_time]"
                                           value="{{ $sched->start_time ?? '' }}"
                                           class="form-control schedule-input-{{ $day }}">
                                </div>
                                <div class="form-group col">
                                    <label>End Time</label>
                                    <input type="time"
                                           name="schedules[{{ $day }}][end_time]"
                                           value="{{ $sched->end_time ?? '' }}"
                                           class="form-control schedule-input-{{ $day }}">
                                </div>
                                <div class="form-group col">
                                    <label>Max Patients</label>
                                    <input type="number"
                                           name="schedules[{{ $day }}][max_patients]"
                                           value="{{ $sched->max_patients ?? '' }}"
                                           min="1"
                                           max="100"
                                           class="form-control schedule-input-{{ $day }}">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            


            <div class="form-group row">
                <div class="col-md-6">

                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
            </div>
        </form>

        {{-- <patients-list :user_data="user_data"></patients-list> --}}
    </div>
</main>
@include('layouts.dashboard.footer')
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Enable/disable schedule inputs
        document.querySelectorAll('.day-toggle').forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                const day = this.getAttribute('data-day');
                const inputs = document.querySelectorAll('.schedule-input-' + day);

                inputs.forEach(function (input) {
                    input.disabled = !checkbox.checked;
                });
            });

            // Trigger change on page load
            checkbox.dispatchEvent(new Event('change'));
        });

        // Prefix fullname with Dr./Dra. based on gender
        const genderSelect = document.getElementById('gender');
        const fullnameInput = document.getElementById('fullname');

        genderSelect.addEventListener('change', function () {
            const gender = this.value;
            let name = fullnameInput.value.trim();

            name = name.replace(/^(Dr\.|Dra\.)\s*/i, '');

            const prefix = gender === 'male' ? 'Dr. ' : 'Dra. ';
            fullnameInput.value = prefix + name;
        });

        // Run on load
        genderSelect.dispatchEvent(new Event('change'));

        // Initialize Select2
        $('.select2').select2({
            placeholder: "-- Select Specialization --",
            allowClear: true,
            width: '100%'
        });
    });
</script>
