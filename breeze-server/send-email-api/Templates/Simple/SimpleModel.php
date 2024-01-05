<?php

namespace API\EmailSender\Templates\Simple;

class SimpleModel extends \API\EmailSender\Core\TemplateModel
{
    public $header_color;
    public $link_color;

    public function __construct($data)
    {
        parent::__construct($data);

        $this->header_color = $data['header_color'] ?? '#259ec0';
        $this->link_color = $data['link_color'] ?? '#1f5d8c';
    }
}
