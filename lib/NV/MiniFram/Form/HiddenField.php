<?php
namespace NV\MiniFram\Form;

class HiddenField extends Field
{
    protected $session;



    public function buildWidget()
    {
        $widget = '<input type="hidden" name="'.$this->name.'"';
        if (!empty($this->value)) {
            $widget .= 'value="'.$this->value.'"';
        }
        $widget .= '>';

        return $widget;
    }
}
