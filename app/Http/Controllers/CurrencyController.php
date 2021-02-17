<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Http\Requests\CurrencyRequest;

class CurrencyController extends Controller
{
    public function index() {
        return view('currency.index');
    }

    public function create() {
        return view('currency.create');
    }

    public function store(CurrencyRequest $request) {
        $request->model->create($request->validated());
        return redirect()->route('currency.index');
    }

    public function edit(Currency $currency) {
        return view('currency.edit', ['currency' => $currency]);
    }

    public function update(Currency $currency, CurrencyRequest $request) {
        $request->model->update($request->validated());
        return redirect()->route('currency.index');
    }

    public function destroy(Currency $currency) {
        $currency->delete();
        return redirect()->route('currency.index');
    }
}
