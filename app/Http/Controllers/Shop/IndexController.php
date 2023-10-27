<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop;

class IndexController extends Controller
{
    public function __invoke()
    {
        return Shop::all();
    }
}
