<?php

namespace App\Http\Controllers\Dashboard\Employers;

use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\Employers\CreateOrUpdateRequest;
// Models
use App\Models\Employer;

class EmployersController extends Controller
{
    protected $fileName = "employers";
    protected $controllerName = "جهات العمل";
    protected $routeName = "employers";

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
        $lists = Employer::latest()->paginate();
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
        Employer::create($request->validated());
        return redirect()->route("admin.$this->fileName.index")->with('success',__('تم حفظ البيانات بنجاح'));
    }

    public function edit(Request $request,Employer $employer) {
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

    public function update(CreateOrUpdateRequest $request,Employer $employer) {
        $employer->update($request->validated());
        return redirect()->route("admin.$this->fileName.index")->with('success',__('تم تحديث البيانات بنجاح'));
    }

    public function destroy(Employer $employer) {
        $employer->delete();
        return redirect()->route("admin.$this->fileName.index")->with('success',__('تم حذف البيانات'));
    }
}
