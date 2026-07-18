<?php

namespace App\Traits;


trait ColumnTranslation
{
    public function getNameAttribute()
    {
        if ((app()->getLocale() == 'ar') || ($this['name_en'] == null)) {
            return $this['name_ar'];
        } else {
            return $this['name_en'];
        }
    }

    public function getDescriptionAttribute()
    {
        if ((app()->getLocale() == 'ar') || ($this['description_en'] == null)) {
            return $this['description_ar'];
        } else {
            return $this['description_en'];
        }
    }

    public function getAddressAttribute()
    {
        if ((app()->getLocale() == 'ar') || ($this['address_en'] == null)) {
            return $this['address_ar'];
        } else {
            return $this['address_en'];
        }
    }

    public function getRegressionAttribute()
    {
        if ((app()->getLocale() == 'ar') || ($this['regression_en'] == null)) {
            return $this['regression_ar'];
        } else {
            return $this['regression_en'];
        }
    }

    public function getPolicyAttribute()
    {
        if ((app()->getLocale() == 'ar') || ($this['policy_en'] == null)) {
            return $this['policy_ar'];
        } else {
            return $this['policy_en'];
        }
    }

    public function getQuestionAttribute()
    {
        if ((app()->getLocale() == 'ar') || ($this['question_en'] == null)) {
            return $this['question_ar'];
        } else {
            return $this['question_en'];
        }
    }

    public function getSubjectAttribute()
    {
        if ((app()->getLocale() == 'ar') || ($this['subject_en'] == null)) {
            return $this['subject_ar'];
        } else {
            return $this['subject_en'];
        }
    }

    public function getContentAttribute()
    {
        if ((app()->getLocale() == 'ar') || ($this['content_en'] == null)) {
            return $this['content_ar'];
        } else {
            return $this['content_en'];
        }
    }

    public function getLocationAttribute()
    {
        if ((app()->getLocale() == 'ar') || ($this['location_en'] == null)) {
            return $this['location_ar'];
        } else {
            return $this['location_en'];
        }
    }

    public function getTitleAttribute()
    {
        if ((app()->getLocale() == 'ar') || ($this['title_en'] == null)) {
            return $this['title_ar'];
        } else {
            return $this['title_en'];
        }
    }

    public function getBioAttribute()
    {
        if ((app()->getLocale() == 'ar') || ($this['bio_en'] == null)) {
            return $this['bio_ar'];
        } else {
            return $this['bio_en'];
        }
    }

    public function getAcademicCertificateAttribute()
    {
        if ((app()->getLocale() == 'ar') || ($this['academic_certificate_en'] == null)) {
            return $this['academic_certificate_ar'];
        } else {
            return $this['academic_certificate_en'];
        }
    }

    public function getOrganizerNameAttribute()
    {
        if ((app()->getLocale() == 'ar') || ($this['organizer_name_en'] == null)) {
            return $this['organizer_name_ar'];
        } else {
            return $this['organizer_name_en'];
        }
    }

    public function getJobDescriptionAttribute()
    {
        if ((app()->getLocale() == 'ar') || ($this['job_description_en'] == null)) {
            return $this['job_description_ar'];
        } else {
            return $this['job_description_en'];
        }
    }

    public function getTasksAttribute()
    {
        if ((app()->getLocale() == 'ar') || ($this['tasks_en'] == null)) {
            return $this['tasks_ar'];
        } else {
            return $this['tasks_en'];
        }
    }

    public function getCharacteristicsAttribute()
    {
        if ((app()->getLocale() == 'ar') || ($this['characteristics_en'] == null)) {
            return $this['characteristics_ar'];
        } else {
            return $this['characteristics_en'];
        }
    }

    public function getPowerAttribute()
    {
        if ((app()->getLocale() == 'ar') || ($this['power_en'] == null)) {
            return $this['power_ar'];
        } else {
            return $this['power_en'];
        }
    }

    public function getMembershipConditionsAttribute()
    {
        if ((app()->getLocale() == 'ar') || ($this['membership_conditions_en'] == null)) {
            return $this['membership_conditions_ar'];
        } else {
            return $this['membership_conditions_en'];
        }
    }
}
