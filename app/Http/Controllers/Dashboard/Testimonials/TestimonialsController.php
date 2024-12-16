<?php

namespace App\Http\Controllers\Dashboard\Testimonials;

use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\Testimonials\CreateOrUpdateRequest;
// Models
use App\Models\Testimonial;

class TestimonialsController extends Controller
{
    protected $fileName = "testimonials";
    protected $controllerName = "أراء العملاء";
    protected $routeName = "testimonials";

    public function index() {
        $breadcrumb = [
            'title' =>  __("قائمة $this->controllerName"),
            'items' =>  [
                [
                    'title' =>  __("قائمة $this->controllerName"),
                    'url'   =>  route("admin.$this->routeName.index"),
                ]
            ],
        ];
        $lists = Testimonial::latest()->paginate();
        return view("admin.pages.$this->fileName.index",get_defined_vars());
    }

    public function create() {
        $breadcrumb = [
            'title' =>  __("قائمة $this->controllerName"),
            'items' =>  [
                [
                    'title' =>  __("قائمة $this->controllerName"),
                    'url'   =>  route("admin.$this->routeName.index"),
                ],
                [
                    'title' =>  __("إضافه $this->controllerName"),
                    'url'   =>  '#!',
                ],
            ],
        ];
        return view("admin.pages.$this->fileName.edit",get_defined_vars());
    }

    public function store(CreateOrUpdateRequest $request) {
        $data = $request->validated();
        if($request->hasFile('avatar')) {
            $data['avatar'] = (new \App\Support\Image)->FileUpload($request->avatar, 'testimonials');
        }
        Testimonial::create($data);
        return redirect()->route("admin.$this->fileName.index")->with('success',__('تم حفظ البيانات بنجاح'));
    }

    public function edit(Request $request,Testimonial $testimonial) {
        $breadcrumb = [
            'title' =>  __("قائمة $this->controllerName"),
            'items' =>  [
                [
                    'title' =>  __("قائمة $this->controllerName"),
                    'url'   =>  route("admin.$this->routeName.index"),
                ],
                [
                    'title' =>  __("تعديل $this->controllerName"),
                    'url'   =>  '#!',
                ],
            ],
        ];
        return view("admin.pages.$this->fileName.edit",get_defined_vars());
    }

    public function update(CreateOrUpdateRequest $request,Testimonial $testimonial) {
        $data = $request->validated();
        if($request->hasFile('avatar')) {
            $data['avatar'] = (new \App\Support\Image)->FileUpload($request->avatar, 'testimonials');
        }
        $testimonial->update($data);
        return redirect()->route("admin.$this->fileName.index")->with('success',__('تم تحديث البيانات بنجاح'));
    }

    public function destroy(Testimonial $testimonial) {
        $testimonial->delete();
        return redirect()->route("admin.$this->fileName.index")->with('success',__('تم حذف البيانات'));
    }
}
