<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\View\View;

class SiteController extends Controller
{

    /**
     * Output list of all products
     *
     * @return View
     */
    public function index()
    {
        $products = Product::all();

        return response()->view(
            'index',
            [
                'products' => $products
            ]
        );
    }
}
