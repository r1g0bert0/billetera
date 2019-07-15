<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    public function wallet(){
        return $this->belongsTo('App\Wallet');//un transfer pertenece solo a un wallet
    }
}
