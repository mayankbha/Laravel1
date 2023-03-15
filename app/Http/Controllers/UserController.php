<?php

namespace App\Http\Controllers;

use App\DepositHistory;
use App\ServiceFeeHistory;
use App\User;
use App\WithdrawalHistory;
use Auth;
use DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function addFunds(Request $request)
    {
        $serviceFee = $this->getServiceFess($request->addamount);
        $amount     = $request->addamount - $serviceFee;
        $request->merge(['addamount' => $amount]);

        $user             = Auth::User();
        $user->user_funds = $user->user_funds + $request->addamount;
        $user->save();

        $depositHistory          = new DepositHistory();
        $depositHistory->amount  = $request->addamount;
        $depositHistory->user_id = $user->id;
        $depositHistory->name    = $user->name;
        $depositHistory->save();

        $totalFunds = User::where('role_name', '!=', 'admin')->sum('user_funds');

        $adminUser = User::where('role_name', 'admin')->first();

        $adminUser->user_funds = $totalFunds;
        $adminUser->save();

        $this->addServiceFess($depositHistory->id, null, 'DEPOSIT', $serviceFee, $depositHistory->user_id); // DepositeID,WithdrawalID,Type,Amount

        return redirect('user/dashboard')->with('message', 'Amount has been added Successfully');

    }

    public function withdrawFunds(Request $request)
    {
        $user                = Auth::User();
        $withdrawal          = new WithdrawalHistory();
        $withdrawal->amount  = $request->addamount;
        $withdrawal->user_id = $user->id;
        $withdrawal->name    = $user->name;
        $withdrawal->status  = '';
        $withdrawal->save();
        return redirect('user/dashboard')->with('message', 'Amount has been added Successfully');
    }

    public function getWithdrawalHistory()
    {
        $user    = Auth::User();
        $history = WithdrawalHistory::where('user_id', $user->id)->get();
        return view('User.withdrawal_history', compact('history'));
    }

    public function getDepositHistory()
    {
        $user    = Auth::User();
        $history = DepositHistory::where('user_id', $user->id)->get();
        return view('User.deposit_history', compact('history'));
    }

    public function getAllTransaction()
    {
        $user   = Auth::User();
        $result = DB::select("SELECT amount,created_at, 'DEPOSIT' as type  FROM deposit_history where user_id = '$user->id'
                        UNION
                        SELECT amount,created_at, 'WITHDWARAL' as type  FROM  withdwaral_history where user_id = '$user->id'
                        UNION
                        SELECT amount,created_at, 'SERVICE CHARGE' as type  FROM  service_fee_histories where user_id = '$user->id'
                        ORDER BY created_at asc");
        return view('User.all_transaction', compact('result'));
    }

    public function getDepositeOfTradeGroup()
    {
        $user   = Auth::User();
        $result = DB::select("SELECT amount,created_at, 'DEPOSIT' as type, 'Deposite Money' as description  FROM deposit_history where user_id = '$user->id'
                        UNION
                        SELECT amount,created_at, 'WITHDWARAL' as type, 'Withdraw Money' as description  FROM  withdwaral_history where user_id = '$user->id'
                        UNION
                        SELECT amount,created_at, 'SERVICE CHARGE' as type, 'Sevice Charge' as description  FROM  service_fee_histories where user_id = '$user->id'
                        UNION
                        SELECT amount,created_at, 'PROFIT' as type, type as description  FROM  profit_histories where user_id = '$user->id'
                        ORDER BY created_at asc");
        $balance = $user->user_funds;
        return view('User.deposite_of_trade_group', compact('result', 'balance'));
    }

    public function getInvesementHistory()
    {
        $user   = Auth::User();
        $result = DB::select("SELECT amount,created_at, 'DEPOSIT' as type  FROM deposit_history
                        UNION
                        SELECT amount,created_at, 'WITHDWARAL' as type  FROM  withdwaral_history
                        ORDER BY created_at asc");

        return view('User.invesement_history', compact('result'));
    }

    public function getServicePaymentAndFees()
    {
        $oUser  = Auth::user();
        $result = ServiceFeeHistory::with('deposite', 'withdrawal')->where('user_id', $oUser->id)->get();
        return view('User.service_payment_fee', compact('result'));
    }

    public function getDepositProfitHistory()
    {
        $user   = Auth::User();
        $result = DB::select("SELECT amount,created_at, 'DEPOSIT' as type, 'Deposite Money' as description  FROM deposit_history where user_id =             '$user->id'
                        UNION
                        SELECT amount,created_at, 'PROFIT' as type, type as description  FROM  profit_histories where user_id = '$user->id'
                        ORDER BY created_at asc");
        $balance = $user->user_funds;
        return view('User.deposit_profit_history', compact('result', 'balance'));
    }

    private function addServiceFess($depositeID, $withdrawID, $type, $amount, $userID)
    {
        $oServiceFee                 = new ServiceFeeHistory();
        $oServiceFee->user_id        = $userID;
        $oServiceFee->deposite_id    = $depositeID;
        $oServiceFee->withdrawal_id  = $withdrawID;
        $oServiceFee->reference_type = $type;
        $oServiceFee->amount         = $amount;
        $oServiceFee->save();
    }

    private function getServiceFess($amount)
    {
        $charge = $amount * 0.05 / 100;
        return number_format($charge, 2, '.', '');
    }
}
