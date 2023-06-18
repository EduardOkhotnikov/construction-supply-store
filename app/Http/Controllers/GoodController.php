<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Models\Producer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class GoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = Good::$defaultFilters;

        if (\count($request->query()) > 0) {
            $filters = $request->query();
        }
        return view("shop.list",[
            'goods' => Good::getByParams($filters),
            'fieldsToSort' => Good::$fieldsToSort,
            'filters' => $filters
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('shop.create',[
            'producers'=>Producer::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $good = new Good();
        $good->name = $request->input('name');
        $good->creation_date = $request->input('creation_date');
        $good->expiration_date = $request->input('expiration_date');
        $good->price = $request->input('price');
        $good->img_link = $request->input('img_link');
        $good->producer()->associate(Producer::find($request->input('producer')));
        $good->save();

        return Redirect::to('/shop/goods');
    }

    /**
     * Display the specified resource.
     */
    public function show(Good $good)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        return view('shop.edit', [
            'good' => Good::find($id),
            'producers'=>Producer::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Good $good) : RedirectResponse
    {
        $good->name = $request->input('name');
        $good->creation_date = $request->input('creation_date');
        $good->expiration_date = $request->input('expiration_date');
        $good->price = $request->input('price');
        $good->img_link = $request->input('img_link');
        $good->producer()->associate(Producer::find($request->input('producer')));
        $good->save();

        return Redirect::to('/shop/goods');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id):RedirectResponse
    {
        Good::destroy($id);
        return Redirect::to('/shop/goods');
    }

    public function reviewGood(int $id)
    {
        $good = Good::find($id);
        return view('shop.review',[
            'good' => $good,
            'fullPrice' => $good->price * $good->count
        ]);
    }
}
