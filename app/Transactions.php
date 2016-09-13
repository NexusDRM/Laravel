<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'user_id', 'stripe_trans_id', 'trans_amount', 'currency_id'
 ];

  /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
  protected $hidden = [
    'stripe_trans_id'
 ];
}
