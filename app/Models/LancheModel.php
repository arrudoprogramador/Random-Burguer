<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lancheModel extends Model
{
    use HasFactory;

    protected $table = 'lanche_models';

    public $fillable = ['nomeLanche', 'descLanche' ,'fotoLanche','valorLanche'];

    public $timestamps = true;
}
