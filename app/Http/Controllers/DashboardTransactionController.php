<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\TransactionDetail;

class DashboardTransactionController extends Controller
{
    public function index()
    {
        $sellTransactions = TransactionDetail::with(['transaction.user','product.galleries'])
                          ->whereHas('product', function($product){
                              $product->where('users_id', Auth::user()->id);
                          })->get();

        $buyTransactions = TransactionDetail::with(['transaction.user','product.galleries'])
                         ->whereHas('transaction', function($transaction){
                             $transaction->where('users_id', Auth::user()->id);
                         })->get();
        return view('pages.dashboard-transactions', compact('sellTransactions','buyTransactions'));
    }

    public function details()
    {
        $transaction = TransactionDetail::with(['transaction.user','product.galleries'])
                       ->findOrFail($id);
        return view('pages.dashboard-transaction-details', compact('transaction'));
    }
}
