<template>
    <div style="break-after:page">
        <div class="row">
            <div class="col-lg-12">
                <center><h2>FECALYSIS</h2></center>

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

                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="2"><u>MICROSCOPIC</u></th>
                            <th colspan="2"><u>CONCENTRATION TECHNIQUE</u></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>COLOR:</th>
                            <td>{{ data.color }}</td>
                            <td colspan="2">{{ data.concentration_technique }}</td>
                        </tr>
                        <tr>
                            <th>CHARACTER:</th>
                            <td>{{ data.character }}</td>
                            <th>OTHERS, SPECIFY:</th>
                            <td>{{ data.others }}</td>
                        </tr>
                        <tr>
                            <th>REACTION:</th>
                            <td>{{ data.reaction }}</td>
                            <th>PUS CELLS:</th>
                            <td>{{ data.pus_cells }} /hpf</td>
                        </tr>
                        <tr>
                            <th>OCCULT BLOOD:</th>
                            <td>{{ data.occult_blood }}</td>
                            <th>RBC:</th>
                            <td>{{ data.rbc_count }}</td>
                        </tr>
                        <tr>
                            <th>OVA OR PARASITE:</th>
                            <td>{{ data.ova_or_parasite }}</td>
                            <th>MACROPHAGE:</th>
                            <td>{{ data.macrophage }} /hpf</td>
                        </tr>
                        <tr>
                            <th>OVA OR PARASITE:</th>
                            <td>{{ data.ova_or_parasite }}</td>
                            <th>MACROPHAGE:</th>
                            <td>{{ data.macrophage }} /hpf</td>
                        </tr>
                        <tr>
                            <th>REMARKS:</th>
                            <td>{{ data.remarks }}</td>
                            <th>FAT GLOBULES:</th>
                            <td>{{ data.fat_globules }}</td>
                        </tr>
                        <tr>
                            <td colspan="4"></td>
                        </tr>
                        <tr>
                            <th>PATHOLOGIST: </th>
                            <td>{{ data.pathologist }}</td>
                            <th>MEDICAL TECHNOLOGIST:</th>
                            <td>{{ data.medical_technologist }}</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props : ['data'],
    data(){
        return{

        }
    }
}
</script>

<style scoped>
h6 {
    display: inline;
}
</style>