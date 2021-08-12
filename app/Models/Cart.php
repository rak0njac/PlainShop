<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Cart
 *
 * @property int $id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CartDetail[] $details
 * @property-read int|null $details_count
 * @method static \Illuminate\Database\Eloquent\Builder|Cart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereId($value)
 * @mixin \Eloquent
 */
class Cart extends Model
{
    public $timestamps = false;

    public function details()
    {
        return $this->hasMany(CartDetail::class);
    }}
