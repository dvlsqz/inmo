<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Centro extends Model
{
  protected $table='centro';
  protected $primaryKey='id';

  public $timestamps =false;

  protected $fillable = [
    'nombre',
    'direccion',
    'departamento',
    'ciudad',
    'logo',
    'telefono1',
    'telefono2'
  ];
}
