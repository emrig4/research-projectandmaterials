<?php

namespace Modules\Testimonial\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Admin\Traits\HasDefaultActions;
use Modules\Testimonial\Entities\Testimonial;

class TestimonialController extends Controller
{
    use HasDefaultActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Testimonial::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'testimonial::testimonial.testimonial';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'testimonial::admin.testimonials';

    public function index()
    {
        $testimonials = Testimonial::paginate(20);
        return view('testimonial::admin.testimonials.index')->with(['testimonials' => $testimonials]);
    }

    /**
     * Show the form for creating the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('testimonial::admin.testimonials.create');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('testimonial::admin.testimonials.edit')->with(['testimonial' => $testimonial ]);
    }

    public function destroy($id)
    {
        Testimonial::find($id)->delete();
        return response()->json(['status' => 'OK', 'message' => 'Testimonial deleted successfully', 'data' => $id], 201);
    }
}
