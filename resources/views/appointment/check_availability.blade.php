@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/appointment.JPG') }}" alt="Patient Management">Appointment Management</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Check Availability</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Check Availability
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('check-availability') }}" aria-label="{{ __('Check Availability') }}">
                    @csrf
                    {{-- {{ dd($data['doctors']) }} --}}
                    <div class="form-group row">
                        <label for="doctor" class="col-md-4 col-form-label text-md-right">{{ __('Select Doctor:') }}</label>
        
                        <div class="col-md-6">
                            <select name="doctor_id" id="doctor" class="form-control{{ $errors->has('doctor') ? ' is-invalid' : '' }}" required>
                                <option value="" selected disabled>-- Select Doctor --</option>
                                @foreach($data['doctors'] as $doctor)
                                    <option value="{{ $doctor['id'] }}">{{ $doctor['doctorDetails']['fullname'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="period" class="col-md-4 col-form-label text-md-right">{{ __('Period:') }}</label>
        
                        <div class="col-md-6">
                            <select name="period" id="period" class="form-control{{ $errors->has('period') ? ' is-invalid' : '' }}" required>
                                <option value="" selected disabled>-- Select Period --</option>
                                <option value="AM">Morning</option>
                                <option value="PM">Afternoon</option>
                            </select>
                        </div>
                    </div>
        
                    <div class="form-group row">
                        <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Select Date') }}</label>
                        <div class="col-md-6">
                          <input id="date" onchange='no_weekends(this.value)' min='{{date("Y-m-d")}}' onkeydown="return false;"  name="date" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" type="date" value="{{ old('date') }}">
                        </div>
                        <!-- <div class="col-md-6">
                          <input id="date" name="date" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" type="date" value="">
                        </div> -->
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Check Availability</button>
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
