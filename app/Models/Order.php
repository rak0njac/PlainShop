<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property string $customer_name
 * @property string $customer_address
 * @property string $customer_town
 * @property int $customer_postcode
 * @property string $customer_phone
 * @property string $customer_email
 * @property string $status
 * @property string|null $tracking_nr
 * @property string $datetime
 * @property string|null $subtotal_price
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCustomerAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCustomerEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCustomerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCustomerPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCustomerPostcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCustomerTown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereSubtotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTrackingNr($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderDetail[] $details
 * @property-read int|null $details_count
 */
class Order extends Model
{
    public $timestamps = false;

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function calculateSubtotal(){
        $order = $this;
        $sum = 0;
        foreach($order->details as $detail){
            $sum += $detail->total_price;
        }
        $order->subtotal_price = $sum;
        $order->save(); //TODO: Check if needed
    }
}
