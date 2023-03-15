<?php

namespace App\Http\Controllers;

use App\ProfitHistory;
use App\User;
use App\UserReferral;
use Auth;
use Illuminate\Http\Request;
use Validator;

class BasicController extends Controller
{

    public function login_form()
    {
        return view('Basic.login');
    }

    public function registration_form()
    {
        return view('Basic.registration');
    }

    public function check_login(Request $request)
    {

        $data  = $request->only('email', 'password');
        $email = $data['email'];

        $rule = array(
            'email'    => 'required|email',
            'password' => 'required|min:6',
        );

        $validator = Validator::make($data, $rule);

        if ($validator->fails()) {
            dd($data);
            return view('Basic.login');

        } else {

            if (Auth::attempt($data)) {

                //check for admin
                if ($this->isAdmin($email)) {
                    return redirect('admin/admin_dashboard/home');
                } else {
                    if (Auth::user()->status == '1') {
                        return redirect('/user/dashboard');
                    } else {
                        return redirect('/user/login');
                    }

                }
            } else {
                return redirect('/user/login');
            }

        }

    }

    public function check_register(Request $request)
    {

        $data = $request->only('name', 'email', 'password', 'conf_password', 'mobile', 'code');
        //dd($data);
        $rule = array(
            'name'          => 'required',
            'email'         => 'required|email',
            'password'      => 'required|min:6',
            'conf_password' => 'required|same:password',
            'mobile'        => 'required',
        );

        $validation = Validator::make($data, $rule);

        if ($validation->fails()) {
            return redirect('/user/register')->with('reg_fail', 'Please enter valid entries..');
        } else {
            $user            = new User;
            $user->name      = $data['name'];
            $user->email     = $data['email'];
            $user->password  = bcrypt($data['password']);
            $user->mobile    = $data['mobile'];
            $user->role_name = "user";
            $user->status    = true;

            $user->save();
            if (!empty($data['code'])) {
                $oUserReferral    = UserReferral::where('token', $data['code'])->where('email', $data['email'])->first();
                $oProfit          = new ProfitHistory();
                $oProfit->type    = 'USER_REFERAL';
                $oProfit->amount  = 100;
                $oProfit->user_id = $oUserReferral->user_id;
                $oProfit->save();
                $oUserReferral->delete();
                $oUser= User::where('id',$oUserReferral->user_id)->first();
                $oUser->user_funds += $oProfit->amount;
                $oUser->save();
            }
            return redirect('/user/dashboard')->with('reg_success', 'Registration Successfully.');

        }

    }

    public function user_logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function isAdmin(String $email)
    {

        $role = User::where('email', $email)->value('role_name');
        if ($role == 'admin') {
            return true;
        } else {
            return false;
        }

    }
}
