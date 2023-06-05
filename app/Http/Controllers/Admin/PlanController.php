<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlanController extends Controller
{
    private $repository;
    public function __construct(Plan $plan)
    {
        $this->repository = $plan;
    }
    public function index()
    {
        $plans = $this->repository->latest()->paginate(10);
        //    return   view('admin.pages.plans.index',['plans' => $plans]);
        return   view('admin.pages.plans.index', ['plans' => $plans]);
    }
    public function show($url)
    {
        $plan = $this->repository->where('url', $url)->first();
        // dd($plan);
        if (!$plan) return
            redirect()->back();


        return   view('admin.pages.plans.show', ['plan' => $plan]);
    }
    public function edit($url)
    {
        $plan = $this->repository->where('url', $url)->first();
        // dd($plan);
        if (!$plan) return
            redirect()->back();


        return   view('admin.pages.plans.edit', ['plan' => $plan]);
    }
    public function destroy($id)
    {
        $plan = $this->repository->where('id', $id)->first();
        // dd($plan);
        if (!$plan) return
            redirect()->back();
        $plan->delete();

        return  redirect()->route('plans.index');
    }

    public function update(Request $request, $id)
    {
        $plan = $this->repository->where('id', $id)->first();

        if (!$plan) return
            redirect()->back();

        //dd($request->all());

        $plan->update($request->all());

        return  redirect()->route('plans.index');
    }
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $plans = $this->repository->search($request->filter);

        return   view('admin.pages.plans.index', ['plans' => $plans, 'filters' => $filters,]);
    }
    public function create()
    {

        return   view('admin.pages.plans.create');
    }
    public function store(Request $request)
    {
        //dd($request->all());
        $data = $request->all();
        $data['url'] = $this->removerAcentos(Str::of($data['name'])->kebab());
        $data['name'] = $this->removerAcentos($data['name']);
        $this->repository->create($data);
        return redirect()->route('plans.index');
    }

   public function removerAcentos($string){
    $string = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
    $acentos = array(
        '/[áàâãªä]/u' => 'a',
        '/[ÁÀÂÃÄ]/u' => 'A',
        '/[ÍÌÎÏ]/u' => 'I',
        '/[íìîï]/u' => 'i',
        '/[éèêë]/u' => 'e',
        '/[ÉÈÊË]/u' => 'E',
        '/[óòôõºö]/u' => 'o',
        '/[ÓÒÔÕÖ]/u' => 'O',
        '/[úùûü]/u' => 'u',
        '/[ÚÙÛÜ]/u' => 'U',
        '/ç/' => 'c',
        '/Ç/' => 'C',
        '/ñ/' => 'n',
        '/Ñ/' => 'N'
    );

   // $string = preg_replace(array_keys($acentos), array_values($acentos), $string);

    // Remove caracteres especiais
    $string = preg_replace('/[^a-zA-Z0-9 \'-]/', '', $string);
    return $string;

}

}
