<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfitHistory extends Model
{
    protected $table = 'profit_histories';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'type', 'month', 'year', 'amount'];
}
