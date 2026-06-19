<?php

namespace Modules\Service\Http\Requests;

use Modules\Base\Http\Requests\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;

class UpdateServiceRequestRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'admin_note' => ['nullable'],
            'status' => ['nullable'],
            'is_active' => ['nullable'],
        ];
    }
}
