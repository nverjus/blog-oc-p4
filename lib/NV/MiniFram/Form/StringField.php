<?php
namespace NV\MiniFram\Form;

class StringField extends Field
{
    protected $maxLength;

    public function buildWidget()
    {
        $widget = "";

        if (!empty($this->errorMessage)) {
            $widget .= '<p class="alert alert-danger">'.$this->errorMessage.'</p>';
        }
        $widget .= '<div class="row control-group">
                      <div class="form-group col-xs-12 floating-label-form-group controls">';

        $widget .= '<label>'.$this->label.'</label>';
        $widget .= '<input type="text" class="form-control" placeholder="'.$this->label.'"';

        if (!empty($this->value)) {
            $widget .= ' value="'.$this->value.'"';
        }
        if (!empty($this->maxLength)) {
            $widget .= ' maxlength="'.$this->maxLength.'"';
        }
        $widget .= ' name = "'.$this->name.'">';

        return $widget .= '</div></div>';
    }

    public function setMaxLength($maxLength)
    {
        $maxLength = (int) $maxLength;

        if ($maxLength <= 0) {
            throw new \InvalidArgumentException('The max length must be an intger greated than zero');
        }
        $this->maxLength = $maxLength;
    }

    public function getMaxLength()
    {
        return $this->maxLength;
    }
}
