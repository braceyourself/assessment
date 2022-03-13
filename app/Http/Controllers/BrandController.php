<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Brand::class, 'brand');
    }

    public function index(Request $request)
    {
        return Brand::query()->paginate();
    }

    public function show(Request $request, Brand $brand)
    {
        return $brand;
    }

}
