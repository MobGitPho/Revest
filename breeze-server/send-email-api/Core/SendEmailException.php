<?php

namespace API\EmailSender\Core;

class SendEmailException extends \Exception
{
    public function errorMessage()
    {
        return "The message could not be sent. Mail error:: {$this->getMessage()}";
    }
}
