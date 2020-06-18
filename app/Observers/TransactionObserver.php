<?php

namespace App\Observers;

use App\Transaction;

class TransactionObserver
{
    //
    public function created(Transaction $transaction){
        $account = $transaction->account;
        if($transaction->type === 'INCOME'){
            $account->balance = $account->balance + $transaction->amount;
            return $account->save();
        }
        $account->balance = $account->balance - $transaction->amount;
        return $account->save();
    }

    public function updating(Transaction $transaction){
        request()->merge([
            'old_transaction' => Transaction::find($transaction->id)->toArray()
        ]);
        
    }

    public function updated(Transaction $transaction){
        $account = $transaction->account;
       $old_transaction = (object) request()->get('old_transaction');
       if($old_transaction->type === "INCOME"){
           $account->balance = $account->balance - $old_transaction->amount;
       }else{
           $account->balance = $account->balance + $old_transaction->amount;
       }
       if($transaction->type === "INCOME"){
           $account->balance = $account->balance + $transaction->amount;
           return $account->save();
       }
       $account->balance = $account->balance - $transaction->amount;
        return $account->save();
       
    }
}
