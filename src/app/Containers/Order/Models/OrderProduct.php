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
 * @mixin \Eloquent
 */
class OrderProduct extends Model
{
    protected $table="order_product";
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
}
