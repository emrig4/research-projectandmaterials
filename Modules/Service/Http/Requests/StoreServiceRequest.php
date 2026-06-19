<?php

namespace Modules\Service\Http\Requests;

use Modules\Base\Http\Requests\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;

class StoreServiceRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->request->add(['slug' => Str::slug($this->title) ]);
        return [
            'slug' => ['unique:services'],
            'title' => ['required'],
            'price' => 'required_if:price,!=,null',
            'currency_id' => new RequiredIf($this->price != null ),
            'icon_class' => ['required'],
            'description' => ['required'],
            'short_description' => ['required'],
            'is_featured' => ['nullable'],
            'features' => ['nullable'],
            'is_active' => ['nullable'],
            'icon_class' => ['required'],
        ];
    }
}
