<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Stock as Stock;
use App\Entities\Brand as Brand;
use App\Entities\BottleType as BottleType;
use App\Entities\Soda as Soda;

class BrandController extends Controller
{
    private $model;
    private $brandModel;
    private $bottleTypeModel;

    public function __construct(Brand $model, Brand $brandModel, BottleType $bottleTypeModel, Soda $sodaModel)
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
        $brands = $this->model->paginate(10);
        return view('brand.index', compact('brands'));
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
}
