<?php

namespace App\Http\Controllers;

use App\UserReferral;
use Auth;
use Mail;
use Illuminate\Http\Request;
use DB;

class UserReferralController extends Controller
{
    public function index()
    {
        return view('User.user_referral');
    }

    public function referFriend(Request $oRequest)
    {
        $this->validate($oRequest, [
            'email' => 'email',
        ]);
        $oUserReferral          = new UserReferral();
        $oUserReferral->email   = $oRequest->email;
        $oUserReferral->token   = uniqid();
        $oUserReferral->user_id = Auth::user()->id;
        $oUserReferral->save();
        $email = $oUserReferral->email;
        $url = url('/').'/user/register?code='.$oUserReferral->token;
        Mail::send('emails.referral', ['url' =>$url ], function ($message) use ($email) {
            $message->to($email)->subject('Join Prometheus');
        });
        return redirect('user/refer-friend')->with('message', 'Request has been send successfully');
    }

    public function referralHistory()
    {
        $user   = Auth::User();
        $result = DB::select("SELECT amount,created_at, 'PROFIT' as type, type as description  FROM  profit_histories where user_id = '$user->id'
                        and type = 'USER_REFERAL'
                        ORDER BY created_at asc");
        return view('User.referral-history', compact('result'));
    }
}
