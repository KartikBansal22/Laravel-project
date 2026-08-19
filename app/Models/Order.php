<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class Order extends Model
{
    use HasFactory;


    public const STATUS_PENDING   = 'pending';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_PACKED    = 'packed';
    public const STATUS_SHIPPED   = 'shipped';
    public const STATUS_DELIVERED = 'delivered';
    public const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'user_id',
        'status',
        'total_amount',
        'shipping_address',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    
    public static function allowedTransitions(): array
    {
        return [
            self::STATUS_PENDING   => [self::STATUS_CONFIRMED, self::STATUS_CANCELLED],
            self::STATUS_CONFIRMED => [self::STATUS_PACKED, self::STATUS_CANCELLED],
            self::STATUS_PACKED    => [self::STATUS_SHIPPED],
            self::STATUS_SHIPPED   => [self::STATUS_DELIVERED],
            self::STATUS_DELIVERED => [],
            self::STATUS_CANCELLED => [],
        ];
    }

    public function canTransitionTo(string $newStatus): bool
    {
        return in_array($newStatus, self::allowedTransitions()[$this->status] ?? [], true);
    }
    public function cancelAndRestock(): void
{
    DB::transaction(function () {
        foreach ($this->items as $item) {
            Product::where('id', $item->product_id)
                ->lockForUpdate()
                ->increment('stock_quantity', $item->quantity);
        }

        $this->update(['status' => self::STATUS_CANCELLED]);
    });
}
}