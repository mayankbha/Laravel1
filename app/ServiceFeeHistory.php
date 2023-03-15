<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class ServiceFeeHistory extends Model
{
    protected $table = 'service_fee_histories';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['deposite_id', 'withdrawal_id', 'reference_type', 'amount','user_id'];


    public function deposite(){
    	return $this->hasOne('App\DepositHistory', 'id', 'deposite_id');
    }

    public function withdrawal(){
    	return $this->hasOne('App\WithdrawalHistory', 'id', 'withdrawal_id');
    }

}