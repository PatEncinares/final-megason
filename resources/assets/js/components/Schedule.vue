<template>
  <div class="card mb-4">
    <div class="card-header">
      <i class="fas fa-table mr-1"></i>
      Appointment List
    </div>
    <div class="card-body">
      <div class="form-group">
        <button class="btn btn-info" @click="toggleView" v-if="!calendar_view">
          <i class="fa fa-calendar"></i> Calendar View
        </button>
        <button class="btn btn-info" @click="toggleView" v-else>
          <i class="fa fa-list"></i> List View
        </button>
        <a href="/appointments/create" class="btn btn-info">
          <i class="fa fa-plus"></i> Create Appointment
        </a>
      </div>

      <div class="table-responsive" v-if="!calendar_view">
        <table class="table table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Action</th>
              <th>Patient Name</th>
              <th>Attending Doctor</th>
              <th>Date</th>
              <th>Time</th>
              <th>Period</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody v-if="appointments.length">
            <tr v-for="(appointment, index) in appointments" :key="index">
              <td v-if="appointment.status == 0">
                <span v-if="user_data.type == 3">
                  <a :href="'/appointments/cancel/' + appointment.id">
                    <button class="btn btn-danger"><i class="fa fa-times"></i> Cancel</button>
                  </a>
                </span>
                <span v-else-if="user_data.type == 4 || user_data.type == 1">
                  <a :href="'/appointments/approve/' + appointment.id">
                    <button class="btn btn-info"><i class="fa fa-check"></i> Approve</button>
                  </a>
                  <a :href="'/appointments/cancel/' + appointment.id">
                    <button class="btn btn-danger"><i class="fa fa-times"></i> Cancel</button>
                  </a>
                </span>
              </td>
              <td v-else>
                <button class="btn btn-info" disabled v-if="appointment.status == 1"><i class="fa fa-check"></i> Approved</button>
                <button class="btn btn-danger" disabled v-else-if="appointment.status == 2"><i class="fa fa-times"></i> Canceled</button>
              </td>
              <td>{{ appointment.patient.name }}</td>
              <td>{{ appointment.doctor.name }}</td>
              <td>{{ appointment.date }}</td>
              <td>{{ appointment.real_time }}</td>
              <td>{{ appointment.time }}</td>
              <td :class="{
                    pending: appointment.status === 0,
                    approved: appointment.status === 1,
                    canceled: appointment.status === 2
                  }">
                {{ appointment.status === 0 ? 'Pending' : appointment.status === 1 ? 'Approved' : 'Canceled' }}
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Calendar View -->
      <FullCalendar v-if="calendar_view" :options="calendarOptions" />
    </div>
  </div>
</template>

<script>
import Swal from 'sweetalert2';
import moment from 'moment';
import FullCalendar from '@fullcalendar/vue';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

export default {
  props: ['user_data'],
  components: {
    FullCalendar
  },
  data() {
    return {
      appointments: [],
      calendar_view: false,
      patients_list: {},
      doctors_list: [],
      newScheduleParams: {},
      selectedDate: '',
      selectedAppointments: [],
      calendarOptions: {
      plugins: [dayGridPlugin, interactionPlugin],
      initialView: 'dayGridMonth',
      events: [],
      dateClick: null,
      eventClick: null
    }
    };
  },
  mounted() {
    this.getAppointments();
    this.getPatientsList();
    this.getDoctorsList();
    this.calendarOptions.events = this.getCalendarEvents;
    this.calendarOptions.dateClick = this.onDateClick;
    this.calendarOptions.eventClick = this.onEventClick;
  },
  computed: {
    // calendarOptions() {
    //   return {
    //     plugins: [dayGridPlugin, interactionPlugin],
    //     initialView: 'dayGridMonth',
    //     events: this.getCalendarEvents,
    //     dateClick: this.onDateClick,
    //     eventClick: this.onEventClick
    //   };
    // }
  },
  methods: {
    toggleView() {
      this.calendar_view = !this.calendar_view;
    },
    getAppointments() {
      this.$http.get('/get-appointments')
        .then((response) => {
          this.appointments = response.data;
        })
        .catch((error) => {
          console.error('Error fetching appointments:', error);
        });
    },
    getPatientsList() {
      this.$http.get('/getPatientList')
        .then((response) => {
          const temp = {};
          response.data.forEach(item => {
            temp[item.user_id] = item.user.name;
          });
          this.patients_list = temp;
        })
        .catch(error => console.error(error));
    },
    getDoctorsList() {
      this.$http.get('/getDoctorsList')
        .then((response) => {
          const temp = {};
          response.data.forEach(item => {
            temp[item.user_id] = item.fullname;
          });
          this.doctors_list = temp;
        })
        .catch(error => console.error(error));
    },
    getCalendarEvents(fetchInfo, successCallback, failureCallback) {
      const events = this.appointments.map(app => ({
        title: `${app.patient.name} (${app.time})`,
        date: app.date,
        extendedProps: app
      }));
      successCallback(events);
    },
    onDateClick(info) {
      const dateStr = info.dateStr;
      this.selectedDate = dateStr;
      this.selectedAppointments = this.appointments.filter(app => app.date === dateStr);

      if (this.selectedAppointments.length) {
        const list = this.selectedAppointments.map(a =>
          `<li><strong>${a.real_time}</strong> - ${a.patient.name} with Dr. ${a.doctor.name}</li>`
        ).join('');
        Swal.fire({
          title: `Appointments on ${dateStr}`,
          html: `<ul style="text-align:left">${list}</ul>`,
          width: 600
        });
      } else {
        Swal.fire({
          icon: 'info',
          title: 'No Appointments',
          text: `There are no appointments scheduled on ${dateStr}.`
        });
      }
    },
    onEventClick(info) {
      const app = info.event.extendedProps;
      Swal.fire({
        title: `Appointment Details`,
        html: `
          <p><strong>Patient:</strong> ${app.patient.name}</p>
          <p><strong>Doctor:</strong> ${app.doctor.name}</p>
          <p><strong>Date:</strong> ${app.date}</p>
          <p><strong>Time:</strong> ${app.real_time}</p>
          <p><strong>Status:</strong> ${app.status == 1 ? 'Approved' : app.status == 2 ? 'Canceled' : 'Pending'}</p>
        `
      });
    }
  }
};
</script>

<style>
.pending {
  color: orange;
  font-weight: bold;
}
.approved {
  color: green;
  font-weight: bold;
}
.canceled {
  color: red;
  font-weight: bold;
}
.modal-body {
  max-height: 400px;
  overflow-y: auto;
}
</style>
