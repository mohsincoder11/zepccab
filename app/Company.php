<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'company_name', 
        'contact_number', 
        'alternate_contact_no',
        'email',
        'person_name',
        'designation',
        'person_number',
        'package_ids',
    ];

    protected $casts = [
        'package_ids' => 'array',
    ];
    
    public function getpackagesAttribute()
    {
        return implode(',',PackageMaster::whereIn('id',$this->package_ids)->pluck('package_title')->toArray());
    }
    
}
 