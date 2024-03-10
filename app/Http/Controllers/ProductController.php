<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->get('search');

        $items = Products::where('name', 'like', '%' . $search . '%')->get();

        return response()->json($items);
    }

    public function get_product_details(Request $request)
    {
        $product_id = $request->get('product_id');

        $product = Products::find($request->id);

        return response()->json($product);
    }
}
