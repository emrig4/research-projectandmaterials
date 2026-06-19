<?php

namespace Modules\Category\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Files\Entities\Files;
use Modules\Admin\Traits\HasDefaultActions;
use Modules\Category\Http\Requests\SaveCategoryRequest;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    use HasDefaultActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'category::categories.category';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'category::admin.categories';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveCategoryRequest::class;

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Category::withoutGlobalScope('active')->find($id);
    }


    // airon intervene default store method
    public function store(SaveCategoryRequest $request){

        $data= [
            'name'=>$request->name,
            'parent_id' =>$request->parent_id,
            'description'=>strip_tags($request->description),
            'is_active'=>$request->is_active,
            'slug'=> $request->name,
            'is_searchable'=>$request->is_searchable,
            'is_active'=>$request->is_active,
        ];

        $category_cover = '';

        if($request->category_cover){
            $image_id = (int) $request->category_cover;
            $category_cover = Files::find($image_id);
            $data['category_cover'] = $category_cover->path;
        }
        
        $category=Category::create($data);

        return back()->withSuccess(clean(trans('admin::messages.saved_message', ['resource' => trans('category::categories.category')])));
    }

    /**
     * Destroy resources by given ids.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::withoutGlobalScope('active')
            ->findOrFail($id);
           
        activity('categories')
            ->performedOn($category)
            ->causedBy(auth()->user())
            ->withProperties(['subject' => $category,'causer'=>auth()->user()])
            ->log('deleted');
        $category->delete();
        Category::where('parent_id', $id)->delete();
        return back()->withSuccess(clean(trans('admin::messages.deleted_message', ['resource' => trans('category::categories.category')])));
    }
}
