<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\LancheModel;

class CartController extends Controller
{
    public function adicionarAoCarrinho(Request $request, $id)
    {
        $lanche = LancheModel::findOrFail($id);
        $carrinho = session()->get('carrinho', []);

        if (isset($carrinho[$id])) {
            $carrinho[$id]['quantidade']++;
        } else {
            $carrinho[$id] = [
                'nome' => $lanche->nomeLanche,
                'preco' => $lanche->valorLanche,
                'quantidade' => 1,
                'imagem' => $lanche->fotoLanche
            ];
        }

        session()->put('carrinho', $carrinho);
        return redirect()->back()->with('success', 'Lanche adicionado ao carrinho!');
    }


    public function atualizar(Request $request, $id)
    {
        // Valida a quantidade enviada pelo formulário
        $request->validate([
            'quantidade' => 'required|integer|min:1'
        ]);
    
        // Obtém o carrinho da sessão
        $carrinho = session()->get('carrinho');
    
        // Verifica se o item existe no carrinho
        if (isset($carrinho[$id])) {
            // Atualiza a quantidade do item
            $carrinho[$id]['quantidade'] = $request->quantidade;
    
            // Atualiza a sessão do carrinho
            session()->put('carrinho', $carrinho);
    
            return redirect()->route('carrinho.visualizar')->with('success', 'Quantidade atualizada!');
        }
    
        return redirect()->route('carrinho.index')->with('error', 'Item não encontrado no carrinho.');
    }
    


    public function visualizarCarrinho()
    {
        $carrinho = session()->get('carrinho', []);
        return view('/areaUser/carrinho', compact('carrinho'));
    }

    public function removerDoCarrinho($id)
    {
        $carrinho = session()->get('carrinho', []);

        if (isset($carrinho[$id])) {
            unset($carrinho[$id]);
            session()->put('carrinho', $carrinho);
        }

        return redirect()->back()->with('success', 'Lanche removido do carrinho!');
    }

    public function limparCarrinho()
    {
        session()->forget('carrinho');
        return redirect()->back()->with('success', 'Carrinho esvaziado!');
    }
}
