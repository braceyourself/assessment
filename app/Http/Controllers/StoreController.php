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

}
