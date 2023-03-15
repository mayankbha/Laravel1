<?php

namespace App\Http\Controllers;

use App\DepositHistory;
use App\ProfitHistory;
use App\ServiceFeeHistory;
use App\User;
use App\WithdrawalHistory;
use Illuminate\Http\Request;
use Validator;

class AdminController extends Controller
{

    public function all_user()
    {

        $number = '1';
        $data   = User::where('role_name', 'user')->paginate(10);
        return view('Admin.all_user', compact('data', 'number'));
    }

    public function search_user(Request $request)
    {

        $s      = $request->search_user;
        $number = '1';
        $data   = User::where('name', 'LIKE', '%' . $s . '%')->where('role_name', 'user')->paginate(10);
        return view('Admin.search_user', compact('data', 'number'));

    }

    public function user_profile($id)
    {
        $profile = User::where('id', $id)->first();
        return view('Admin.user_profile', compact('profile'));

    }

    public function update_profile(Request $request, $id)
    {

        $user       = User::where('id', $id)->first();
        $user->name = $request->name;
        //$user->mobile = $request->mobile;
        $user->twitter_link = $request->twitter_link;
        $user->save();
        return back();

    }

    public function delete_profile($id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();
        return redirect('admin/admin_dashboard');
    }

    public function add_funds($id)
    {
        $profile = User::where('id', $id)->first();
        return view('Admin.add_user_funds', compact('profile'));
    }

    public function add_funds_user(Request $request)
    {
        $user             = User::where('id', $request->userid)->first();
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

        return redirect('admin/admin_dashboard/all_users');
    }

    public function admin_index()
    {
        return view('Admin.admin_dashboard');
    }

    public function change_status(Request $request, $id)
    {
        $status = $request->status;
        $user   = User::where('id', $id)->first();

        if ($status == "true") {

            $user->status = "1";
            $user->save();
            return back();
        } else {

            $user->status = "0";
            $user->save();
            return back();
        }

    }

    public function change_user_password(Request $request, $id)
    {

        $data         = $request->only('new_password', 'confirm_password');
        $new_password = $request->new_password;
        $user         = User::where('id', $id)->first();

        $rules = ['new_password' => 'required|min:6',
            'confirm_password'       => 'required_with:new_password|same:new_password|min:6'];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return back(); //->with('fail','Change Password Unsuccessfully..');

        } else {
            User::where('id', $id)->update(['password' => bcrypt($new_password)]);
            //Here inform to user for change password via email notification.
            return back(); //->with('success','Change Password Successfully..');
        }
    }

    public function user_financial_details($id)
    {
        //$user = User::where('id',$id)->first();
        print "User finacial details";
        //if we take seprate table then we can perfome operation on another table. (like user_financial_data_table)
        //return financial details of user
    }

    public function getWithdrawalHistory()
    {
        $history = WithdrawalHistory::all();
        return view('Admin.withdrawal_history', compact('history'));
    }

    public function getDepositHistory()
    {
        $history = DepositHistory::all();
        return view('Admin.deposit_history', compact('history'));
    }

    public function approveRequest($id)
    {

        $WithdrawalHistory         = WithdrawalHistory::find($id);
        $amount                    = $WithdrawalHistory->amount;
        $serviceFee                = $this->getServiceFess($WithdrawalHistory->amount);
        $WithdrawalHistory->amount = $WithdrawalHistory->amount - $serviceFee;
        $WithdrawalHistory->status = 'Approved';
        $WithdrawalHistory->save();

        $user             = User::find($WithdrawalHistory->user_id);
        $user->user_funds = $user->user_funds - $amount;
        $user->save();
        $this->addServiceFess(null, $WithdrawalHistory->id, 'WITHDRAWAL', $serviceFee, $WithdrawalHistory->user_id); // DepositeID,WithdrawalID,Type,Amount
        return back()->with('success', 'Withdrawal Request Approved');
    }

    public function cancleRequest($id)
    {
        $WithdrawalHistory         = WithdrawalHistory::find($id);
        $WithdrawalHistory->status = 'Cancled';
        $WithdrawalHistory->save();
        return back()->with('error', 'Withdrawal Request Cancled');
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

    public function addProfit(Request $oRequest)
    {
        $oProfitDepo = ProfitHistory::where('user_id', $oRequest->user_id)->where('month', $oRequest->month)->where('year', $oRequest->year)->first();
        if (!$oProfitDepo) {
            $oProfit          = new ProfitHistory();
            $oProfit->user_id = $oRequest->user_id;
            $oProfit->month   = $oRequest->month;
            $oProfit->year    = $oRequest->year;
            $oProfit->amount  = $oRequest->amount;
            $oProfit->type    = "DEPOSIT_PROFIT";
            $oProfit->save();

            $oUser = User::find($oRequest->user_id);
            $oUser->user_funds +=   $oProfit->amount;
            $oUser->save();


            return redirect('admin/admin_dashboard/all_users')->with('success', 'Profit has been added');
        } else {
            return redirect('admin/admin_dashboard/all_users')->with('error', 'Profit has been alredy added for this month and year');
        }
    }

}
