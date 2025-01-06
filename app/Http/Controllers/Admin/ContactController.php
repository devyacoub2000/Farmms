<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    
   public function store_contact(Request $request) {
       
        $request->validate([
          'name' => 'required',
          'email' => 'required',
          'subject' => 'required',
          'msg' => 'required',
        ]);

        Contact::Create($request->all());

        return redirect()->route('front.contact')
        ->with('msg', 'Contact Message Done !...');
   }

   public function contacts() {
     $data = Contact::latest('id')->paginate();
     return view('admin.contact', compact('data'));
   }

}
