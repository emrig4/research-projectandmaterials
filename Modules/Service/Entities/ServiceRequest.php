<?php

namespace Modules\Service\Entities;

use Modules\Base\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceRequest extends Model
{
	use SoftDeletes;
     /**
     * The attributes that should be guarded for arrays.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    // airon - 
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

}
