<?php
namespace NV\MiniFram\Form;

use NV\MiniFram\Session;

class CSRFField extends Field
{
    protected $session;

    public function __construct()
    {
        $this->value = md5(bin2hex(openssl_random_pseudo_bytes(6)));
        $this->session = new Session;
    }

    public function buildWidget()
    {
        $widget = '<input type="hidden" name="csrf" value="'.$this->value.'"><br>';
        if (!empty($this->errorMessage)) {
            $widget .= '<p class="alert alert-danger">'.$this->errorMessage.'</p>';
        }


        return $widget;
    }

    public function saveToken()
    {
        if ($this->session->attributeExists('csrf')) {
            $this->value = $this->session->getAttribute('csrf');
        }
        $this->session->setAttribute('csrf', $this->value);
    }
}
