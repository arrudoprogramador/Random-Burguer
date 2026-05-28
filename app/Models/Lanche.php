<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lanche extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lanches';

    protected $fillable = ['categoria_id', 'nome', 'slug', 'descricao', 'imagem', 'preco', 'estoque','destaque', 'ativo',];

    protected $casts = ['preco' => 'decimal:2', 'destaque' => 'boolean', 'ativo' => 'boolean',];

    /*
    |--------------------------------------------------------------------------
    | RELACIONAMENTOS
    |--------------------------------------------------------------------------
    */

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function pedidoItens()
    {
        return $this->hasMany(PedidoItem::class);
    }
}