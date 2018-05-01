<?php
namespace NV\MiniFram\Form;

class TextField extends Field
{
    public function buildWidget()
    {

          <label>Message</label>
          <textarea rows="5" class="form-control" placeholder="Message" id="message" required="required" data-validation-required-message="Please enter a message."></textarea>
          <p class="help-block text-danger"></p>
        </div>
      </div>
      <br>
        $widget = "";
        if (!empty($this->errorMessage)) {
            $widget .= '<p class="alert alert-danger">'.$this->errorMessage.'</p>';
        }
        $widget .= '<div class="row control-group">
                      <div class="form-group col-xs-12 floating-label-form-group controls">';

        $widget .= '<label>'.$this->label.'</label>';

        $widget .= '<textarea rows="5" class="form-control" placeholder="'.$this->label.'" id="'.$this->name.'" name="'.$this->name.'">';
        if (!empty($this->value)) {
            $widget .= $this->value;
        }
        return $widget .= '</textarea></div></div>';
    }
}
