<?php

namespace app\Traits;
use Jenssegers\Date\Date;

trait DatesTranslator{

    public function getCreatedAtAttribute($created_at){
        return new Date($created_at);
    }

    public function getUpdatedAtAttribute($updated_at){
        return new Date($updated_at);
    }
}