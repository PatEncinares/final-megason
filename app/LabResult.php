<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\LabResult;
use App\User;
use App\Procedure;
use App\Attachment;

class LabResult extends Model
{
    protected $fillable = ["patient_id","procedure_id","color", "character", "reaction", "occult_blood", "ova_or_parasite", "concentration_technique", "pus_cells", "rbc_count", "macrophage", "fat_globules", "hemoglobin", "hematocrit", "wbc_count", "platelet_count", "reticulocyte_count", "erythocytes_sedimentation_rate", "bleeding_time", "clotting_time", "neutrophils", "lymphocytes", "monocytes", "eosinophils", "stab_cells", "basophils", "abo_grp", "rh_type", "specific_gravity", "almubin", "bilirubin", "pH", "sugar", "ketone", "casts", "crystals", "pregnancy_test", "method_used", "e_cells", "a_urates", "m_threads", "chest_pa", "others", "remarks", "pathologist", "medical_technologist", "radiologist",'impression'];

    public function attachments(){
        return $this->hasMany('App\Attachment');
    }

    public function patient(){
        return $this->belongsTo('App\User');
    }

    public function procedure(){
        return $this->belongsTo('App\Procedure');
    }

}
