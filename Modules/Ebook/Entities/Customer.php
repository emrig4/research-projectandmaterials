<?php

namespace Modules\Ebook\Entities;

use Modules\Base\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
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
    public function ebookPurchases()
    {
        return $this->hasMany(PurchasedEbook::class, 'customer_id');
    }

}
