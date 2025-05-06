<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(){
        // ambil semua data transaksi
        $transactions = Transaction::all();

        // kembalikan ke view
        return view('superadmin.transaksi', compact('transactions'));
    }

    public function listTransaction(){
        // ambil data transaksi dari cafe
        $transactions = Transaction::where('cafe_id', Auth::id())->get();
        // kembalikan ke view
        return view('cafe.transaksi', compact('transactions'));
    }
}
