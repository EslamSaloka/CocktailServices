<?php

namespace App\Http\Controllers\Dashboard\Pages;

use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\Pages\CreateOrUpdateRequest;
// Models
use App\Models\About;

class PagesController extends Controller
{
    protected $fileName = "about";
    protected $controllerName = "من نحن";
    protected $routeName = "contents";

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
            $page = About::create(["key"=>"about","content"=>"TEST"]);
        } else {
            $page = About::where(["key"=>"about"])->first();
            if(is_null($page)) {
                $page = About::create(["key"=>"about","content"=>"TEST"]);
            }
        }
        return view("admin.pages.$this->fileName.edit",get_defined_vars());
    }

    public function update(CreateOrUpdateRequest $request,About $content) {
        $data = $request->validated();
        if($request->hasFile('image')){
            $data['image'] = (new \App\Support\Image)->FileUpload($data['image'],"about");
        }
        $content->update($data);
        return redirect()->route("admin.$this->routeName.index")->with('success',__('تم تحديث البيانات بنجاح'));
    }

}
