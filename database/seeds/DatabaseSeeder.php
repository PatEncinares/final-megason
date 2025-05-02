<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SeedUserTypesTable::class);
        $this->call(SeedDefaultUsers::class);
        $this->call(SeedDefaultPermissions::class);
        $this->call(SeedProceduresTable::class);
        $this->call(SeedPatientDetails::class);
        $this->call(SeedDoctorDetails::class);
        $this->call(SeedAppointmentsTable::class);
        $this->call(SeedSettingsTable::class);
        $this->call(SeedTransaction::class);
        $this->call(SeedProcedureTransaction::class);
        $this->call(SeedEmployeesTable::class);
        $this->call(SeedAttendanceTable::class);
    }
}
