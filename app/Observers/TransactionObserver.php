<?php

namespace App\Observers;

use App\Account;
use App\Transaction;

class TransactionObserver
{
    //
    public function created(Transaction $transaction){
        $account = $transaction->account;
        return $this->calculateNewAccountBalance($transaction,$account);
    }

    public function updating(Transaction $transaction){
        request()->merge([
            'old_transaction' => Transaction::find($transaction->id)->toArray()
        ]);
        
    }

    public function updated(Transaction $transaction){
        $account = $transaction->account;
       $this->setAccountBalanceFromOldTransaction($account);
       return $this->calculateNewAccountBalance($transaction, $account);
       
    }

    public function setAccountBalanceFromOldTransaction($account) : Account  {
        $old_transaction = (object) request()->get('old_transaction');
       if($old_transaction->type === "INCOME"){
           $account->balance = $account->balance - $old_transaction->amount;
           return $account;
       }
        $account->balance = $account->balance + $old_transaction->amount;
       return $account;
    }

    public function calculateNewAccountBalance(Transaction $transaction, $account){
        if($transaction->type === 'INCOME'){
            $account->balance = $account->balance + $transaction->amount;
            return $account->save();
        }
        $account->balance = $account->balance - $transaction->amount;
        return $account->save();
    }
}
