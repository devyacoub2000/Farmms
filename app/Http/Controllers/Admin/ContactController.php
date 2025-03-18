<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Mail\ContactReply;
use Illuminate\Support\Facades\Mail;


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

   public function single_contact($id) {
     $item = Contact::findOrFail($id);
     return view('admin.single_contact', compact('item'));
   }

   public function delete_contact($id) {
     $item = Contact::findOrFail($id);
     $item->delete();
     return redirect()->route('admin.contacts')
        ->with('msg', 'Contact Delete Done ...');
   }

   public function reply_msg(Request $request, $id) {

        $msg = Contact::findOrFail($id);
        Mail::to($msg->email)->send(new ContactReply($msg->name, $request->reply));
        return redirect()->back()->with('msg', 'Reply Message Send Successfully .. ');


   }



}
