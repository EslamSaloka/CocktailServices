<?php

namespace App\Http\Controllers\Dashboard\Pages;

use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\Pages\CreateOrUpdateRequest;
// Models
use App\Models\About;

class TermsController extends Controller
{
    protected $fileName = "terms";
    protected $controllerName = "الشروط و الأحكام";
    protected $routeName = "terms";

    public function index() {
        $breadcrumb = [
            'title' =>  __(" $this->controllerName"),
            'items' =>  [
                [
                    'title' =>  __("$this->controllerName"),
                    'url'   =>  route("admin.$this->routeName.index"),
                ]
            ],
        ];
        if(About::count() == 0) {
            $page = About::create(["key"=>"terms","content"=>"TEST"]);
        } else {
            $page = About::where(["key"=>"terms"])->first();
            if(is_null($page)) {
                $page = About::create(["key"=>"terms","content"=>"TEST"]);
            }
        }
        return view("admin.pages.$this->fileName.edit",get_defined_vars());
    }

    public function update(CreateOrUpdateRequest $request,About $term) {
        $term->update($request->validated());
        return redirect()->route("admin.$this->routeName.index")->with('success',__('تم تحديث البيانات بنجاح'));
    }

}
