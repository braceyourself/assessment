<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Store::class, 'store');
    }

    public function index(Request $request)
    {
        return $request->user()->stores()->paginate();
    }

    public function show(Request $request, Store $store)
    {
        return $store;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(Store $store)
    {
        //
    }

    public function update(Request $request, Store $store)
    {
        //
    }

    public function destroy(Store $store)
    {
        //
    }

}
