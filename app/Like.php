<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table='like';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $guarded=[];
}
