<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'booking_trx_id',
        'city',
        'post_code',
        'address',
        'quantity',
        'sub_total_amount',
        'grand_total_amount',
        'discount_amount',
        'is_paid',
        'product_id',
        'product_size',
        'promo_code_id',
        // 'proof',
    ];

    public static function generateUniqueTrxId() 
    {
        $prefix = 'ORD-';
        do {
            $randomString = $prefix . mt_rand(100000, 999999); // GRBH-19
        } while (self::where('booking_trx_id', $randomString)->exists());

        return $randomString;
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function promoCode(): BelongsTo
    {
        return $this->belongsTo(PromoCode::class, 'promo_code_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
