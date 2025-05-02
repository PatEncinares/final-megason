<template>
    <div>
        <h2 class=" d-none d-print-block"><center>Megason Diagnostic Clinics</center></h2>
        <center>
            <ul class="d-none d-print-block">
                <strong>
                    <li>XRAY •</li>
                    <li>ULTRASOUND •</li>
                    <li>LABORATORY •</li>
                    <li>ECG •</li>
                    <li>2-D ECHO •</li>
                    <li>MOBILE CLINIC •</li>
                    <li>DRUG TESTING</li>
                </strong>
            </ul>
            <ul class="d-none d-print-block">
                <strong>
                    <li>PRE-EMPLOYMENT / ANNUAL MEDICAL EXAM •</li>
                    <li>HEALTH/MEDICAL CERTIFICATE •</li>
                    <li>EXECUTIVE CHECK-UP</li>
                </strong>
            </ul>
            <ul class="d-none d-print-block">
                <strong>
                    <b>STA. ROSA: </b> Units 2-3 Levant Business Center, 7656 Market Drive near corner Rizal Blvd., Brgy. Tagapo, Sta Rosa, Laguna <br>
                    • Tel Nos : <b>4708-4996 • 7576-3877</b>
                </strong>
            </ul>
        </center>

        <!-- <div class="row" >
            <div class="col-lg-6 col-md-6 col-sm-6  d-none d-print-block">
                <b>MAKATI I: </b> GF Banyan Place Building, 366 JP Rizal St., Brgy. Tejeros, Makati City <br>
                • Tel Nos : <b>8897-4150 • 7502-3051</b> <br>
                <b>MAKATI II: </b> 35 JP Rizal ext. Cor. Kamagong St., Brgy. Comembo, Makati City <br>
                • Tel Nos : <b>8881-5034 • 7239-7537</b> <br>
                <b>MANDALUYONG: </b> GF The Boni Tower, 602 Boni Ave., Mandaluyong City <br>
                • Tel Nos : <b>4708-4996 • 7576-3877</b> <br>
                <b>STA. ROSA: </b> Units 2-3 Levant Business Center, 7656 Market Drive near corner Rizal Blvd., Brgy. Tagapo, Sta Rosa, Laguna <br>
                • Tel Nos : <b>4708-4996 • 7576-3877</b>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6  d-none d-print-block">
                <b>ALABANG: </b> 2<sup>nd</sup> Floor Erlinda Building, 257 Montillano St., Brgy. Alabang, Muntinlupa City <br>
                • Tel Nos : <b>8809-9044 • 7906-4724</b> <br>
                <b>ANTIPOLO: </b> 174B Marcos Highway, Masinag, Brgy. Mayamot, Antipolo City <br>
                • Tel Nos : <b>8646-6779 • 8871-5665</b> <br>
                <b>MARIKINA: </b> Unit 23 Alicante Tower, Marquinton Residences, Toyota Ave., Brgy. Sto Niño, Marikina City <br>
                • Tel Nos : <b>7239-0665 • 8404-9211</b> <br>
                <b>TAYTAY: </b> #1 Mahinhin cor. Kadalagahan Street, Brgy. Dolores, Taytay, Rizal <br>
                • Tel Nos : <b>8475-5269</b>
            </div>
        </div> -->
        
        <div v-if="(data.procedure_id == 1)">
            <fecalysis :data="data"></fecalysis>
        </div>
        <div v-else-if="(data.procedure_id == 2)">
            <hematology :data="data"></hematology>
        </div>
        <div v-else-if="(data.procedure_id == 3)">
            <urinalysis :data="data"></urinalysis>
        </div>
        <div v-else-if="(data.procedure_id == 4)">
            <xray :data="data"></xray>
        </div>
        <div v-else-if="(data.procedure_id == 5)">
            <ultrasound :data="data"></ultrasound>
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
ul li{
    display: inline;
}

</style>