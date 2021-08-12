<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CartDetail
 *
 * @property int $id
 * @property int|null $cart_id
 * @property int|null $product_id
 * @property int|null $product_color_id
 * @property int|null $product_size_id
 * @property int|null $qty
 * @property string|null $price
 * @property string|null $total_price
 * @property \App\Models\Product|null $product
 * @property \App\Models\ProductColor|null $productColor
 * @property \App\Models\ProductSize|null $productSize
 * @method static \Illuminate\Database\Eloquent\Builder|CartDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CartDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CartDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|CartDetail whereCartId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartDetail wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartDetail whereProductColorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartDetail whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartDetail whereProductSizeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartDetail whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartDetail whereTotalPrice($value)
 * @mixin \Eloquent
 */
class CartDetail extends Model
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
    }}
