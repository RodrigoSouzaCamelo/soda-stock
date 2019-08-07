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

    public function __construct(Brand $model)
    {
        $this->model = $model;
        $this->middleware('auth');
    }

    public function index()
    {
        $brands = $this->model->paginate(10);
        return view('brand.index', compact('brands'));
    }

    public function store()
    {
        return view('brand.store');
    }

    public function create(Request $request){
        $this->model->create($request->all());
        
        \Session::flash('flash_message',[
            'msg'=>"Marca adicionada com Sucesso!",
            'class'=>"alert-success"
        ]);
        
        return redirect()->route('brand.store');
    }

    public function edit($brandId)
    {
        $brand = $this->model->find($brandId);
        return view('brand.edit', compact('brand'));
    }

    public function update(Request $request, $brandId)
    {
        $this->model->updateBrand($brandId, $request->except(['_token']));
        
        \Session::flash('flash_message',[
            'msg'=>"Marca editada com Sucesso!",
            'class'=>"alert-success"
        ]);
        
        return redirect()->route('brand.index');
    }

    public function deleteById($brandId){
        $brand = $this->model->deleteBrandById($brandId);
        
        \Session::flash('flash_message',[
            'msg'=>"Marca deletada com Sucesso!",
            'class'=>"alert-success"
        ]);
        
        return redirect()->route('brand.index');
    }

    public function deleteByArrayId($id){
        $this->model->deleteBrandById($id);
        
        exit;
    }
}
