<?php

namespace App\Http\Controllers\Admin;
use App\Models\Supplier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuppliarsController extends Controller
{
    public function __invoke()
    {
        return view('admin.suppliars');
    }
}
