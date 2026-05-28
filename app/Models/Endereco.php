<?php 
namespace App\Models; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Endereco extends Model 
{ 
    use HasFactory; 
    
    protected $table = 'enderecos'; 
    protected $fillable = [ 'user_id', 'cep', 'rua', 'numero', 'bairro', 'cidade', 'estado', 'complemento', 'principal', ]; 
    protected $casts = [ 'principal' => 'boolean', ]; 
    
    /* |------------ | RELACIONAMENTOS |---------- */ 
    public function user() { 
        return $this->belongsTo(User::class); 
    } 
}