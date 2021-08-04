<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderDetail
 *
 * @property int $id
 * @property int $qty
 * @property string $price
 * @property string $price_after_tax
 * @property int $tax
 * @property string|null $total_price
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail wherePriceAfterTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereTotalPrice($value)
 * @mixin \Eloquent
 * @property int $order_id
 * @property int $product_id
 * @property int|null $product_color_id
 * @property int|null $product_size_id
 * @property-read \App\Models\Product|null $product
 * @property-read \App\Models\ProductColor|null $productColor
 * @property-read \App\Models\ProductSize|null $productSize
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereProductColorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereProductSizeId($value)
 */
class OrderDetail extends Model
{
    public $timestamps = false;

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function productSize(){
        return $this->belongsTo(ProductSize::class);
    }

    public function productColor(){
        return $this->belongsTo(ProductColor::class);
    }
}
