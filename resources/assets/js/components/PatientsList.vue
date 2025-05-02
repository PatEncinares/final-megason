<template>
    <div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Patients List
            </div>
            <div class="card-body">
                <sweet-modal ref="editPatient">Edit patient</sweet-modal>

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th colspan="2">Action</th>
                                <th>Fullname</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th>Attending Doctor</th>
                            </tr>
                        </thead>
                        <tbody v-if="patients_list.length">
                            <tr v-for="(patient,index) in patients_list" :key="index">
                                <td colspan="2">
                                    <button class="btn btn-info" title="Edit" @click="edit(patient)"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-danger" title="Delete" @click="deletePatient(patient)"><i class="fa fa-trash"></i></button>
                                </td>
                                <td>{{ patient.fullname }}</td>
                                <td>{{ patient.gender }}</td>
                                <td>{{ patient.age }}</td>
                                <td>{{ patient.mobile_number }}</td>
                                <td>{{ patient.address }}</td>
                                <td>{{ (patient.doctor) ? patient.doctor.doctor_details.fullname : '- N/A -' }}</td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr>
                                <td colspan="6"><center>No records to show.</center></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Swal from 'sweetalert2'
export default {
    props : ['user_data'],
    data(){
        return {
            patients_list : [],
        }
    },

    mounted(){
        this.getPatientsList();
    },

    methods : {
        getPatientsList : function(){
           var self = this;
            this.$http.get('/getPatientList')
            .then(function (response) {
                // handle success
                self.patients_list = response.data;
                // $('#dataTable').DataTable();
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            });
        },

        edit : function(){
            this.$refs.editPatient.open();
        },

        deletePatient : function(){
            Swal.fire({
              title: 'Are you sure you want to delete this patient?',
              showDenyButton: true,
              showCancelButton: true,
              showConfirmButton: false,
              denyButtonText: 'Delete',
              icon : 'question'
            }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {
                // Swal.fire('Saved!', '', 'success')
              } else if (result.isDenied) {
                Swal.fire('Patient Deleted', '', 'info');
              }
            })
        }

    },

    

}
</script>

<style scoped>

</style>