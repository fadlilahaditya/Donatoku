<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)
        ->latest()->take(5)->get();
        $totalOrders = Order::where('user_id', $user->id)
        ->count();
        $pendingOrders = Order::where('user_id', $user->id)
        ->where('status', 'pending')->count();

        return view('customer.dashboard', compact('orders', 
        'totalOrders', 'pendingOrders'));
    }

    public function orders()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)
        ->latest()->paginate(10);

        return view('customer.orders', compact('orders'));
    }

    public function createOrder()
    {
        return view('customer.create-order');
    }

    public function getAvailablePickupSlots(Request $request)
    {
        $date = $request->query('date');
        if (!$date) {
            return response()->json(['error' => 'Date is required'], 400);
        }

        // Generate time slots from 08:00 to 16:00 with 30-minute intervals
        $slots = [];
        $startTime = strtotime('08:00');
        $endTime = strtotime('16:00');

        for ($time = $startTime; $time <= $endTime; $time += 1800) { // 30 minutes = 1800 seconds
            $timeString = date('H:i', $time);

            // Count existing orders for this date and time
            $existingOrders = Order::where('pickup_date', $date)
                ->where('pickup_time', $timeString)
                ->where('status', '!=', 'cancelled')
                ->count();

            $slots[] = [
                'time' => $timeString,
                'formatted' => date('H:i', $time),
                'available' => $existingOrders < 3,
                'current_orders' => $existingOrders
            ];
        }

        return response()->json($slots);
    }

    private function getValidPickupTimes()
    {
        $times = [];
        $startTime = strtotime('08:00');
        $endTime = strtotime('16:00');

        for ($time = $startTime; $time <= $endTime; $time += 1800) { // 30 minutes
            $times[] = date('H:i', $time);
        }

        return $times;
    }

    public function storeOrder(Request $request)
    {
        // Validation rules based on delivery method
        $rules = [
            'product_name' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'custom_message' => 'nullable|string',
            'delivery_method' => 'required|in:pickup,delivery',
            'pickup_date' => 'required_if:delivery_method,pickup|nullable|date|after_or_equal:today',
            'pickup_time' => 'required_if:delivery_method,pickup|nullable|date_format:H:i|in:' . implode(',', $this->getValidPickupTimes()),
            'delivery_date' => 'required_if:delivery_method,delivery|nullable|date|after_or_equal:today',
            'delivery_time' => 'required_if:delivery_method,delivery|nullable|date_format:H:i',
        ];

        if ($request->delivery_method === 'delivery') {
            $rules['delivery_address'] = 'required|string';
        }

        $request->validate($rules);

        // Additional validation for pickup slots
        if ($request->delivery_method === 'pickup') {
            $existingOrders = Order::where('pickup_date', $request->pickup_date)
                ->where('pickup_time', $request->pickup_time)
                ->where('status', '!=', 'cancelled')
                ->count();

            if ($existingOrders >= 3) {
                return back()->withErrors(['pickup_time' => 'Slot waktu ini sudah penuh. Silakan pilih waktu lain.'])->withInput();
            }
        }

        // Daftar harga produk (digunakan jika server perlu menghitung ulang)
        $prices = [
            'Kue Tart Coklat' => 150000,
            'Kue Tart Strawberry' => 175000,
            'Kue Tart Cheese' => 160000,
            'Kue Tart Red Velvet' => 180000,
            'Brownies Coklat Original' => 45000,
            'Brownies Kacang' => 50000,
            'Brownies Keju' => 55000,
            'Brownies Cream Cheese' => 60000,
            'Bento Cake Birthday' => 35000,
            'Bento Cake Love' => 38000,
            'Bento Cake Character' => 42000,
            'Stroopwafel' => 25000,
            'Speculoos' => 30000,
            'Oliebollen' => 35000,
            'Poffertjes' => 40000,
        ];

        // Jika klien mengirimkan nilai yang telah dihitung (subtotal, delivery_fee, total_amount),
        $clientSubtotal = $request->input('subtotal');
        $clientDeliveryFee = $request->input('delivery_fee');
        $clientTotal = $request->input('total_amount');

        $deliveryDistance = 0;
        $deliveryAddress = null;
        $scheduledDate = $request->pickup_date;
        $scheduledTime = $request->pickup_time;

        // Gunakan nilai dari klien hanya jika nilainya numerik dan lebih besar dari 0.
        if ((is_numeric($clientSubtotal) && $clientSubtotal >
         0) || (is_numeric($clientTotal) && $clientTotal > 0)) {
            $subtotal = (float) $clientSubtotal;
            $deliveryFee = is_numeric($clientDeliveryFee) ? (float) $clientDeliveryFee : 0;
            $totalAmount = (float) $clientTotal;

            // Usahakan mengisi kolom `price` agar tidak 0: jika hanya satu produk dipilih dan ada di daftar harga,
            // ambil harga itu. Jika tidak, set price sebagai subtotal dibagi quantity (fallback).
            $price = 0;
            if (isset($prices[$request->product_name])) {
                $price = $prices[$request->product_name];
            } elseif ($request->quantity > 0) {
                $price = $subtotal / $request->quantity;
            }

            if ($request->delivery_method === 'delivery') {
                $deliveryDistance = 0;
                $deliveryFee = 8000;
                $deliveryAddress = $request->delivery_address;
                $scheduledDate = $request->delivery_date;
                $scheduledTime = $request->delivery_time;
            }
        } else {
            // Fallback ke perhitungan server-side (lama)
            $productSelect = $request->product_name;
            $price = $prices[$productSelect] ?? 0;
            $subtotal = $price * $request->quantity;

            // Calculate delivery fee: Rp 2,500 per km
            $deliveryFee = 0;
            if ($request->delivery_method === 'delivery') {
                $deliveryDistance = 0;
                $deliveryFee = 8000;
                $deliveryAddress = $request->delivery_address;
                $scheduledDate = $request->delivery_date;
                $scheduledTime = $request->delivery_time;
            }

            $totalAmount = $subtotal + $deliveryFee;
        }

        // Always generate PO number automatically on order creation.
        $poNumber = Order::generatePoNumber();

        Order::create([
            'user_id' => Auth::id(),
            'po_number' => $poNumber,
            'product_name' => $request->product_name,
            'product_size' => $request->delivery_method === 'pickup' ? 'Pickup' : 'Delivery',
            'quantity' => $request->quantity,
            'price' => $price,
            'subtotal' => $subtotal,
            'delivery_fee' => $deliveryFee ?? 0,
            'total_amount' => $totalAmount,
            'custom_message' => $request->custom_message,
            'delivery_address' => $deliveryAddress ?? 'Ambil di Toko',
            'delivery_distance' => $deliveryDistance,
            'pickup_date' => $scheduledDate,
            'pickup_time' => $scheduledTime,
            'status' => 'pending'
        ]);

        // Jika user memilih konfirmasi via WhatsApp, buat URL wa.me dan kirimkan ke session
        if ($request->input('payment_method') === 'whatsapp') {
            // Bangun pesan singkat berdasarkan data request
            $productsText = '';
            // `product_name` di form adalah gabungan nama produk (dipisah koma)
            if ($request->product_name) {
                $parts = explode(',', $request->product_name);
                foreach ($parts as $p) {
                    $productsText .= '- ' . trim($p) . "%0A";
                }
            }

            $message = "Halo Donatoku,%0ASaya ingin memesan:%0A";
            $message .= $productsText;
            $message .= "%0ASubtotal: Rp " . number_format($subtotal, 0, ',', '.') . "%0A";
            $message .= "Biaya Pengiriman: Rp " . number_format($deliveryFee ?? 0, 0, ',', '.') . "%0A";
            $message .= "Total: Rp " . number_format($totalAmount, 0, ',', '.') . "%0A%0A";

            if ($request->delivery_address) {
                $message .= "Alamat: " . $request->delivery_address . "%0A";
            }
            if ($request->custom_message) {
                $message .= "Catatan: " . $request->custom_message . "%0A";
            }

            $userName = Auth::user() ? Auth::user()->name : null;
            if ($userName) {
                $message .= "%0ANama: " . $userName;
            }

            // Nomor WhatsApp Donatoku (sudah diubah sebelumnya), gunakan format internasional tanpa +
            $waNumber = '6285708123616';
            $waUrl = "https://wa.me/{$waNumber}?text={$message}";

            return redirect()->route('home')
                ->with('success', 'Pesanan berhasil dibuat! Silakan konfirmasi pesanan Anda via WhatsApp.')
                ->with('whatsapp_url', $waUrl);
        }

        return redirect()->route('home')->with('success', 'Pesanan berhasil dibuat! Silakan tunggu konfirmasi dari admin.');
    }

    public function profile()
    {
        return view('customer.profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string'
        ]);

        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        if (! $user) {
            return redirect()->route('login');
        }

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}
