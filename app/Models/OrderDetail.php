<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderDetail
 *
 * @property int $id
 * @property int $id_order
 * @property int $id_product
 * @property int|null $id_product_color
 * @property int|null $id_product_size
 * @property int $qty
 * @property string $price
 * @property string $price_after_tax
 * @property int $tax
 * @property string|null $total_price
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereIdOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereIdProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereIdProductColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereIdProductSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail wherePriceAfterTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereTotalPrice($value)
 * @mixin \Eloquent
 */
class OrderDetail extends Model
{
    public $timestamps = false;

    use HasFactory;
}
