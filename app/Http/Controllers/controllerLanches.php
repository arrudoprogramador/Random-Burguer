<?php

namespace App\Http\Controllers;

use App\Models\Lanche;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ControllerLanches extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ÁREA DO USUÁRIO (Web)
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $lanches = Lanche::orderBy('nome')->get();

        return view('areaUser.lanches', compact('lanches'));
    }

    public function show(int $id)
    {
        $lanche = Lanche::findOrFail($id);

        return view('areaUser.lancheEscolhido', compact('lanche'));
    }

    public function show4()
    {
        $lanchesFavoritos = Lanche::inRandomOrder()->take(4)->get();

        return view('areaUser.index', compact('lanchesFavoritos'));
    }

    /*
    |--------------------------------------------------------------------------
    | ÁREA ADMINISTRATIVA (Web)
    |--------------------------------------------------------------------------
    */

    public function admin()
    {
        $lanches = Lanche::orderBy('nome')->get();

        return view('areaAdmin.lanches.lanchesCadastrados', compact('lanches'));
    }

    public function create()
    {
        $categorias = Categoria::orderBy('nome')->get();

        return view('areaAdmin.lanches.registerLanche', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'      => 'required|string|max:255',
            'descricao' => 'nullable|string|max:1000',
            'categoria_id' => 'required|exists:categorias,id',
            'preco'     => 'required|numeric|min:0',
            'imagem'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nome.required'  => 'O nome do lanche é obrigatório.',
            'preco.required' => 'O preço é obrigatório.',
            'preco.numeric'  => 'O preço deve ser um valor numérico.',
            'preco.min'      => 'O preço não pode ser negativo.',
            'categoria_id.required' => 'Selecione uma categoria.', 
            'categoria_id.exists'   => 'Categoria inválida.', 
            'imagem.image'   => 'O arquivo deve ser uma imagem.',
            'imagem.max'     => 'A imagem não pode ultrapassar 2MB.',
        ]);

        $lanche = Lanche::create([
            'nome'      => $request->nome,
            'descricao' => $request->descricao,
            'categoria_id' => $request->categoria_id,
            'slug' => Str::slug($request->nome) . '-' . uniqid(),            'preco'     => $request->preco,
            'imagem'    => $this->handleImageUpload($request),
        ]);

        return redirect()
            ->route('admin.lanches.index')
            ->with('success', "Lanche \"{$lanche->nome}\" cadastrado com sucesso!");
    }

    public function edit(int $id)
    {
        $categorias = Categoria::orderBy('nome')->get();
        $lanche = Lanche::findOrFail($id);

        return view('areaAdmin.lanches.editLanche', compact('lanche','categorias'));
    }

    public function update(Request $request, int $id)
    {
        $lanche = Lanche::findOrFail($id);

        $request->validate([
            'nome'      => 'required|string|max:255',
            'descricao' => 'nullable|string|max:1000',
            'categoria_id' => 'required|exists:categorias,id',
            'preco'     => 'required|numeric|min:0',
            'imagem'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nome.required'  => 'O nome do lanche é obrigatório.',
            'preco.required' => 'O preço é obrigatório.',
            'preco.numeric'  => 'O preço deve ser um valor numérico.',
            'preco.min'      => 'O preço não pode ser negativo.',
            'categoria_id.required' => 'Selecione uma categoria.',  // <-- adicionado
            'categoria_id.exists'   => 'Categoria inválida.', 
            'imagem.image'   => 'O arquivo deve ser uma imagem.',
            'imagem.max'     => 'A imagem não pode ultrapassar 2MB.',
        ]);

        $lanche->nome      = $request->nome;
        $lanche->descricao = $request->descricao;
        $lanche->categoria_id = $request->categoria_id;
        $lanche->preco     = $request->preco;

        $novaImagem = $this->handleImageUpload($request);
        if ($novaImagem) {
            $lanche->imagem = $novaImagem;
        }

        $lanche->save();

        return redirect()
            ->route('admin.lanches.index')
            ->with('success', "Lanche \"{$lanche->nome}\" atualizado com sucesso!");
    }

    public function destroy(int $id)
    {
        $lanche = Lanche::findOrFail($id);
        $nome   = $lanche->nome;
        $lanche->delete();

        return redirect()
            ->route('admin.lanches.index')
            ->with('success', "Lanche \"{$nome}\" removido com sucesso.");
    }

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD (Admin)
    |--------------------------------------------------------------------------
    */

    public function vendasTotais()
    {
        // TODO: implementar quando tabela de pedidos estiver pronta
        // $totalArrecadado    = Lanche::sum(DB::raw('quant_vendas * preco'));
        // $totalVendas        = Lanche::sum('quant_vendas');
        // $totalVendasLanches = Lanche::select('nome', 'quant_vendas')->get();
        // $maisVendido        = Lanche::orderByDesc('quant_vendas')->first();
        // $topLanches         = Lanche::orderByDesc('quant_vendas')->take(5)->get();

        $totalLanches = Lanche::count();
        $topLanches   = Lanche::orderByDesc('preco')->take(5)->get();

        return view('areaAdmin.index', compact(
            'totalLanches',
            'topLanches',
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | HELPERS PRIVADOS
    |--------------------------------------------------------------------------
    */

    private function handleImageUpload(Request $request): ?string
    {
        if (!$request->hasFile('imagem')) {
            return null;
        }

        $file      = $request->file('imagem');
        $directory = public_path('img/lanches');

        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $fileName = time() . '_' . str()->slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                  . '.' . $file->getClientOriginalExtension();

        $file->move($directory, $fileName);

        return $fileName;
    }
}