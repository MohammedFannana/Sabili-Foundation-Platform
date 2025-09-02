<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialDocument extends Model
{
    protected $fillable  =[
       'date' , 'file'
    ];
}
