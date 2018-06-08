<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/6/7 0007
 * Time: 14:59
 */

namespace App\Models;


use http\Env\Request;

class Card extends BaseModel
{
    public function groupon()
    {
        return $this->hasOne('App\Models\GrouponExtraInfo','card_id','id');
    }

    public function cash()
    {
        return $this->hasOne('App\Models\CashExtraInfo','card_id','id');
    }

    public function discountCoupon()
    {
        return $this->hasOne('App\Models\DiscountCouponExtraInfo','card_id','id');
    }

    public function generalCoupon()
    {
        return $this->hasOne('App\Models\GeneralCouponExtraInfo','card_id','id');
    }

    public function gift()
    {
        return $this->hasOne('App\Models\GiftCouponExtraInfo','card_id','id');
    }




}
