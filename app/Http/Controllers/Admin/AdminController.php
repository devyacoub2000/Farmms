<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use App\Models\Setting;

class AdminController extends Controller
{
    public function index() {
        return view('admin.index');
    }

    public function profile() {
        $admin = Auth::user();
        return view('admin.profile_data', compact('admin'));
    }
    
     public function profile_data(Request $request) {

       $request->validate([
            'name' => 'required',
            'current_password' => 'required_with:password',
            'password' => 'nullable|min:8|confirmed',
       ]); 

       $admin = Auth::user();
       $data = [
          'name' => $request->name,
       ];
       if($request->has('password')) {
          $data['password'] = bcrypt($request->password);
       }

       $admin->update($data);

       if($request->hasFile('image')) {
              if($admin->image) {
                 File::delete(public_path('images/'.$admin->image->path));
                 $admin->image()->delete();
              }
              $img = $request->File('image');
              $img_name = rand().time().$img->getClientOriginalName();
              $img->move(public_path('images'), $img_name);
                $admin->image()->create([
                       'path' => $img_name,
                   ]); 
       }

       return redirect()->back()->with('msg', 'Profile Update Successfully');
    }


     public function check_password(Request $request) {

         return (Hash::check($request->password, Auth::user()->password));
    }

    // settings 

    public function settings() {
        // $data = Setting::select('key', 'value')->get()->toArray();
        // $emptyArray = [];
        // foreach ($data as $item) {
        //     $emptyArray[$item['key']] = $item['value'];
        // }
        // $data = $emptyArray;

        $data = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings', compact('data'));
    }

    public function save_settings(Request $request) {

        $data = $request->except('_token', '_method', 'logo_image');

        if($request->hasFile('logo_image')) {

            $oldimg = Setting::where('key', 'logo_image')->first();
            if($oldimg) {
                 File::delete(public_path('settings_imgs/'.$oldimg['value']));
            }
            Artisan::call('cache:clear');
            $img = $request->File('logo_image');
            $img_name = rand().time().$img->getClientOriginalName();
            $img->move(public_path('settings_imgs'), $img_name);
            $data['logo_image'] = $img_name;
        }

        foreach ($data as $key => $value) {
             Setting::updateOrCreate([
                  'key' => $key,
             ], [

                  'value' => $value,
             ]);
        }

        return redirect()->back()->with('msg', 'Update Setting was Done ...');
    }

    public function deleimg_site(Request $request) {
         Artisan::call('cache:clear');
         Setting::where('key', 'logo_image')->update([
             'value' => null
         ]);

         return response()->json(['message' => 'Logo Delete Done']);
    }
}
