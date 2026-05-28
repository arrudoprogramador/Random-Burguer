<?php 

namespace App\Models; 

use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class PedidoItem extends Model 
{ 
    use HasFactory; 
    protected $table = 'pedido_itens'; 

    protected $fillable = [ 'pedido_id', 'lanche_id', 'quantidade', 'preco_unitario', 'subtotal', 'observacao', ]; 
    
    protected $casts = [ 'preco_unitario' => 'decimal:2', 'subtotal' => 'decimal:2', ]; 
    
    /* |---------- | RELACIONAMENTOS |--------- */ 

    public function pedido() {
        return $this->belongsTo(Pedido::class);
    }

    public function lanche() { 
        return $this->belongsTo(Lanche::class); 
    } 
}