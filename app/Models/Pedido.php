<?php 
namespace App\Models; 

use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Pedido extends Model 
{ 
    use HasFactory; 

    protected $table = 'pedidos'; 

    protected $fillable = [ 'user_id', 'status', 'subtotal', 'taxa_entrega', 'desconto', 'total', 'observacoes', ]; 
    
    protected $casts = [ 'subtotal' => 'decimal:2', 'taxa_entrega' => 'decimal:2', 'desconto' => 'decimal:2', 'total' => 'decimal:2', ];
     
    /* |------- | RELACIONAMENTOS |------ */ 
    
    public function user() { 
        return $this->belongsTo(User::class); 
    } 

    public function itens() { 
        return $this->hasMany(PedidoItem::class);
    } 
    public function pagamento() { 
        return $this->hasOne(Pagamento::class); 
    } 
}