@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4 d-flex justify-content-between align-items-center">
            <span>Welcome, {{ $data['user'][0]->name }}</span>
            <span id="live-datetime" class="live-clock text-right"></span>
        </h1>

        <ol class="breadcrumb mb-4"><li class="breadcrumb-item active">Dashboard</li></ol>
             

        {{-- Stats Cards --}}
        <div class="row">
            {{-- @if(in_array("appointments", $data['permissions'])) --}}

                @if(Auth::user()->type == 1 || Auth::user()->type == 2 || Auth::user()->type == 4 || Auth::user()->type == 8)
                    <div class="col-md-3 mb-4">
                        <a href="{{ route('appointment') }}" class="text-decoration-none">
                            <div class="card bg-primary text-white shadow hover-lift">
                                <div class="card-body">All Appointments</div>
                                <div class="card-footer h3" id="stat-all">...</div>
                            </div>
                        </a>
                    </div>
                @endif
                @if(Auth::user()->type == 1 || Auth::user()->type == 2 || Auth::user()->type == 4 || Auth::user()->type == 8)
                    <div class="col-md-3 mb-4">
                        <a href="{{ route('appointment') }}" class="text-decoration-none">
                            <div class="card bg-success text-white shadow hover-lift">
                                <div class="card-body">Today</div>
                                <div class="card-footer h3" id="stat-today">...</div>
                            </div>
                        </a>
                    </div>
                @endif

                @if(Auth::user()->type == 1 || Auth::user()->type == 2 || Auth::user()->type == 4 || Auth::user()->type == 8)
                    <div class="col-md-3 mb-4">
                        <a href="{{ route('appointment') }}" class="text-decoration-none">
                            <div class="card bg-info text-white shadow hover-lift">
                                <div class="card-body">New</div>
                                <div class="card-footer h3" id="stat-new">...</div>
                            </div>
                        </a>
                    </div>
                @endif

                @if(Auth::user()->type == 1 || Auth::user()->type == 2 || Auth::user()->type == 4 || Auth::user()->type == 8)
                    <div class="col-md-3 mb-4">
                        <a href="{{ route('appointment') }}" class="text-decoration-none">
                            <div class="card bg-danger text-white shadow hover-lift">
                                <div class="card-body">Cancelled</div>
                                <div class="card-footer h3" id="stat-cancelled">...</div>
                            </div>
                        </a>
                    </div>
                @endif
              
               
               
            {{-- @endif --}}
        </div>

        {{-- Additional Stats --}}
        
        <div class="row">
            @if(Auth::user()->type == 1 ||  Auth::user()->type == 8)
            <div class="col-md-6 mb-4">
                <a href="{{ route('patients-list') }}" class="text-decoration-none">
                    <div class="card bg-secondary text-white shadow hover-lift">
                        <div class="card-body">Total Patients</div>
                        <div class="card-footer h3" id="stat-patients">...</div>
                    </div>
                </a>
            </div>
             @endif

             @if(Auth::user()->type == 1)
            <div class="col-md-6 mb-4">
                <a href="{{ route('user-list') }}" class="text-decoration-none">
                    <div class="card bg-dark text-white shadow hover-lift">
                        <div class="card-body">Total Staff</div>
                        <div class="card-footer h3" id="stat-staff">...</div>
                    </div>
                </a>
            </div>
            @endif
        </div>
        

        {{-- Charts --}}
        @if(Auth::user()->type == 1 || Auth::user()->type == 2 || Auth::user()->type == 4 || Auth::user()->type == 8)
            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow mb-4 hover-lift">
                        <div class="card-header">Appointments Overview</div>
                        <div class="card-body">
                            <canvas id="appointmentsChart" height="150"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow mb-4 hover-lift">
                        <div class="card-header">Appointments Booked</div>
                        <div class="card-body">
                            <canvas id="donutChart" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        @endif
       
        @if(Auth::user()->type == 1 || Auth::user()->type == 6 || Auth::user()->type == 7)
           {{-- Sales Chart --}}
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card shadow mb-4 hover-lift">
                    <div class="card-header">Sales Overview</div>
                    <div class="card-body">
                        <canvas id="salesChart" height="120"></canvas>
                    </div>
                </div>
            </div>
        </div>
        @endif
     
        

     {{-- Upcoming Appointments --}}
     @if(Auth::user()->type == 1 || Auth::user()->type == 2 || Auth::user()->type == 4 || Auth::user()->type == 8)
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow hover-lift">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Upcoming Appointments</span>
                        <a href="{{ route('appointment') }}" class="btn btn-sm btn-primary">View All</a>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Patient</th>
                                    <th>Doctor</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody id="upcoming-appointments">
                                <tr><td colspan="4" class="text-center">Loading...</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
     @endif
        

     @if(Auth::user()->type == 1)
        <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card shadow hover-lift">
                        <div class="card-header">System Logs</div>
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush" id="system-logs">
                                <li class="list-group-item text-center">Loading...</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     @endif
        {{-- System Logs --}}
       
</main>

{{-- Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    fetch('/home_dashboard')
        .then(res => res.json())
        .then(data => {
            // Safely set innerText only if element exists
            const setStat = (id, value) => {
                const el = document.getElementById(id);
                if (el) el.innerText = value;
            };

            setStat('stat-all', data.stats.all);
            setStat('stat-today', data.stats.today);
            setStat('stat-new', data.stats.new);
            setStat('stat-cancelled', data.stats.cancelled);
            setStat('stat-patients', data.stats.patients);
            setStat('stat-staff', data.stats.staff);

            // Appointments Line Chart
            const appointmentsChart = document.getElementById("appointmentsChart");
            if (appointmentsChart && data.chart) {
                new Chart(appointmentsChart, {
                    type: 'line',
                    data: {
                        labels: data.chart.labels,
                        datasets: data.chart.datasets
                    },
                    options: { responsive: true }
                });
            }

            // Donut Chart
            const donutChart = document.getElementById("donutChart");
            if (donutChart && data.breakdown) {
                new Chart(donutChart, {
                    type: 'doughnut',
                    data: {
                        labels: data.breakdown.labels,
                        datasets: [{
                            data: data.breakdown.values,
                            backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545']
                        }]
                    },
                    options: {
                        responsive: true,
                        cutout: '70%',
                        plugins: {
                            legend: { position: 'bottom' }
                        }
                    }
                });
            }

            // Sales Bar Chart
            const salesChart = document.getElementById("salesChart");
            if (salesChart) {
                new Chart(salesChart, {
                    type: 'bar',
                    data: {
                        labels: ['Today', 'This Week', 'This Month', 'This Year'],
                        datasets: [{
                            label: '₱ Sales',
                            data: data.sales,
                            backgroundColor: ['#17a2b8', '#6f42c1', '#ffc107', '#28a745']
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: { legend: { display: false } },
                        scales: { y: { beginAtZero: true } }
                    }
                });
            }

            // Upcoming Appointments Table
            const upcomingBody = document.getElementById('upcoming-appointments');
            if (upcomingBody) {
                upcomingBody.innerHTML = '';
                if (data.upcoming_appointments && data.upcoming_appointments.length) {
                    data.upcoming_appointments.forEach(app => {
                        upcomingBody.innerHTML += `
                            <tr>
                                <td>${app.name}</td>
                                <td>${app.doctor}</td>
                                <td>${app.date}</td>
                                <td>${app.time}</td>
                            </tr>
                        `;
                    });
                } else {
                    upcomingBody.innerHTML = `<tr><td colspan="4" class="text-center">No upcoming appointments.</td></tr>`;
                }
            }

            // System Logs
            const logsList = document.getElementById('system-logs');
            if (logsList) {
                logsList.innerHTML = '';
                if (data.system_logs && data.system_logs.length) {
                    data.system_logs.forEach(log => {
                        logsList.innerHTML += `
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><strong>${log.user}</strong> - ${log.activity}</span>
                                <span class="text-muted small">${log.created_at}</span>
                            </li>
                        `;
                    });
                } else {
                    logsList.innerHTML = `<li class="list-group-item text-center">No system logs available.</li>`;
                }
            }
        })
        .catch(err => {
            console.error('Dashboard fetch error:', err);
        });
});

function updateLiveTime() {
    const now = new Date();
    const options = { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' };
    const date = now.toLocaleDateString(undefined, options);
    const time = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });
    const el = document.getElementById('live-datetime');
    if (el) el.textContent = `${date} ${time}`;
}

setInterval(updateLiveTime, 1000);
updateLiveTime(); // run once immediately
</script>


{{-- Hover Animation Style --}}
<style>
.hover-lift {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}
.live-clock {
    font-size: 1.2rem;
    font-weight: 500;
    color: #6c757d;
    line-height: 1.2;
}

@media (min-width: 768px) {
    .live-clock {
        font-size: 1.4rem;
    }
}
</style>
@endsection
