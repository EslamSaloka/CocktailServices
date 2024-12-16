<?php

namespace App\Http\Controllers\Dashboard\Pages;

use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\FAQS\CreateOrUpdateRequest;
// Models
use App\Models\About\Data;

class AboutsController extends Controller
{
    protected $fileName = "about.data";
    protected $controllerName = "المحتوى الإضافي";
    protected $routeName = "abouts";

    public function index() {
        $breadcrumb = [
            'title' =>  __(" $this->controllerName"),
            'items' =>  [
                [
                    'title' =>  __("من نحن"),
                    'url'   =>  route("admin.contents.index"),
                ],
                [
                    'title' =>  __(" $this->controllerName"),
                    'url'   =>  route("admin.$this->routeName.index"),
                ],
            ],
        ];
        $lists = Data::latest()->paginate();
        return view("admin.pages.$this->fileName.index",get_defined_vars());
    }

    public function create() {
        $breadcrumb = [
            'title' =>  __("قائمة $this->controllerName"),
            'items' =>  [
                [
                    'title' =>  __("من نحن"),
                    'url'   =>  route("admin.contents.index"),
                ],
                [
                    'title' =>  __(" $this->controllerName"),
                    'url'   =>  route("admin.$this->routeName.index"),
                ],
                [
                    'title' =>  __(" $this->controllerName"),
                    'url'   =>  '#!',
                ],
            ],
        ];
        return view("admin.pages.$this->fileName.edit",get_defined_vars());
    }

    public function store(CreateOrUpdateRequest $request) {
        Data::create($request->validated());
        return redirect()->route("admin.$this->routeName.index")->with('success',__('تم حفظ البيانات بنجاح'));
    }

    public function edit(Request $request,Data $about) {
        $breadcrumb = [
            'title' =>  __("قائمة $this->controllerName"),
            'items' =>  [
                [
                    'title' =>  __("من نحن"),
                    'url'   =>  route("admin.contents.index"),
                ],
                [
                    'title' =>  __(" $this->controllerName"),
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

    public function update(CreateOrUpdateRequest $request,Data $about) {
        $about->update($request->validated());
        return redirect()->route("admin.$this->routeName.index")->with('success',__('تم تحديث البيانات بنجاح'));
    }

    public function destroy(Data $about) {
        $about->delete();
        return redirect()->route("admin.$this->routeName.index")->with('success',__('تم حذف البيانات'));
    }

}
