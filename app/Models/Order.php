<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'po_number',
        'product_name',
        'product_size',
        'quantity',
        'price',
        'subtotal',
        'delivery_fee',
        'total_amount',
        'custom_message',
        'delivery_address',
        'delivery_distance',
        'pickup_date',
        'pickup_time',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'delivery_fee' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'delivery_distance' => 'decimal:2',
        'pickup_date' => 'date',
    ];

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Generate order number.
     */
    public static function generateOrderNumber()
    {
        return 'DNT' . date('Ymd') . str_pad(self::whereDate('created_at', today())->count() + 1, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Generate PO number.
     */
    public static function generatePoNumber()
    {
        $sequence = 1;

        do {
            $poNumber = str_pad((string) $sequence, 4, '0', STR_PAD_LEFT);
            $sequence++;

            // Prevent infinite loop if all 4-digit values are occupied.
            if ($sequence > 9999) {
                throw new \RuntimeException('Nomor PO 4 digit sudah habis.');
            }
        } while (self::where('po_number', $poNumber)->exists());

        return $poNumber;
    }

    /**
     * Calculate delivery fee based on distance.
     */
    public static function calculateDeliveryFee($distance)
    {
        return ceil($distance / 4) * 10000; // Rp 10,000 per 4km
    }
}
