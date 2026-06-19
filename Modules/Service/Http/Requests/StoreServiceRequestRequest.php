<?php

namespace Modules\Service\Http\Requests;

use Modules\Base\Http\Requests\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;

class StoreServiceRequestRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'contact_name' => ['required'],
            'contact_phone' => ['nullable'],
            'contact_email' => ['required'],

            'dd_day' => 'nullable',
            'dd_month' => 'nullable',
            'dd_year' => 'nullable',

            'program_type' => ['nullable'],

            'service_id' => ['required'],
            'subject' => ['required'],
            'message' => ['required'],
            'admin_note' => ['nullable'],

            'status' => ['nullable'],
            'is_active' => ['nullable'],

            'g-recaptcha-response' => 'required|captcha',
        ];
    }
}
