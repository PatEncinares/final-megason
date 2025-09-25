@extends('layouts.dashboard.main')

@section('content')
@php
  // Format HH:MM for any stored time
  $fmt = function ($t) { return $t ? \Carbon\Carbon::parse($t)->format('H:i') : ''; };

  // Start options: 09:00–16:00
  $startOptions = [
    '09:00' => '9:00 AM',
    '10:00' => '10:00 AM',
    '11:00' => '11:00 AM',
    '12:00' => '12:00 PM',
    '13:00' => '1:00 PM',
    '14:00' => '2:00 PM',
    '15:00' => '3:00 PM',
    '16:00' => '4:00 PM',
  ];

  // End options: 10:00–17:00 (never 09:00)
  $endOptions = [
    '10:00' => '10:00 AM',
    '11:00' => '11:00 AM',
    '12:00' => '12:00 PM',
    '13:00' => '1:00 PM',
    '14:00' => '2:00 PM',
    '15:00' => '3:00 PM',
    '16:00' => '4:00 PM',
    '17:00' => '5:00 PM',
  ];

  // Compute display name with Dr./Dra. on the edit form
  $storedName  = $data['doctorsAccount']['name'] ?? '';
  $baseName    = preg_replace('/^(?:Dra\.?|Dr\.?)\s*/i', '', trim($storedName)); // strip any prefix to avoid duplicates
  $genderVal   = old('gender', $data['doctorsDetail']['gender'] ?? '');
  $prefix      = $genderVal === 'male' ? 'Dr. ' : ($genderVal === 'female' ? 'Dra. ' : '');
  $displayName = old('fullname', $prefix . $baseName); // keep old() if validation failed
@endphp

<main>
  <div class="container-fluid" id="app">
    <h1 class="mt-4">
      <img class="card-img-top img-thumbnail" style="height: 60px; width: 60px"
           src="{{ asset('assets/quick_links/doctor.png') }}" alt="Patient Management">
      Doctors Management
    </h1>

    <a href="{{ url()->previous() }}" class="btn btn-secondary d-print-none mb-2">
      <i class="fa fa-arrow-left"></i> Back
    </a>

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
          <input id="fullname" type="text"
                 class="form-control{{ $errors->has('fullname') ? ' is-invalid' : '' }}"
                 name="fullname"
                 value="{{ $displayName }}" required autofocus>
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
          <select name="gender" id="gender"
                  class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" required>
            <option value="" disabled>-- Select gender --</option>
            <option value="male"   {{ old('gender', $data['doctorsDetail']['gender']) == 'male'   ? 'selected' : '' }}>Male</option>
            <option value="female" {{ old('gender', $data['doctorsDetail']['gender']) == 'female' ? 'selected' : '' }}>Female</option>
          </select>
          @if ($errors->has('gender'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('gender') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <div class="form-group row">
        <label for="specialization_id" class="col-md-4 col-form-label text-md-right">{{ __('Specialization') }}</label>
        <div class="col-md-6">
          <select id="specialization_id" name="specialization_id" class="form-control select2" required>
            <option value="" disabled {{ old('specialization_id') ? '' : 'selected' }}>-- Select Specialization --</option>
            @foreach($data['specialization'] as $spec)
              <option value="{{ $spec->id }}"
                {{ (string)old('specialization_id', $data['doctorsDetail']['specialization_id']) === (string)$spec->id ? 'selected' : '' }}>
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
          <input id="address" type="text"
                 class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                 name="address" value="{{ old('address', $data['doctorsDetail']['address']) }}" required>
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
            @php
              $sched   = isset($existingSchedules[$day]) ? $existingSchedules[$day] : null;
              $oldStart= old("schedules.$day.start_time", $fmt(optional($sched)->start_time));
              $oldEnd  = old("schedules.$day.end_time",   $fmt(optional($sched)->end_time));
              $oldMax  = old("schedules.$day.max_patients", $sched ? $sched->max_patients : '');
              $enabled = old("schedules.$day.enabled", $sched ? '1' : null);
            @endphp

            <div class="border p-3 mb-3">
              <div class="d-flex align-items-center justify-content-between mb-2">
                <div class="form-check m-0">
                  <input class="form-check-input day-toggle" type="checkbox"
                         id="enable-{{ $day }}"
                         name="schedules[{{ $day }}][enabled]"
                         value="1"
                         data-day="{{ $day }}"
                         {{ $enabled ? 'checked' : '' }}>
                  <label class="form-check-label font-weight-bold" for="enable-{{ $day }}">
                    {{ $day }} Available
                  </label>
                </div>
                <button type="button"
                        class="btn btn-sm btn-outline-secondary clear-day"
                        data-day="{{ $day }}">
                  Clear Day
                </button>
              </div>

              <div class="form-row">
                <div class="form-group col">
                  <label>Start Time</label>
                  <select name="schedules[{{ $day }}][start_time]"
                          class="form-control schedule-input-{{ $day }} schedule-start"
                          data-day="{{ $day }}">
                    <option value="" disabled {{ $oldStart ? '' : 'selected' }}>-- Select --</option>
                    @foreach($startOptions as $val => $label)
                      <option value="{{ $val }}" {{ $oldStart === $val ? 'selected' : '' }}>
                        {{ $label }}
                      </option>
                    @endforeach
                  </select>
                  @if ($errors->has("schedules.$day.start_time"))
                    <small class="text-danger">{{ $errors->first("schedules.$day.start_time") }}</small>
                  @endif
                </div>

                <div class="form-group col">
                  <label>End Time</label>
                  <select name="schedules[{{ $day }}][end_time]"
                          class="form-control schedule-input-{{ $day }} schedule-end"
                          data-day="{{ $day }}">
                    <option value="" disabled {{ $oldEnd ? '' : 'selected' }}>-- Select --</option>
                    @foreach($endOptions as $val => $label)
                      <option value="{{ $val }}" {{ $oldEnd === $val ? 'selected' : '' }}>
                        {{ $label }}
                      </option>
                    @endforeach
                  </select>
                  @if ($errors->has("schedules.$day.end_time"))
                    <small class="text-danger">{{ $errors->first("schedules.$day.end_time") }}</small>
                  @endif
                </div>

                <div class="form-group col">
                  <label>Max Patients</label>
                  <input type="number"
                         name="schedules[{{ $day }}][max_patients]"
                         value="{{ $oldMax }}"
                         min="1" max="100"
                         class="form-control schedule-input-{{ $day }}">
                  @if ($errors->has("schedules.$day.max_patients"))
                    <small class="text-danger">{{ $errors->first("schedules.$day.max_patients") }}</small>
                  @endif
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      <div class="form-group row">
        <div class="col-md-6"></div>
        <button type="submit" class="btn btn-primary">
          <i class="fa fa-save"></i> Save Changes
        </button>
      </div>
    </form>
  </div>
</main>
@include('layouts.dashboard.footer')
@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {
  // Enable/disable schedule inputs per day
  document.querySelectorAll('.day-toggle').forEach(function (checkbox) {
    var day = checkbox.getAttribute('data-day');
    var inputs = document.querySelectorAll('.schedule-input-' + day);
    function sync() { inputs.forEach(function(input){ input.disabled = !checkbox.checked; }); }
    checkbox.addEventListener('change', sync);
    sync(); // initial
  });

  // Clear Day handler: uncheck, clear values, disable inputs
  document.querySelectorAll('.clear-day').forEach(function(btn){
    btn.addEventListener('click', function(){
      var day = btn.getAttribute('data-day');
      var toggle = document.getElementById('enable-' + day);
      var inputs = document.querySelectorAll('.schedule-input-' + day);
      if (toggle) toggle.checked = false;
      inputs.forEach(function(el){
        if (el.tagName === 'SELECT' || el.type === 'number') el.value = '';
        el.disabled = true;
      });
    });
  });

  // Initialize Select2 safely (if present on page)
  if (window.$ && $.fn && $.fn.select2) {
    $('.select2').select2({ placeholder: "-- Select Specialization --", allowClear: true, width: '100%' });
  }

  // Keep end_time strictly after start_time (auto-bump to next option)
  function syncStartEnd(day) {
    var start = document.querySelector('select[name="schedules['+day+'][start_time]"]');
    var end   = document.querySelector('select[name="schedules['+day+'][end_time]"]');
    if (!start || !end || !start.value || !end.value) return;
    if (end.value <= start.value) {
      var bumped = false;
      for (var i = 0; i < end.options.length; i++) {
        var opt = end.options[i];
        if (opt.value && opt.value > start.value) { end.value = opt.value; bumped = true; break; }
      }
      if (!bumped) end.value = '17:00';
    }
  }
  document.querySelectorAll('.schedule-start, .schedule-end').forEach(function (el) {
    el.addEventListener('change', function () { syncStartEnd(el.getAttribute('data-day')); });
  });

  // Prefix fullname with Dr./Dra. based on gender; keep prefix visible on edit
  var genderSelect = document.getElementById('gender');
  var fullnameInput = document.getElementById('fullname');
  function applyPrefix() {
    var gender = genderSelect.value;
    var name = (fullnameInput.value || '').trim();
    // strip any existing Dr./Dra. to avoid duplicates
    name = name.replace(/^(Dr\.|Dra\.)\s*/i, '');
    var prefix = (gender === 'male') ? 'Dr. ' : ((gender === 'female') ? 'Dra. ' : '');
    fullnameInput.value = prefix + name;
  }
  genderSelect.addEventListener('change', applyPrefix);
});
</script>
