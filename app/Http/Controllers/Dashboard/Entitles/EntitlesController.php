<?php

namespace App\Http\Controllers\Dashboard\Entitles;

use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\Entitles\CreateOrUpdateRequest;
// Models
use App\Models\Entitle;

class EntitlesController extends Controller
{
    protected $fileName = "entitles";
    protected $controllerName = "جهات التمويل";
    protected $routeName = "entitles";

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
        $lists = Entitle::latest()->paginate();
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
        $services = \App\Models\Service::all();
        return view("admin.pages.$this->fileName.edit",get_defined_vars());
    }

    public function store(CreateOrUpdateRequest $request) {
        $entitle = Entitle::create($request->validated());
        $entitle->services()->sync(request("services",[]));
        return redirect()->route("admin.$this->fileName.index")->with('success',__('تم حفظ البيانات بنجاح'));
    }

    public function edit(Request $request,Entitle $entitle) {
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
        $services = \App\Models\Service::all();
        return view("admin.pages.$this->fileName.edit",get_defined_vars());
    }

    public function update(CreateOrUpdateRequest $request,Entitle $entitle) {
        $entitle->update($request->validated());
        $entitle->services()->sync(request("services",[]));
        return redirect()->route("admin.$this->fileName.index")->with('success',__('تم تحديث البيانات بنجاح'));
    }

    public function destroy(Entitle $entitle) {
        $entitle->delete();
        return redirect()->route("admin.$this->fileName.index")->with('success',__('تم حذف البيانات'));
    }
}
