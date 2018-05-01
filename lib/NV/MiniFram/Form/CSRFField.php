<?php
namespace NV\MiniFram\Form;

class CSRFField extends Field
{
    public function __construct()
    {
        $this->value = md5(bin2hex(openssl_random_pseudo_bytes(6)));
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
        $_SESSION['csrf'] = $this->value;
    }
}
