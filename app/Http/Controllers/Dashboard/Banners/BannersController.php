<?php

namespace App\Http\Controllers\Dashboard\Banners;

use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\Banners\CreateOrUpdateRequest;
// Models
use App\Models\Banner;

class BannersController extends Controller
{
    protected $fileName = "banners";
    protected $controllerName = "الفيديوهات";
    protected $routeName = "banners";

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
        $lists = Banner::latest()->paginate();
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
        if($request->has('video')) {
            $data['video'] = (new \App\Support\Image)->FileUpload($request->video, 'video');
        }
        Banner::create($data);
        return redirect()->route("admin.$this->fileName.index")->with('success',__('تم حفظ البيانات بنجاح'));
    }

    public function edit(Request $request,Banner $banner) {
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

    public function update(CreateOrUpdateRequest $request,Banner $banner) {
        $data = $request->validated();
        if($request->has('video')) {
            $data['video'] = (new \App\Support\Image)->FileUpload($request->video, 'video');
        }
        $banner->update($data);
        return redirect()->route("admin.$this->fileName.index")->with('success',__('تم تحديث البيانات بنجاح'));
    }

    public function destroy(Banner $banner) {
        $banner->delete();
        return redirect()->route("admin.$this->fileName.index")->with('success',__('تم حذف البيانات'));
    }
}
