<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class AllController extends Controller
{
    public function __construct()
    {
        // share cho tất cả view khi controller này được gọi
        View::share('a', 'Hello từ AllController');
    }
}