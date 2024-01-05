<?php

namespace API\EmailSender\Core;

abstract class TemplateModel
{
    public $title;
    public $content;
    public $subtitle;
    public $base_url;
    public $logo_url;
    public $logo_alt;
    public $preheader;
    public $logo_width;
    public $logo_height;
    public $button_text;
    public $button_link;
    public $copyright_text;
    public $copyright_link;
    public $button_bg_color;
    public $button_text_color;
    public $signature;
    public $subfooter;
    public $footer;

    public function __construct($data) {
        $this->title = $data['title'] ?? '';
        $this->content = $data['content'] ?? '';
        $this->subtitle = $data['subtitle'] ?? '';
        $this->base_url = $data['base_url'] ?? '';
        $this->logo_url = $data['logo_url'] ?? '';
        $this->logo_alt = $data['logo_alt'] ?? '';
        $this->preheader = $data['subject'] ?? '';
        $this->logo_width = $data['logo_width'] ?? '250';
        $this->logo_height = $data['logo_height'] ?? '80';
        $this->button_text = $data['button_text'] ?? '';
        $this->button_link = $data['button_link'] ?? '#';
        $this->copyright_text = $data['copyright_text'] ?? '';
        $this->copyright_link = $data['copyright_link'] ?? '#';
        $this->button_bg_color = $data['button_bg_color'] ?? '#1b95c5';
        $this->button_text_color = $data['button_text_color'] ?? '#ffffff';
        $this->signature = $data['signature'] ?? '';
        $this->subfooter = $data['subfooter'] ?? '';
        $this->footer = $data['footer'] ?? '';
    }

    public function displayLogo() {
        return isset($this->logo_url) && !empty($this->logo_url);
    }

    public function displayButton() {
        return isset($this->button_text) && !empty($this->button_text);
    }
}