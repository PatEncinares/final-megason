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
              <td>
                <button v-if="appointment.status !== 2" @click="confirmCancel(appointment.id)" class="btn btn-danger">
                  <i class="fa fa-times"></i> Cancel
                </button>
                <button v-else disabled class="btn btn-danger">
                  <i class="fa fa-times"></i> Canceled
                </button>
              </td>
              <td>{{ appointment.patient.name }}</td>
              <td>
                {{ appointment.doctor && appointment.doctor.title_name
                  ? appointment.doctor.title_name
                  : 'Doctor is no longer active' }}
              </td>
              <td>{{ appointment.date }}</td>
              <!-- <td>{{ appointment.real_time }}</td> -->
               <td>{{ formatTime(appointment.real_time) }}</td>
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

      <full-calendar default-view="dayGridMonth" :plugins="calendarPlugins" :events="calendarEvents"
        @dateClick="handleDateClick" v-else />

      <div v-if="showModal" class="custom-modal-overlay">
        <transition name="fade-scale">
          <div class="custom-modal-content">
            <div class="modal-header">
              <h5>Schedules for {{ modalDate }}</h5>
              <button class="close" @click="showModal = false">&times;</button>
            </div>
            <div class="modal-body">
              <div v-if="!modalAppointments.length">No appointments found.</div>
              <div v-else>
                <div v-for="(appointments, doctorName) in groupedAppointments" :key="doctorName" class="mb-4">
                  <h5 class="text-primary border-bottom pb-1 mb-2">Doctor: {{ doctorName }}</h5>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Patient</th>
                        <th>Time</th>
                        <th>Period</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(a, i) in appointments" :key="i">
                        <td>{{ a.patient ? a.patient.name : 'Unknown' }}</td>
                        <!-- <td>{{ a.real_time }}</td> -->
                         <td>{{ formatTime(a.real_time) }}</td>
                        <td>{{ a.time }}</td>
                        <td>
                          {{ a.status === 0 ? 'Pending' : a.status === 1 ? 'Approved' : 'Canceled' }}
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </transition>
      </div>


    </div>
  </div>
</template>

<script>
import Swal from 'sweetalert2'
import moment from 'moment';
import FullCalendar from '@fullcalendar/vue';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

export default {
  props: ['user_data'],
  data() {
    return {
      appointments: [],
      calendar_view: false,
      patients_list: {},
      doctors_list: [],
      newScheduleParams: {},
      modalDate: '',
      modalAppointments: [],
      showModal: false,
      calendarPlugins: [dayGridPlugin, interactionPlugin]
    };
  },
  components: {
    FullCalendar
  },
  mounted() {
    this.getAppointments();
    this.getPatientsList();
    this.getDoctorsList();
  },
  methods: {
    getAppointments() {
      this.$http.get('/get-appointments')
        .then(res => { this.appointments = res.data; })
        .catch(err => console.log(err));
    },
    getPatientsList() {
      this.$http.get('/getPatientList')
        .then(res => {
          const temp = {};
          res.data.forEach(p => { temp[p.user_id] = p.user.name; });
          this.patients_list = temp;
        });
    },
    getDoctorsList() {
      this.$http.get('/getDoctorsList')
        .then(res => {
          const temp = {};
          res.data.forEach(d => { temp[d.user_id] = d.fullname; });
          this.doctors_list = temp;
        });
    },
    toggleView() {
      this.calendar_view = !this.calendar_view;
    },
    handleDateClick(info) {
      const selectedDate = info.dateStr;
      const userType = this.user_data.type;

      let filtered = this.appointments.filter(a => a.date === selectedDate);
      if (userType === 2) {
        filtered = filtered.filter(a => a.doctor && a.doctor.user_id == this.user_data.id);
      } else if (userType === 3) {
        filtered = filtered.filter(a => a.patient && a.patient.user_id == this.user_data.id);
      }

      this.modalDate = selectedDate;
      this.modalAppointments = filtered;
      this.showModal = true;
    },
    formatTime(time) {
      return moment(time, 'HH:mm:ss').format('hh:mm A');
    } 
  },
  computed: {
    calendarEvents() {
      const userType = this.user_data.type;
      const userId = this.user_data.id;
      const dates = this.appointments
        .filter(a => {
          if (userType === 2) return a.doctor && a.doctor.user_id == userId;
          if (userType === 3) return a.patient && a.patient.user_id == userId;
          return true;
        })
        .map(a => a.date);

      return [...new Set(dates)].map(date => ({
        title: 'View Schedules',
        date,
        allDay: true,
        className: 'view-schedule-event'
      }));
    },
    groupedAppointments() {
      const grouped = {};
      this.modalAppointments.forEach(a => {
        const doctor = a.doctor ? a.doctor.title_name : 'Inactive Doctor';
        if (!grouped[doctor]) grouped[doctor] = [];
        grouped[doctor].push(a);
      });
      return grouped;
    },
  }
}
</script>

<style scoped>
.custom-modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1050;
}

.custom-modal-content {
  background: white;
  border-radius: 12px;
  padding: 30px;
  max-width: 950px;
  width: 95%;
  max-height: 90vh;
  /* 💡 LIMIT HEIGHT */
  overflow-y: auto;
  /* 💡 ENABLE SCROLL */
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.close {
  background: none;
  border: none;
  font-size: 28px;
  line-height: 1;
  cursor: pointer;
}

.fade-scale-enter-active {
  animation: fadeInScale 0.3s ease-out forwards;
}

.fade-scale-leave-active {
  animation: fadeOutScale 0.2s ease-in forwards;
}

@keyframes fadeInScale {
  0% {
    opacity: 0;
    transform: scale(0.9);
  }

  100% {
    opacity: 1;
    transform: scale(1);
  }
}

@keyframes fadeOutScale {
  0% {
    opacity: 1;
    transform: scale(1);
  }

  100% {
    opacity: 0;
    transform: scale(0.9);
  }
}
</style>
