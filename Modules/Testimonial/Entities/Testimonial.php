<?php

namespace Modules\Testimonial\Entities;

use Illuminate\Http\Request;
use Modules\Base\Eloquent\Model;
use Modules\Files\Entities\Files;


class Testimonial extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_enabled' => 'boolean',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
    }
    


    /**
     * Get table data for the resource
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function avatar()
    {
       if($this->avatar){
        $file = Files::find($this->avatar);
        return $file->path;
       }
    }
}
