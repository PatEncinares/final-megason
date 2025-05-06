<nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Home</div>
            <a class="nav-link" href="{{ url('/home') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            {{-- @dd(Auth::user()->type); --}}
            <div class="sb-sidenav-menu-heading">Management </div>
            @if(in_array("profile",$data['permissions']))
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProfile" aria-expanded="false" aria-controls="collapseProfile">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Profile
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseProfile" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        @if(Auth::user()->type == 2)
                            <a class="nav-link" href="{{ route('get-doctor-list') }}">View/Edit Profile</a>
                        @elseif(Auth::user()->type == 3)
                            <a class="nav-link" href="{{ route('patients-list') }}">View/Edit Profile</a>
                        @endif
                    </nav>
                </div>
            @endif

            @if(in_array("patient_management",$data['permissions']))
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePatient" aria-expanded="false" aria-controls="collapsePatient">
                    <div class="sb-nav-link-icon"><i class="fas fa-hospital-user"></i></div>
                    Patient Management
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePatient" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ url('/patients-list') }}">Patients List</a>
                        <a class="nav-link" href="{{ url('/appointments') }}">Appointment Schedule</a>
                    </nav>
                </div>
            @endif

            @if(in_array("appointments",$data['permissions']))
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAppointments" aria-expanded="false" aria-controls="collapseAppointments">
                    <div class="sb-nav-link-icon"><i class="fas fa-calendar"></i></div>
                    Appointments
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseAppointments" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ url('/appointments') }}">Appointments List</a>
                        {{-- <a class="nav-link" href="{{ url('/appointments/check-availability') }}">Check Availability</a> --}}
                    </nav>
                </div>
            @endif

            @if(in_array("doctors_management",$data['permissions']))
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDoctor" aria-expanded="false" aria-controls="collapseDoctor">
                    <div class="sb-nav-link-icon"><i class="fas fa-user-md"></i></div>
                    Doctors Management
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseDoctor" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        @if(Auth::user()->type == 2)
                            <a class="nav-link" href="{{ route('doctors-list') }}">Profile</a>
                        @else
                            <a class="nav-link" href="{{ url('/doctors-list') }}">Doctors List</a>
                            {{-- <a class="nav-link" href="{{ url('/appointments/check-availability') }}">Check Availability</a> --}}
                        @endif
                    </nav>
                </div>
            @endif

            {{-- @if(in_array("transactions",$data['permissions']))
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransactions" aria-expanded="false" aria-controls="collapseTransactions">
                    <div class="sb-nav-link-icon"><i class="fas fa-cash-register"></i></div>
                    Transactions
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseTransactions" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('create-transaction') }}">Create Transaction</a>
                        <a class="nav-link" href="{{ route('get-transactions-list') }}">Transactions List</a>
                    </nav>
                </div>
            @endif --}}

            @if((Auth::user()->type == 7))
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransactions" aria-expanded="false" aria-controls="collapseTransactions">
                    <div class="sb-nav-link-icon"><i class="fas fa-cash-register"></i></div>
                    Transactions
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseTransactions" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('create-transaction') }}">Create Transaction</a>
                        <a class="nav-link" href="{{ route('get-transactions-list') }}">Transactions List</a>
                    </nav>
                </div>
            @endif

            @if(in_array("laboratory_management",$data['permissions']))
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaboratory" aria-expanded="false" aria-controls="collapseLaboratory">
                    <div class="sb-nav-link-icon"><i class="fas fa-microscope"></i></div>
                    Laboratory
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLaboratory" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('lab-results-list') }}">Lab Results</a>
                        <a class="nav-link" href="{{ route('new-lab-result') }}">Create Lab Result</a>
                    </nav>
                </div>
            @endif

            {{-- @if(in_array("hr",$data['permissions']))
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseHr" aria-expanded="false" aria-controls="collapseHr">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    Human Resource
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseHr" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('get-employees-list') }}">Employees</a>
                        <a class="nav-link" href="{{ route('payroll-list') }}">Payroll</a>
                    </nav>
                </div>
            @endif --}}

            @if(in_array("inventory",$data['permissions']))
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInventory" aria-expanded="false" aria-controls="collapseInventory">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Inventory
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseInventory" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('get-category-list') }}">Category List</a>
                        <a class="nav-link" href="{{ route('get-inventory-list') }}">Inventory List</a>
                    </nav>
                </div>
            @endif

            @if(in_array("accounting",$data['permissions']))
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAccounting" aria-expanded="false" aria-controls="collapseAccounting">
                    <div class="sb-nav-link-icon"><i class="fas fa-coins"></i></div>
                    Accounting
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseAccounting" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('financial-report') }}">Financial Report</a>
                        <a class="nav-link" href="{{ route('daily-earnings-report') }}">Daily Earnings Report</a>
                    </nav>
                </div>
            @endif

            @if(in_array("user_accounts",$data['permissions']))
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="false" aria-controls="collapseUsers">
                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                    User Accounts
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseUsers" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('user-list') }}">Users List</a>
                        <a class="nav-link" href="{{ route('get-specialization-list') }}">Specialization</a>
                        <a class="nav-link" href="{{ route('activity-log') }}">Activity Log</a>
                    </nav>
                </div>
            @endif

            
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{ Auth::user()->name }}
    </div>
</nav>