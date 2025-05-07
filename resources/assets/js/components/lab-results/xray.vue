<template>
    <div style="break-after:page">
        <center><h2>XRAY</h2></center>

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
                        <td>{{ capitalize(data.patient.patient_details[0].gender) }}</td>
                        <td>{{ capitalize(data.patient.patient_details[0].civil_status) }}</td>
                    </tr>
                </tbody>
            </table>

            
            <span v-if="data.attachments" class="d-print-none">
                <h5 class="d-print-none">Attachments:</h5>            
                <span v-for="(attachment, index) in data.attachments" :key="index">
                    <span  v-if="attachment.attachment_ext == 'jpg' || attachment.attachment_ext == 'png'" >
                        <a :href="'/lab-result/attachment/download/' + attachment.id "><img :src="'/storage' + attachment.attachment_filepath" alt="..." class="img-thumbnail" height="200px" width="200px"></a> <br>
                    </span>

                    <span v-else>
                        <a :href="'/lab-result/attachment/download/' + attachment.id ">{{ attachment.attachment_filename }}</a> <br>
                    </span>                    
                </span>
            </span>
        </div>
        
            <h4>CHEST PA: </h4> <br>
            <p>{{ data.chest_pa }}</p>

            <br><br><br>
            <h4>IMPRESSION:</h4>
            <p>{{ data.impression }}</p>
            <br><br><br>

            
            <div style="float: right">
                <h4 class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ data.radiologist }}</h4>
                ___________________________________________________
                <h4 class="pull-right">&nbsp;&nbsp;RADIOLOGIST/SONOLOGIST</h4>
            </div>
            
            




    </div>
</template>

<script>
export default {
    props : ['data'],
    data(){
        return {

        }
    },
    methods: {
        capitalize(value) {
            if (!value) return '';
            return value.charAt(0).toUpperCase() + value.slice(1).toLowerCase();
        }
    },
}
</script>

<style scoped>

</style>