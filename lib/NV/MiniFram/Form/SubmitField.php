<?php
namespace NV\MiniFram\Form;

class SubmitField extends Field
{
    protected $classes = "btn btn-primary";

    public function buildWidget()
    {
        $widget = '<div>
                <div class="form-group col-xs-12">';

        $widget .=  '<button type="submit"';

        if (!empty($this->classes)) {
            $widget .= ' class="'.$this->classes.'"';
        }
        $widget .= '>';

        if (empty($this->value)) {
            throw new \InvalidArgumentException('SubmitField must have a value');
        }
        $widget .= $this->value.'</button>';


        return $widget .= '</div></div>';
    }

    public function setClasses($classes)
    {
        if (!is_string($classes)) {
            throw new \InvalidArgumentException('Classes must be a string');
        }
        $this->classes = $classes;
    }
}
