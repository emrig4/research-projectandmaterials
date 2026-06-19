<?php

namespace Modules\Service\Entities;

use Modules\Base\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Ebook\Entities\Currency;

class Service extends Model
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

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'currency_id' => 'integer',
    ];

    public function requests()
    {
        return $this->hasMany(ServiceRequest::class, 'service_id', 'id'); // foriegn_key local_key
    }

     public function currencyCode()
    {   
        // this is more tolerant than the initial approach above, since some ebooks may be for sale hence wil not have currencies set
        $servicePriceCurrency = Currency::find($this->currency_id);
        if(is_null($servicePriceCurrency)){
            return;
        }
        return $servicePriceCurrency->code;
        
    }

    public function isNotEmpty(){
        if($this == null){
            return true;
        }else{
            return false;
        }
    }

}
