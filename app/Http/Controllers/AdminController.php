<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Menu;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalCustomers = User::where('user_type',
         'customer')->count();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_amount') ?? 0;
        $recentOrders = Order::with('user')->latest()
        ->take(5)->get();

        return view('admin.dashboard', compact('totalCustomers'
        , 'totalOrders', 'totalRevenue', 'recentOrders'));
    }

    public function customers()
    {
        $customers = User::where('user_type', 
        'customer')->latest()->paginate(10);
        return view('admin.customers', compact('customers'));
    }

    public function orders(Request $request)
    {
        $query = Order::with('user')->latest();

        // Filter by status if provided
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(20);

        // Get counts for tabs
        $allCount = Order::count();
        $pendingCount = Order::where('status', 'pending')->count();
        $completedCount = Order::where('status', 'delivered')->count();
        $cancelledCount = Order::where('status', 'cancelled')->count();

        return view('admin.orders', compact('orders',
         'allCount', 'pendingCount', 'completedCount', 'cancelledCount'));
    }

    public function products()
    {
        // Product management will be expanded later
        $products = [
            'kue-tart' => [
                'name' => 'Kue Tart',
                'items' => ['Kue Ulang Tahun', 'Kue Anniversary', 'Kue Wedding']
            ],
            'brownies' => [
                'name' => 'Brownies',
                'items' => ['Brownies Original', 'Brownies Keju', 'Brownies Coklat']
            ],
            'bento-cake' => [
                'name' => 'Bento Cake',
                'items' => ['Mini Cake', 'Birthday Cake', 'Love Cake']
            ],
            'lekker-holland' => [
                'name' => 'Lekker Holland',
                'items' => ['Cheese Cake', 'Strawberry Cake', 'Chocolate Cake']
            ]
        ];
        return view('admin.products', compact('products'));
    }
    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,delivered,cancelled'
        ]);
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);
        $statusText = [
            'delivered' => 'selesai',
            'cancelled' => 'dibatalkan',
            'pending' => 'pending'
        ];
        return redirect()->back()->with('success', 'Pesanan berhasil ditandai sebagai '
         . $statusText[$request->status] . '!');
    }
    // Menu CRUD Methods
    public function menus()
    {
        $menus = Menu::latest()->get();
        return view('admin.menus', compact('menus'));
    }
    public function storeMenu(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image_url' => 'nullable|string',
        ]);

        Menu::create($request->all());

        return redirect()->route('admin.menus')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function updateMenu(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image_url' => 'nullable|string',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->update($request->all());

        return redirect()->route('admin.menus')->with('success', 'Menu berhasil diperbarui!');
    }

    public function destroyMenu($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('admin.menus')->with('success', 'Menu berhasil dihapus!');
    }
}
