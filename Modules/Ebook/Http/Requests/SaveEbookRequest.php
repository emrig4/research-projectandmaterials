<?php

namespace Modules\Ebook\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Ebook\Entities\Ebook;
use Modules\Base\Http\Requests\Request;
use Illuminate\Validation\Rules\RequiredIf;

class SaveEbookRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'slug' => $this->getSlugRules(),
            'title' => 'required',
            'description' => 'required',
            'publication_year' => 'nullable|integer|min:1900',
            'is_active' => ['sometimes', 'boolean'],
            'is_featured' => ['sometimes', 'boolean'],
            'categories' => 'required',
            'authors' => 'sometimes',
            'cover_image' => 'nullable',
            'file_type' => ['required', Rule::in('audio','upload', 'embed_code', 'external_link')],
            'ebook_file' => 'required_if:file_type,upload',

            'file_url' => 'required_if:file_type,external_link|nullable|url|url_ext',
            'embed_code' => 'required_if:file_type,embed_code',
            'audio_files' => 'required_if:file_type,audio',

            'main_ebook_file' => 'required_if:main_file_type,upload', //airon
            'main_file_type' => ['required', Rule::in('audio','upload', 'embed_code', 'external_link')],
            'main_file_url' => 'required_if:main_file_type,external_link|nullable|url|url_ext',
            'page_counts' => 'nullable|integer',
            'price' => 'nullable|integer',
            // 'currency_id' => 'required_if:price,!=,null',
            // 'price' => [ new RequiredIf($this->price != null ), 'integer'],
            'currency_id' => new RequiredIf($this->price != null ),
            
        ];
    }

    private function getSlugRules()
    {
        $rules = $this->route()->getName() === 'admin.ebooks.update'
            ? ['required']
            : ['sometimes'];

        $slug = Ebook::withoutGlobalScope('active')->where('id', $this->id)->value('slug');

        $rules[] = Rule::unique('ebooks', 'slug')->ignore($slug, 'slug');

        return $rules;
    }
}
