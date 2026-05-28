<?php 

namespace App\Models; 

use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Pagamento extends Model 
{ 
    use HasFactory; 
    
    protected $table = 'pagamentos'; 
    protected $fillable = [ 'pedido_id', 'metodo', 'status', 'transaction_id', 'valor', ]; 
    protected $casts = [ 'valor' => 'decimal:2', ]; 

    /* |------------- | RELACIONAMENTOS |--------------- */ 
    public function pedido() { 
        return $this->belongsTo(Pedido::class); 
    }
}
