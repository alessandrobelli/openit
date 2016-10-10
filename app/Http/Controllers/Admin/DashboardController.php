<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Pin;
use Validator;
use App\Subscriber;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users'] = User::count();
        $data['pins'] = Pin::count();

        return view('admin.dashboard', $data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function editSettings()
    {
        return view('admin.settings.editSettings');
    }

    /**
     * Show the application dashboard.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateSettings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'settings_name' => 'required',
            'settings_email' => 'bail|required|unique:users,email,' . Auth::user()->id
        ]);

        $validator->sometimes('new_password', 'required|min:6|alpha_num|confirmed', function($input) {
            return strlen($input->new_password) > 0;
        });

        $validator->after(function($validator) use($request) {
            if ($request->has('new_password')) {
                if (!Auth::attempt(['email' => Auth::user()->email, 'password' => $request->input('settings_password')])) {
                    $validator->errors()->add('settings_password', 'Your current password is incorrect, please try again.');
                }
            }
        });

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $status = null;

        $user = User::findOrFail(Auth::user()->id);

        if ($request->input('settings_name') != $user->name)
            $user->name = $request->input('settings_name');

        if ($request->input('settings_email') != $user->email)
            $user->email = $request->input('settings_email');

        if ($request->has('new_password') && $request->input('new_password') == $request->input('new_password_confirmation')) {
            $user->password = bcrypt($request->input('new_password'));
        }

        $user->touch();
        $user->save();

        $status = 'Your information has benn updated successfully';

        return back()->with('status', $status);
    }
}
