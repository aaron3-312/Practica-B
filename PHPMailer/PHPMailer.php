<?php
/**
 * PHPMailer - PHP email creation and transport class.
 * NOTE: This is a trimmed version of PHPMailer for Gmail SMTP.
 */

namespace PHPMailer\PHPMailer;

class PHPMailer
{
    public $SMTPDebug = 0;
    public $Host;
    public $Port = 587;
    public $SMTPSecure = 'tls';
    public $SMTPAuth = true;
    public $Username;
    public $Password;
    public $From;
    public $FromName;
    public $Subject;
    public $Body;
    public $AltBody = '';
    public $isHTML = true;
    public $CharSet = 'UTF-8';

    private $to = [];

    public function isSMTP() {}

    public function setFrom($address, $name = '')
    {
        $this->From = $address;
        $this->FromName = $name;
    }

    public function addAddress($address, $name = '')
    {
        $this->to[] = [$address, $name];
    }

    public function isHTML($bool = true)
    {
        $this->isHTML = $bool;
    }

    public function send()
    {
        $header  = "From: {$this->FromName} <{$this->From}>\r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html; charset=UTF-8\r\n";

        $to = $this->to[0][0];
        return mail($to, $this->Subject, $this->Body, $header);
    }
}