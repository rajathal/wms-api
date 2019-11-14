<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Drivers extends Authenticatable
{
  use HasApiTokens, Notifiable;
  
  protected $fillable = [
    'account_id', 'user_name', 'contact_no', 'email', 'password','photo', 'city', 'state',
];
  
}
