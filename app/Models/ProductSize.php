<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductSize
 *
 * @property int $id
 * @property int $product_id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSize newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSize newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSize query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSize whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSize whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSize whereProductId($value)
 * @mixin \Eloquent
 */
class ProductSize extends Model
{
    public $timestamps = false;
}
