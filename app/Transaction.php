<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable = ['account_id','description','amount','type'];

    protected $casts = [
        'user_id' => 'Int',
        'amount' => 'Float'
    ];

    public function account(){
        return $this->belongsTo(Account::class);
    }
}
