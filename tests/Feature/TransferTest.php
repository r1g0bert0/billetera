<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Wallet;
use App\Transfer;

class TransferTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
  
    public function testPostTransfer()
    {
        $wallet = factory(Wallet::class)->create();
        $transfer = factory(Transfer::class)->make(); //se crea en momoria

        $response = $this->json('POST','/api/transfer',[
            'amount' => $transfer->amount,
            'description' => $transfer->description,
            'wallet_id' => $wallet->id
        ]);

        //validaciones
        $response->assertJsonStructure(['id','amount','description','wallet_id'])
                 -> assertStatus(201);//que se creo el objeto de manera correcta; 
        
                  //con assertDa.. accedemos a la bd y validamos que los campos existan
        $this->assertDatabaseHas('transfers',[
            'amount' => $transfer->amount,
            'description' => $transfer->description,
            'wallet_id' => $wallet->id 
        ]);

        $this->assertDatabaseHas('wallets',[
            'id' => $wallet->id ,
            'money' =>$wallet->money + $transfer->amount
        ]);
    }  
    
}
