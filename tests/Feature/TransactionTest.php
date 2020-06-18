<?php

namespace Tests\Feature;

use App\Account;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    function test_it_creates_transaction_and_updates_balance(){
        //prepare
        $user = factory(User::class)->create();
        $account = factory(Account::class)->create([
            'user_id' => $user->id,
            'balance' => 0
        ]);
        Passport::actingAs($user);
        //execute
        $response = $this->graphQL('
            mutation{
                createTransaction(input:{
                    account_id:'.$account->id.',
                    type: INCOME,
                    description:"Income",
                    amount: 100
                }){
                    description
                    type
                    amount
                    account{
                        id
                        name
                        balance
                    }
                }
            }
        ');
        //assert
        $response->assertJson([
            'data' => [
               'createTransaction' => [
                   'description' => 'Income',
                   'type'=>'INCOME',
                   'amount'=>100.00,
                   'account' => [
                       'id' => $account->id,
                       'name' => $account->name,
                       'balance' => 100.00
                   ]
               ] 
            ]
        ]);
    }

    function test_it_creates_transaction_and_update_balance_with_expense(){
        //prepare
        $user = factory(User::class)->create();
        $account = factory(Account::class)->create([
            'user_id' => $user->id,
            'balance' => 100
        ]);
        Passport::actingAs($user);
        //execute
        $response = $this->graphQL('
            mutation{
                createTransaction(input:{
                    account_id:'.$account->id.',
                    type: EXPENSE,
                    description:"Expense",
                    amount: 50
                }){
                    description
                    type
                    amount
                    account{
                        id
                        name
                        balance
                    }
                }
            }
        ');
        //assert
        $response->assertJson([
            'data' => [
               'createTransaction' => [
                   'description' => 'Expense',
                   'type'=>'EXPENSE',
                   'amount'=>50.00,
                   'account' => [
                       'id' => $account->id,
                       'name' => $account->name,
                       'balance' => 50.00
                   ]
               ] 
            ]
        ]);
    }

    function test_it_can_update_an_account()
    {
        $user = factory(User::class)->create();
        $account = factory(Account::class)->create([
            'name' => 'Wallet',
            'user_id' => $user->id,
            'balance' => 100
        ]);
        Passport::actingAs($user);
        $response = $this->graphQL('
            mutation{
                updateAccount(id:'.$account->id.', input:{
                    name:"Savings"
                }){
                    id
                    name
                    balance
                }
            }
        ');

        $response->assertJson([
            'data' => [
                'updateAccount' => [
                    'id' => $account->id,
                    'name' => 'Savings',
                    'balance' => $account->balance
                ]
            ]
        ]);
        $this->assertDatabaseHas('accounts',[
            'user_id' => $user->id,
            'name' => 'Savings',
            'id' => $account->id
        ]);
    }
}
