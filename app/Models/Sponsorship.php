<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    protected $fillable = [
        'orphan_id' , 'duration' , 'amount' ,'start_date' ,'role' ,'status' , 'payment_receipt'
    ];

    public function orphan(){
        return $this->belongsTo(Orphan::class)->withDefault();
    }
}
