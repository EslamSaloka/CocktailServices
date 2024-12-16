<?php

namespace App\Http\Controllers\Dashboard\Counters;

use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\Counters\CreateOrUpdateRequest;
// Models
use App\Models\Counter;

class CountersController extends Controller
{
    protected $fileName = "counters";
    protected $controllerName = "العدادات";
    protected $routeName = "counters";

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
        $lists = Counter::latest()->paginate();
        return view("admin.pages.$this->fileName.index",get_defined_vars());
    }

    public function create() {
        if(Counter::count() >= 4) {
            return redirect()->route("admin.$this->fileName.index")->with('danger',__('تم الوصول للحد الأقصي لإنشاء الإحصائيات'));
        }
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
        if($request->hasFile('logo')){
            $data['logo'] = (new \App\Support\Image)->FileUpload($data['logo'],"counters");
        }
        Counter::create($data);
        return redirect()->route("admin.$this->fileName.index")->with('success',__('تم حفظ البيانات بنجاح'));
    }

    public function edit(Request $request,Counter $counter) {
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

    public function update(CreateOrUpdateRequest $request,Counter $counter) {
        $data = $request->validated();
        if($request->hasFile('logo')){
            $data['logo'] = (new \App\Support\Image)->FileUpload($data['logo'],"counters");
        }
        $counter->update($data);
        return redirect()->route("admin.$this->fileName.index")->with('success',__('تم تحديث البيانات بنجاح'));
    }

    public function destroy(Counter $counter) {
        $counter->delete();
        return redirect()->route("admin.$this->fileName.index")->with('success',__('تم حذف البيانات'));
    }
}
