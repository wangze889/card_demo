<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/5/30 0030
 * Time: 13:55
 */

namespace App\Http\Controllers\WeChatPush;

class EventMessageHandler extends PushHandler
{

    public function reply()
    {
        if(array_key_exists('Event',$this->push_message)) {

            switch ($this->push_message['Event']) {
                case 'card_merchant_check_result':
                    return $this->handleCardMerchantCheckResult();
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

    }

}
