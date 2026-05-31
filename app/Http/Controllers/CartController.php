<?php

namespace App\Http\Controllers;

use App\Models\Lanche;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    private const SESSION_KEY = 'carrinho';
    private const MAX_QUANTIDADE = 20;

    /*
    |--------------------------------------------------------------------------
    | VISUALIZAR
    |--------------------------------------------------------------------------
    */

    public function visualizarCarrinho(): View
    {
        $carrinho = $this->getCarrinho();

        return view('areaUser.carrinho', compact('carrinho'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADICIONAR
    |--------------------------------------------------------------------------
    */

    public function adicionarAoCarrinho(Request $request, int $id): RedirectResponse
    {
        $lanche   = Lanche::findOrFail($id);
        $carrinho = $this->getCarrinho();

        if (isset($carrinho[$id])) {
            $novaQtd = $carrinho[$id]['quantidade'] + ($request->input('quantidade', 1));
            $carrinho[$id]['quantidade'] = min($novaQtd, self::MAX_QUANTIDADE);
        } else {
            $carrinho[$id] = [
                'nome'       => $lanche->nome,
                'preco'      => $lanche->preco,
                'quantidade' => min((int) $request->input('quantidade', 1), self::MAX_QUANTIDADE),
                'imagem'     => $lanche->imagem,
            ];
        }

        $this->saveCarrinho($carrinho);

        return redirect()
            ->back()
            ->with('success', "\"{$lanche->nome}\" adicionado ao carrinho!");
    }

    /*
    |--------------------------------------------------------------------------
    | ATUALIZAR QUANTIDADE
    |--------------------------------------------------------------------------
    */

    public function atualizar(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'quantidade' => "required|integer|min:1|max:" . self::MAX_QUANTIDADE,
        ], [
            'quantidade.required' => 'Informe a quantidade.',
            'quantidade.integer'  => 'A quantidade deve ser um número inteiro.',
            'quantidade.min'      => 'A quantidade mínima é 1.',
            'quantidade.max'      => 'A quantidade máxima é ' . self::MAX_QUANTIDADE . '.',
        ]);

        $carrinho = $this->getCarrinho();

        if (!isset($carrinho[$id])) {
            return redirect()
                ->route('carrinho.index')
                ->with('error', 'Item não encontrado no carrinho.');
        }

        $carrinho[$id]['quantidade'] = (int) $request->quantidade;
        $this->saveCarrinho($carrinho);

        return redirect()
            ->route('carrinho.index')
            ->with('success', 'Quantidade atualizada!');
    }

    /*
    |--------------------------------------------------------------------------
    | REMOVER ITEM
    |--------------------------------------------------------------------------
    */

    public function removerDoCarrinho(int $id): RedirectResponse
    {
        $carrinho = $this->getCarrinho();

        if (!isset($carrinho[$id])) {
            return redirect()
                ->route('carrinho.index')
                ->with('error', 'Item não encontrado no carrinho.');
        }

        $nome = $carrinho[$id]['nome'];
        unset($carrinho[$id]);
        $this->saveCarrinho($carrinho);

        return redirect()
            ->back()
            ->with('success', "\"{$nome}\" removido do carrinho.");
    }

    /*
    |--------------------------------------------------------------------------
    | LIMPAR CARRINHO
    |--------------------------------------------------------------------------
    */

    public function limparCarrinho(): RedirectResponse
    {
        session()->forget(self::SESSION_KEY);

        return redirect()
            ->route('carrinho.index')
            ->with('success', 'Carrinho esvaziado.');
    }

    /*
    |--------------------------------------------------------------------------
    | HELPERS PRIVADOS
    |--------------------------------------------------------------------------
    */

    private function getCarrinho(): array
    {
        return session()->get(self::SESSION_KEY, []);
    }

    private function saveCarrinho(array $carrinho): void
    {
        session()->put(self::SESSION_KEY, $carrinho);
    }
}