<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable = ['account_id','description','amount','type'];

    protected $casts = [
        'id' => 'Int',
        'account_id' => 'Int',
        'amount' => 'Float'
    ];

    public function account(){
        return $this->belongsTo(Account::class);
    }

    public function scopeByLoggedInUser($query){
        if(!request()->user()){
            return $query;
        }
        return $query->whereHas('account',function($query){
            $query->where('user_id',request()->user()->id);
        });
    }
}
