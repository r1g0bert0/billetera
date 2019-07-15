<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Wallet;
use App\Transfer;

class WalletTest extends TestCase
{
    use RefreshDatabase; //refresca la bd cada ves que se ejecuta una prueba
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetWallet()
    {
        //llamando a min factories
        $wallet = factory(Wallet::class)->create();
        $transfers = factory(Transfer::class,3)->create([ //una billetera puede tener varias tranferencias
            'wallet_id'=> $wallet->id //wallet_id = al 'id'del wallet creado anteriormente
        ]);

        $response = $this->json('GET','/api/wallet');//petision json con su url
        
        //validaciones
        $response -> assertStatus(200)//que la respuesta de la peticion sea correcta
                  -> assertJsonStructure([
                      'id','money','transfers'=>[//transfers es un arreglo de objetos
                        '*'=>[//puede recibir cualquier cosa, pero los atributos deben ser los correctos
                            'id','amount','description','wallet_id'
                        ]
                      ]
                  ]); 
        $this->assertCount(3,$response->json()['transfers']);
    }
}
