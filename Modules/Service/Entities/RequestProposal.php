<?php

namespace Modules\Service\Entities;

use Modules\Base\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestProposal extends Model
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
    public function request()
    {
        return $this->belongs(ServiceRequest::class, 'service_request_id');
    }

}
