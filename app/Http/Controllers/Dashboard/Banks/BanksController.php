<?php

namespace App\Http\Controllers\Dashboard\Banks;

use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\Banks\CreateOrUpdateRequest;
// Models
use App\Models\Bank;

class BanksController extends Controller
{
    protected $fileName = "banks";
    protected $controllerName = "الحسابات البنكية";
    protected $routeName = "banks";

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
        $lists = Bank::latest()->paginate();
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
        Bank::create($request->validated());
        return redirect()->route("admin.$this->fileName.index")->with('success',__('تم حفظ البيانات بنجاح'));
    }

    public function edit(Request $request,Bank $bank) {
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

    public function update(CreateOrUpdateRequest $request,Bank $bank) {
        $bank->update($request->validated());
        return redirect()->route("admin.$this->fileName.index")->with('success',__('تم تحديث البيانات بنجاح'));
    }

    public function destroy(Bank $bank) {
        $bank->delete();
        return redirect()->route("admin.$this->fileName.index")->with('success',__('تم حذف البيانات'));
    }
}
