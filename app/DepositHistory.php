<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepositHistory extends Model
{
    protected $table = 'deposit_history';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
    protected $fillable = ['name', 'user_id', 'amount', 'created_at', 'updated_at'];
}
