<template>
    <div style="break-after:page">
        <center><h2>URINALYSIS</h2></center>

        <div class="table-responsive">
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
            <tr>
                <td>
                    <strong>COLOR : </strong> {{ data.color }}
                </td>
                <td>
                    <strong>CHARACTER : </strong> {{ data.character }}
                </td>
                <td>
                    <strong>pH : </strong> {{ data.pH }}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>SPECIFIC GRAVITY : </strong> {{ data.specific_gravity }}
                </td>
                <td>
                    <strong>ALBUMIN : </strong> {{ data.albumin }}
                </td>
                <td>
                    <strong>SUGAR : </strong> {{ data.sugar }}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>BLOOD : </strong> {{ data.blood }}
                </td>
                <td>
                    <strong>BILIRUBIN : </strong> {{ data.bilirubin }}
                </td>
                <td>
                    <strong>KETONE : </strong> {{ data.ketone }}
                </td>
            </tr>
        </table>
        <table class="table table-bordered">
            <tr>
                <td>
                    <strong>CASTS : </strong> {{ data.casts }}
                </td>
                <td>
                    <strong>PUS CELLS : </strong> {{ data.pus_cells }}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>CRYSTALS : </strong> {{ data.crystals }}
                </td>
                <td>
                    <strong>RBC : </strong> {{ data.rbc_count }}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>PREGNANCY TEST : </strong> {{ data.pregnancy_test }}
                </td>
                <td>
                    <strong>E. CELLS : </strong> {{ data.e_cells }}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>METHOD USED : </strong> {{ data.method_used }}
                </td>
                <td>
                    <strong>A. URATES : </strong> {{ data.a_urates }}
                </td>
            </tr>
            <tr>
                <td>
                    
                </td>
                <td>
                    <strong>M. THREADS : </strong> {{ data.m_threads }}
                </td>
            </tr>
            <tr>
                <td>
                    
                </td>
                <td>
                    <strong>OTHERS : </strong> {{ data.others }}
                </td>
            </tr>
            <tr>
                <td>
                    
                </td>
                <td>
                    <strong>REMARKS : </strong> {{ data.remarks }}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>MEDICAL TECHNOLOGIST : </strong> {{ data.medical_technologist }}
                </td>
                <td>
                    <strong>PATHOLOGIST : </strong> {{ data.pathologist }}
                </td>
            </tr>
        </table>
    </div>    
</template>

<script>
export default {
    props : ['data'],
    data(){
        return {

        }
    }
}
</script>

<style scoped>

</style>