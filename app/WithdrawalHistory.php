<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WithdrawalHistory extends Model
{
    protected $table = 'withdwaral_history';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'user_id', 'amount', 'status', 'created_at', 'updated_at'];
}