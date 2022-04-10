<?php


namespace App\Helpers\ApiResponse\Json\Senders;


class SendData extends Sender
{
    protected $data;

    public function __construct($data) {
        $this->response["data"] = $data;
        $this->statusNumber = 'S201';
        $this->code = 201;
    }


}
