<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/5/30 0030
 * Time: 13:55
 */

namespace App\Http\Controllers\WeChatPush;

use App\Models\MerchantCheckResult;
use App\Models\PoiCheckNotify;

class EventMessageHandler extends PushHandler
{

    public function reply()
    {
        if(array_key_exists('Event',$this->push_message)) {

            switch ($this->push_message['Event']) {
                case 'card_merchant_check_result':
                    return $this->handleCardMerchantCheckResult();
                    break;
                case 'poi_check_notify':
                    return $this->handlePoiCheckNotify();
                    break;
                default:
                    return "收到事件消息";
                    break;
            }
        }
        return "收到事件消息";


    }

//    接收子商户审核事件
    public function handleCardMerchantCheckResult()
    {
        $merchant = new MerchantCheckResult();
        $merchant->handleCheckInfo($this->push_message);

        return "收到子商户审核";
    }

//    接收门店审核事件
    public function handlePoiCheckNotify()
    {
        $poi_notify = new PoiCheckNotify();
        $me = $poi_notify->handleCheckNotify($this->push_message);

        return "收到门店审核通知";

    }

}
