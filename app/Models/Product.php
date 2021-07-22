<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $SKU
 * @property string $name
 * @property string $short_name
 * @property string $price
 * @property string $fake_price
 * @property string $avatar_url
 * @property int $hidden
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereAvatarUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereFakePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSKU($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereShortName($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    public $timestamps = false;

    protected $attributes = [
        'avatar_url' => '/resources/img/default-avatar.png'
    ];

    public function colors()
    {
        return $this->hasMany(ProductColor::class);
    }
}
