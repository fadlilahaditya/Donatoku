<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = [
            [
                'name' => 'Tart Hias Leleh Coklat',
                'image' => 'tart-coklat.jpg',
                'price' => 'Mulai dari Rp 105.000',
                'category' => 'Kue Tart'
            ],
            [
                'name' => 'Fudgie Brownies',
                'image' => 'brownies.jpg',
                'price' => 'Mulai dari Rp 43.000',
                'category' => 'Brownies'
            ],
            [
                'name' => 'Bento Cake',
                'image' => 'bento-cake.jpg',
                'price' => 'Rp 55.000',
                'category' => 'Bento Cake'
            ],
            [
                'name' => 'Lekker Holland',
                'image' => 'lekker-holland.jpg',
                'price' => 'Rp 40.000',
                'category' => 'Lekker Holland'
            ],
        ];

        return view('welcome', compact('featuredProducts'));
    }

    public function trackOrderByPo(Request $request)
    {
        $order = null;
        $poNumber = null;

        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'po_number' => 'required|string|max:30',
            ]);

            $poNumber = strtoupper(trim($validated['po_number']));

            $order = Order::whereRaw('UPPER(po_number) = ?', [$poNumber])->first();
        }

        return view('order-track', compact('order', 'poNumber'));
    }
}