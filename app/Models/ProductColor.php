<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductColor
 *
 * @property int $id
 * @property int $product_id
 * @property string $hex
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor whereHex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor whereProductId($value)
 * @mixin \Eloquent
 */
class ProductColor extends Model
{
    public $timestamps = false;

    protected $attributes = [
        'hex' => 'NULL'
    ];
}
