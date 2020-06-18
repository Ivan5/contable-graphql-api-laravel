<?php

namespace Tests\Feature;

use App\Account;
use App\Transaction;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class TransactionQueriesTest extends TestCase
{

    use RefreshDatabase;

    function test_it_queries_transactions(){
        //prepare
        $user = factory(User::class)->create();
        $account = factory(Account::class)->create([
            'user_id' => $user->id
        ]);
        $transactions = factory(Transaction::class, 20)->create([
            'account_id' => $account->id
        ]);
        //execute
        Passport::actingAs($user);
        $response = $this->graphQL('
            query {
                transactions(first:20) {
                    data{
                        id
                        amount
                        account{
                            id
                        }
                        type
                    }
                    paginatorInfo {
                        currentPage
                    }
                }
            }
        ');
        //assert
        $response->assertJson([
            'data' => [
                'transactions' => [
                    'data' => [],
                    'paginatorInfo' => []
                ]
            ]
        ]);
    }

    function test_it_queries_logged_in_user_transactions(){
        //prepare
        $user = factory(User::class)->create();
        $account = factory(Account::class)->create([
            'user_id' => $user->id
        ]);
        $transactions = factory(Transaction::class, 10)->create([
            'account_id' => $account->id
        ]);
        factory(Transaction::class,30)->create();
        //execute
        Passport::actingAs($user);
        $response = $this->graphQL('
            query {
                transactions(first:20) {
                    data{
                        id
                        amount
                        account{
                            id
                        }
                        type
                    }
                    paginatorInfo {
                        currentPage
                        total
                    }
                }
            }
        ');
        //assert
        $response->assertJson([
            'data' => [
                'transactions' => [
                    'data' => [],
                    'paginatorInfo' => [
                        'total' => 10
                    ]
                ]
            ]
        ]);
    }
}
