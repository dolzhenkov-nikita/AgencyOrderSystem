<?php

namespace App\Containers\Order\Models;

use App\Containers\Product\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read \App\Containers\Order\Models\Order|null $order
 * @property-read Product|null $product
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderProduct query()
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $quantity
 * @property int $total_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderProduct whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderProduct whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderProduct whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrderProduct extends Model
{
    protected $table = "order_product";
    protected $fillable = [
        "order_id",
        "product_id",
        "quantity",
        "total_price",
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getTotalPrice(): int
    {
        return $this->total_price;
    }

    public function setTotalPrice(int $total_price): void
    {
        $this->total_price = $total_price;
    }

}
