<?php

namespace App\Traits;


trait ColumnAccessor
{
/*    public function getCreatedAtAttribute($value){
        return custom_date_only($value);
    }

    public function getUpdatedAtAttribute($value){
        return custom_date_only($value);
    }*/

    public function getCreateDateAttribute()
    {
        return custom_date_only($this['created_at']) . ' ' . custom_hour($this['created_at']);

        /*return date('d-m-Y',strtotime($this['created_at']))
            . ' ' . date('h:i A',strtotime($this['created_at']));*/
    }

    public function getUpdateDateAttribute()
    {
        return custom_date_only($this['updated_at']) . ' ' . custom_hour($this['updated_at']);

        /*return date('d-m-Y',strtotime($this['updated_at']))
            . ' ' . date('h:i A',strtotime($this['updated_at']));*/
    }

}
