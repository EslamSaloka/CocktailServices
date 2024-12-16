<?php

namespace App\Http\Controllers\Dashboard\Sliders;

use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\Sliders\CreateRequest;
use App\Http\Requests\Dashboard\Sliders\UpdateRequest;
// Models
use App\Models\Slider;

class SlidersController extends Controller
{
    protected $fileName = "sliders";
    protected $controllerName = "الصور المتحركة";
    protected $routeName = "sliders";

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
        $lists = Slider::latest()->paginate();
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

    public function store(CreateRequest $request) {
        $data = $request->validated();
        if($request->hasFile('image')){
            $data['image'] = (new \App\Support\Image)->FileUpload($data['image'],"sliders");
        }
        Slider::create($data);
        return redirect()->route("admin.$this->routeName.index")->with('success',__('تم حفظ البيانات بنجاح'));
    }

    public function edit(Request $request,Slider $slider) {
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

    public function update(UpdateRequest $request,Slider $slider) {
        $data = $request->validated();
        if($request->hasFile('image')){
            $data['image'] = (new \App\Support\Image)->FileUpload($data['image'],"sliders");
        }
        $slider->update($data);
        return redirect()->route("admin.$this->routeName.index")->with('success',__('تم تحديث البيانات بنجاح'));
    }

    public function destroy(Slider $slider) {
        $slider->delete();
        return redirect()->route("admin.$this->routeName.index")->with('success',__('تم حذف البيانات'));
    }
}
