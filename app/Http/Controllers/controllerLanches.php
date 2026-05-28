<?php

namespace App\Http\Controllers;

use App\Models\Lanche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controllerLanches extends Controller
{
    public function index()
    {
        $lanches = Lanche::all();
        return view('areaUser.lanches', compact('lanches'));      
    }

    public function vendasTotais()
    {
        $totalArrecadado = Lanche::sum(DB::raw('quant_vendas * valorLanche'));
        $totalVendas = Lanche::sum('quant_vendas');
        $totalVendasLanches = Lanche::select('nomeLanche', 'quant_vendas')->get();
        $maisVendido = Lanche::orderByDesc('quant_vendas')->first();
        $topLanches = Lanche::orderByDesc('quant_vendas')->take(5)->get();


        return view('areaAdmin.index', [
            'vendasLanches' => $totalVendasLanches,
            'totalVendas' => $totalVendas,
            'maisVendido' => $maisVendido,
            'topLanches'=> $topLanches,
            'totalArrecadado' => $totalArrecadado,

        ]);
    }


    public function admin()
    {
        $lanches = Lanche::all();
        return view('areaAdmin.lanchesCadastrados', compact('lanches'));      
    }

    public function create()
    {
        return view('areaAdmin.registerLanche');
    }

    public function show($id)
    {
        $lanche = Lanche::find($id);
        
        return view('areaUser.lancheEscolhido', compact('lanche'));      
    }


    public function destroy($id)
    {
        $lanche = Lanche::find($id);

        // Verificar se o lanche existe
        if ($lanche) {
            // Excluir o lanche
            $lanche->delete();

            // Redirecionar com uma mensagem de sucesso
            return redirect()->route('lanches.admin')->with('success', 'Lanche excluído com sucesso!');
        } else {
            // Caso o lanche não seja encontrado
            return redirect()->route('lanches.admin')->with('error', 'Lanche não encontrado!');
        }
    }

    public function edit($id)
    {
        if (!$lanche = Lanche::find($id))
            return redirect()->route('users.index');

        return view('/areaAdmin/editLanche', compact('lanche'));

    }

    public function update(Request $request, $id)
    {
        // Validação dos dados
        $request->validate([
            'nomeLanche' => 'required|string|max:255',
            'descLanche' => 'required|string|max:255',
            'valorLanche' => 'required|numeric',
        ]);
    
        // Encontrar o lanche pelo id
        if (!$lanche = Lanche::find($id)) {
            return redirect()->route('users.index');
        }
    
        // Atualiza os dados do lanche
        $lanche->nomeLanche = $request->input('nomeLanche');
        $lanche->descLanche = $request->input('descLanche');
        $lanche->valorLanche = $request->input('valorLanche');


        // Verificar se a imagem foi enviada e mover para o diretório desejado
        if ($request->hasFile('fotoLanche')) {
            // Obtém o arquivo da requisição
            $file = $request->file('fotoLanche');
    
            // Verificar se o arquivo é uma imagem válida (opcional, mas recomendado)
            if ($file->isValid() && in_array($file->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif'])) {
                
                // Define o diretório desejado
                $directory = public_path('img/lanches');
                
                // Cria o diretório caso não exista
                if (!file_exists($directory)) {
                    mkdir($directory, 0777, true); // Cria o diretório com permissão 777
                }
    
                // Define o nome do arquivo (usando o timestamp para evitar conflitos de nomes)
                $fileName = time() . '.' . $file->getClientOriginalExtension();
    
                // Move o arquivo para o diretório 'public/img/lanches'
                $file->move($directory, $fileName);
    
                // Salva o nome do arquivo (não a URL) no banco de dados
                $lanche->fotoLanche = $fileName;
            } else {
                // Caso o arquivo não seja válido, você pode adicionar uma mensagem de erro ou tratar o caso.
                return redirect()->back()->withErrors('Arquivo inválido. Envie uma imagem válida (jpg, jpeg, png, gif).')->withInput();
            }
        }

        $lanche->save();
    
        // Redireciona para a página de lanches cadastrados após a atualização
        return redirect()->route('lanches.admin')->with('success', 'Lanche atualizado com sucesso!');
    }



    public function store(Request $request)
{
    // Validação dos campos
    $request->validate([
        'nomeLanche' => 'required|string|max:255',
        'descLanche' => 'nullable|string',
        'valorLanche' => 'required|numeric',
        'fotoLanche' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    try {
        // Criar um novo lanche
        $lanche = new Lanche();
        $lanche->nomeLanche = $request->input('nomeLanche');
        $lanche->descLanche = $request->input('descLanche');
        $lanche->valorLanche = $request->input('valorLanche');
        
    
        // Verificar se a imagem foi enviada e mover para o diretório desejado
        if ($request->hasFile('fotoLanche')) {
            // Obtém o arquivo da requisição
            $file = $request->file('fotoLanche');
    
            // Verificar se o arquivo é uma imagem válida (opcional, mas recomendado)
            if ($file->isValid() && in_array($file->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif'])) {
                
                // Define o diretório desejado
                $directory = public_path('img/lanches');
                
                // Cria o diretório caso não exista
                if (!file_exists($directory)) {
                    mkdir($directory, 0777, true); // Cria o diretório com permissão 777
                }
    
                // Define o nome do arquivo (usando o timestamp para evitar conflitos de nomes)
                $fileName = time() . '.' . $file->getClientOriginalExtension();
    
                // Move o arquivo para o diretório 'public/img/lanches'
                $file->move($directory, $fileName);
    
                // Salva o nome do arquivo (não a URL) no banco de dados
                $lanche->fotoLanche = $fileName;
            } else {
                // Caso o arquivo não seja válido, você pode adicionar uma mensagem de erro ou tratar o caso.
                return redirect()->back()->withErrors('Arquivo inválido. Envie uma imagem válida (jpg, jpeg, png, gif).')->withInput();
            }
        }
    
        // Salvar o lanche no banco de dados
        $lanche->save();
    
        // Redireciona de volta para o formulário com uma mensagem de sucesso
        return redirect()->route('lanches.admin')->with('success', 'Lanche cadastrado com sucesso!');
    } catch (\Exception $e) {
        // Caso algum erro ocorra, redireciona de volta com a mensagem de erro
        return redirect()->back()->withErrors('Erro ao cadastrar o lanche. Tente novamente.')->withInput();
    }
}    

}
