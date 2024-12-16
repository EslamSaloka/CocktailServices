<?php

namespace App\Http\Controllers\Main\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\Main\Contact\StoreNewMessageRequest;

class ContactController extends Controller
{
    public function index() {
        return view('main.pages.contact.index');
    }

    public function store(StoreNewMessageRequest $request) {
        $data = $request->validated();
        $name = explode(" ",$data["name"]);
        if(count($name) < 4) {
            return redirect()->back()->withInput($request->all())->withErrors(["name"=>"يجب ان يكون الإسم رباعي"]);
        }
        \App\Models\Contact::create($data);
        return redirect()->back()->with("success","تم استقبال رسالتك بنجاح");
    }
}
