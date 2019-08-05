<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Stock as Stock;
use App\Entities\Brand as Brand;
use App\Entities\BottleType as BottleType;
use App\Entities\Soda as Soda;

class StockController extends Controller
{
    private $model;
    private $brandModel;
    private $bottleTypeModel;

    public function __construct(Stock $model, Brand $brandModel, BottleType $bottleTypeModel, Soda $sodaModel)
    {
        $this->model = $model;
        $this->brandModel = $brandModel;
        $this->bottleTypeModel = $bottleTypeModel;
        $this->sodaModel = $sodaModel;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $stock_items = $this->model->getAvailableStockItems();
        return view('stock.index', compact('stock_items'));
    }

    public function store()
    {
        $sodas = $this->sodaModel->getAll();
        return view('stock.store', compact('sodas'));
    }

    public function create(Request $request){
        $this->sodaModel->createSoda($request->all());
        return redirect()->route('stock.store');
    }

    public function addSodaInStock($sodaId)
    {
        $sodas = $this->model->addSodaInStock($sodaId);

        \Session::flash('flash_message',[
			'msg'=>"Refrigerante adicionado ao estoque com Sucesso!",
			'class'=>"alert-success"
        ]);

        return redirect()->route('stock.store');
    }
}
