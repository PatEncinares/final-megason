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
                <form method="POST" action="{{ route('save-appointment') }}" aria-label="{{ __('Create Appointment') }}">
                    @csrf
                    {{-- {{ dd($data['doctors']) }} --}}
                    @if(Auth::user()->type != 3)
                    <div class="form-group row">
                        <label for="patient" class="col-md-4 col-form-label text-md-right">{{ __('Select Patient:') }}</label>
        
                        <div class="col-md-6">
                            <select name="patient_id" id="patient" class="form-control{{ $errors->has('patient') ? ' is-invalid' : '' }}" required>
                                <option value="" selected disabled>-- Select patient --</option>
                                @foreach($data['patients'] as $patient)
                                    <option {{ old("patient_id") == $patient['id'] ? "selected" : "" }} value="{{ $patient['id'] }}">{{ $patient['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @else
                        <input type="hidden"  name="patient_id" value="{{ Auth::user()->id }}">
                    @endif
                    @if(Auth::user()->type != 2)
                        <div class="form-group row">
                            <label for="doctor" class="col-md-4 col-form-label text-md-right">{{ __('Select Doctor:') }}</label>
            
                            <div class="col-md-6">
                                <select name="doctor_id" id="doctor" class="form-control{{ $errors->has('doctor') ? ' is-invalid' : '' }}" required>
                                    <option value="" selected disabled>-- Select Doctor --</option>
                                    @foreach($data['doctors'] as $doctor)
                                        <option  {{ old("doctor_id") == $doctor['id'] ? "selected" : "" }} value="{{ $doctor['id'] }}">{{ $doctor['doctorDetails']['specialization'] }} - {{ $doctor['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @else
                        <input type="hidden"  name="doctor_id" value="{{ Auth::user()->id }}">
                    @endif
        
                    <div class="form-group row">
                        <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Select Date') }}</label>
        
                        <div class="col-md-6">
                          <input id="date" onchange='no_weekends(this.value)' min='{{date("Y-m-d")}}' onkeydown="return false;"  name="date" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" type="date" value="{{ old('date') }}">
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="real_time" class="col-md-4 col-form-label text-md-right">{{ __('Select Time:') }}</label>
        
                        <div class="col-md-6">
                            <input type="time" name="real_time" id="real_time" value="{{ old('real_time') }}"  min="09:00" max="17:00" class="form-control" required>
                        </div>
                    </div>

                    <!-- <div class="form-group row">
                        <label for="time" class="col-md-4 col-form-label text-md-right">{{ __('Select Period:') }}</label>
        
                        <div class="col-md-6">
                            <select name="time" id="time" class="form-control{{ $errors->has('time') ? ' is-invalid' : '' }}" required>
                                <option value="" selected disabled>-- Select Period --</option>
                                <option  value="AM">Morning</option>
                                <option value="PM">Afternoon</option>
                            </select>
                        </div>
                    </div> -->

                    <div class="form-group row">
                        <div class="col-md-6">
                            
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-calendar"></i> Set Appointment</button>
                    </div>
        
                </form>
            </div>
        </div>
    </div>
</main>
<script>
    function no_weekends(value)
    {   
        // alert(value);

        var day = new Date(value).getUTCDay();

        if((day == 0) || (day == 6))
        {
            document.getElementById('date').value = "";
            alert('Weekends not allowed');
        }
        
    }
</script>
@include('layouts.dashboard.footer')
@endsection
