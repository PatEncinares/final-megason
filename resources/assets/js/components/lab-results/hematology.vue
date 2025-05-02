<template>
    <div style="break-after:page">
        <center><h2>HEMATOLOGY</h2></center>

        <!-- <div class="table-responsive" v-if="data.isViewPatientMedicalHistory">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Sex</th>
                        <th>Civil Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ data.patient.name }}</td>
                        <td>{{ data.patient.patient_details[0].age }}</td>
                        <td>{{ data.patient.patient_details[0].gender }}</td>
                        <td>{{ data.patient.patient_details[0].civil_status }}</td>
                    </tr>
                </tbody>
            </table>
        </div> -->

        <div class="table-responsive" v-if="!data.isViewPatientMedicalHistory">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Sex</th>
                        <th>Civil Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ data.patient.name }}</td>
                        <td>{{ data.patient.patient_details[0].age }}</td>
                        <td>{{ data.patient.patient_details[0].gender }}</td>
                        <td>{{ data.patient.patient_details[0].civil_status }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

       

        <table class="table table-bordered">
            <thead>
                <th><center>EXAMINATION</center></th>
                <th><center>RESULT</center></th>
                <th><center>REFERENCE VALUE</center></th>
                <th><center>DIFF. COUNT</center></th>
                <th><center>RESULT</center></th>
                <th><center>REF. VAL.</center></th>
            </thead>
            <tbody>
                <tr>
                    <th>
                        HEMOGLOBIN (HGB)
                    </th>
                    <td>
                        {{ data.hemoglobin }}
                    </td>
                    <td>
                        <small>(M) 130 - 180</small> <br>
                        <small>(F) 120 - 160 gm/l</small>
                    </td>
                    <th>
                        NEUTROPHILS
                    </th>
                    <td>
                        {{ data.neutrophils}}
                    </td>
                    <td>
                        <p>0.51 - 0.67</p>
                    </td>
                </tr>
                <tr>
                    <th>
                        HEMATOCRIT (HCT)
                    </th>
                    <td>
                        {{ data.hematocrit }}
                    </td>
                    <td>
                        <small>(M) 0.40 - 0.54</small> <br>
                        <small>(F) 0.37 - 0.47</small>
                    </td>
                    <th>
                        LYMPHOCYTES
                    </th>
                    <td>
                        {{ data.lymphocytes }}
                    </td>
                    <td>
                        <p>0.21 - 0.35</p>
                    </td>
                </tr>
                <tr>
                    <th>
                        WBC Count
                    </th>
                    <td>
                        {{ data.wbc_count }}
                    </td>
                    <td>
                        <p>5-10 X 10<sup>9</sup>/L</p>
                    </td>
                    <th>
                        MONOCYTES
                    </th>
                    <td>
                        {{ data.monocytes }}
                    </td>
                    <td>
                        <p>0.02 - 0.08</p>
                    </td>
                </tr>
                <tr>
                    <th>
                        RBC Count
                    </th>
                    <td>
                        {{ data.rbc_count }}
                    </td>
                    <td>
                        <small>(M) 4.5 - 6.0</small> <br>
                        <small>(F) 4.0-5.5 X 10<sup>12</sup>/L</small>
                    </td>
                    <th>
                        EOSINOPHILS
                    </th>
                    <td>
                        {{ data.eosinophils }}
                    </td>
                    <td>
                        <p>0.01 - 0.04</p>
                    </td>
                </tr>
                <tr>
                    <th>
                        PLATELET Count
                    </th>
                    <td>
                        {{ data.platelet_count }}
                    </td>
                    <td>
                        <p>150-400 X 10<sup>9</sup>/L</p>
                    </td>
                    <th>
                        STAB CELLS
                    </th>
                    <td>
                        {{ data.stab_cells }}
                    </td>
                    <td>
                        <p>0.02 - 0.05</p>
                    </td>
                </tr>
                <tr>
                    <th>
                        RETICULOCYTE Count
                    </th>
                    <td>
                        {{ data.reticulocyte_count }}
                    </td>
                    <td>
                        <p>1-15 X 10<sup>3</sup></p>
                    </td>
                    <th>
                        BASOPHILS
                    </th>
                    <td>
                        {{ data.basophils }}
                    </td>
                    <td>
                        <p>0.0 - 0.01</p>
                    </td>
                    </tr>
                <tr>
                    <th>
                        ERYTHOCYTES SEDIMENTATION RATE (ESR)
                    </th>
                    <td>
                        {{ data.erythocytes_sedimentation_rate }}
                    </td>
                    <td>
                        <small>(M) 0-15 mm/hr</small> <br>
                        <small>(F) 0-20 mm/hr</small>
                    </td>
                    <th>
                        ABO GRP.
                    </th>
                    <td>
                        {{ data.abo_grp }}
                    </td>
                    <td>
                        
                    </td>
                </tr>
                <tr>
                    <th>
                        BLEEDING TIME (BT)
                    </th>
                    <td>
                        {{ data.bleeding_time }}
                    </td>
                    <td>
                        <p>2-4 MINS.</p>
                    </td>
                    <td colspan="2">
                        <strong>OTHERS:</strong>
                        {{ data.others }}
                    </td>
                    <td>
                        <strong>RH Type</strong>
                        {{ data.rh_type }}
                    </td>
                </tr>
                <tr>
                    <th>
                        CLOTTING TIME (CT)
                    </th>
                    <td>
                        {{ data.clotting_time }}
                    </td>
                    <td>
                        <p>2-4 MINS.</p>
                    </td>
                    <th colspan="3">
                        
                    </th>
                </tr>
                <tr>
                    <td colspan="3" rowspan="2">
                        <strong>REMARKS:</strong>
                        {{ data.remarks }}
                    </td>
                    <td colspan="3">
                        <strong>MEDICAL TECHNOLOGIST:</strong>
                        {{ data.medical_technologist }}
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <strong>PATHOLOGIST:</strong>
                        {{ data.pathologist }}
                    </td>
                </tr>   
            </tbody>
        </table>     
    </div>
</template>

<script>
export default {
    props : ['data'],
    data(){
        return {

        }
    },

    mounted() {
        console.log(this.data);
    }
}
</script>

<style scoped>

</style>