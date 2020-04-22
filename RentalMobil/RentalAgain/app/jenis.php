<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jenis extends Model
{
    protected $table="jenis_mobil";
  protected $primaryKey="id";
  protected $fillable=['jenis_mobil'];
  public $timestamps =false;
  
}
