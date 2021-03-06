<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Stock as Stock;
use App\Entities\Brand as Brand;
use App\Entities\BottleType as BottleType;
use App\Entities\Soda as Soda;

class SodaController extends Controller
{
    private $model;
    private $brandModel;
    private $bottleTypeModel;

    public function __construct(Soda $model, Brand $brandModel, BottleType $bottleTypeModel, Soda $sodaModel)
    {
        $this->model = $model;
        $this->brandModel = $brandModel;
        $this->bottleTypeModel = $bottleTypeModel;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sodaItems = $this->model->getAll();
        return view('soda.index', compact('sodaItems'));
    }

    public function store()
    {
        $brands = $this->brandModel->pluck('Name', 'Id');
        $bottleTypes = $this->bottleTypeModel->pluck('Name', 'Id');
        return view('soda.store', ['brands' => $brands, 'bottleTypes' => $bottleTypes]);
    }

    public function create(Request $request){
        $statusCreating = $this->model->createSoda($request->all());

        if($statusCreating){
            \Session::flash('flash_message',[
                'msg'=>"Refrigerante adicionado com Sucesso!",
                'class'=>"alert-success"
            ]);
        } else {
            \Session::flash('flash_message',[
                'msg'=>"Refrigerante já foi cadastrado!",
                'class'=>"alert-danger"
            ]);
        }

        return redirect()->route('soda.store');
    }

    public function edit($sodaId)
    {
        $soda = $this->model->find($sodaId);
        $brands = $this->brandModel->pluck('Name', 'Id');
        $bottleTypes = $this->bottleTypeModel->pluck('Name', 'Id');
        return view('soda.edit', compact('soda', 'brands', 'bottleTypes'));
    }

    public function update(Request $request, $sodaId)
    {
        $this->model->updateSoda($sodaId, $request->except(['_token']));

        \Session::flash('flash_message',[
            'msg'=>"Refrigerante editado com Sucesso!",
            'class'=>"alert-success"
        ]);

        return redirect()->route('soda.index');
    }

    public function deleteById($sodaId){
        $soda = $this->model->deleteSodaById($sodaId);

        \Session::flash('flash_message',[
            'msg'=>"Refrigerante deletado com Sucesso!",
            'class'=>"alert-success"
        ]);

        return redirect()->route('soda.index');
    }

    public function deleteByArrayId($id){
        $this->model->deleteSodaById($id);

        exit;
    }
}
