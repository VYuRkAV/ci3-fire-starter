<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php echo form_open('', array('role'=>'form')); ?>
    <div role="tabpanel">
    
        <ul class="nav nav-tabs" role="tablist">
            <?php foreach ($this->settings->idioms as $language_key => $language_name) : ?>
                <li role="presentation" class="<?php echo ($this->session->language == $language_key) ? 'active' : '' ?>"><a href="#<?php echo $language_key; ?>" role="tab" data-toggle="tab"><?php echo $language_name; ?></a></li>    
            <?php endforeach; ?> 
        </ul>
    
        <div class="tab-content">   
            <?php foreach ($this->settings->idioms as $language_key => $language_name) : ?>        
                <div role="tabpanel" class="tab-pane fade<?php echo ($language_key == $this->session->language) ? ' in active' : '' ?>" id="<?php echo $language_key; ?>">
                    <br />
                    <?php foreach ($contents as $content) : ?>
    
						<?php // prepare field settings
                        $field_data = array(
                            'id'    => $content['name'] . "_" . $language_key,
                            'name'  => $content['id'] . "[" . $language_key . "]",
                            'class' => "form-control" . (($content['show_editor']) ? " editor" : ""),
                            'value' => $content[$language_key]
                        );
           
                        switch ($content['input_size']) {
                            case "small":
                                $col_size = "col-sm-3";
                                break;
                            case "medium":
                                $col_size = "col-sm-6";
                                break;
                            case "large":
                                $col_size = "col-sm-9";
                                break;
                            default:
                                $col_size = "col-sm-6";
                        }
        
                        if ($content['input_type'] == 'textarea') {
                            $col_size = "col-sm-12";
                        }
                        ?>
        
                        <div class="row">
                            <div class="form-group <?php echo $col_size; ?><?php echo form_error($content['id'].$content['name'].'[value]') ? ' has-error' : ''; ?>">
                                <?php echo lang('pages ' . $content['page'] . ' label ' . $content['name'], $content['id'] . "[" . $language_key . "]", array('class'=>'control-label')); ?>
                                <?php if (strpos($content['validation'], 'required')) : ?>
                                    <span class="required">*</span>
                                <?php endif; ?>
        
                                <?php // render the correct input method
                                if ($content['input_type'] == 'input')
                                {
                                    echo form_input($field_data);
                                }
                                elseif ($content['input_type'] == 'textarea')
                                {
                                    echo form_textarea($field_data);
                                }
                                elseif ($content['input_type'] == 'radio')
                                {
                                    echo "<br />";
                                    foreach ($field_options as $value=>$label)
                                    {
                                        echo form_radio(array('name'=>$field_data['name'], 'id'=>$field_data['id'], 'value'=>$value, 'checked'=>(($value == $field_data['value']) ? 'checked' : FALSE)));
                                        echo $label;
                                    }
                                }
                                elseif ($content['input_type'] == 'dropdown')
                                {
                                    echo form_dropdown($field_data['name'], $field_options, $field_data['value'], 'id="' . $field_data['id'] . '" class="' . $field_data['class'] . '"');
                                }
                                elseif ($content['input_type'] == 'timezones')
                                {
                                    echo "<br />";
                                    echo timezone_menu($field_data['value']);
                                }
                                ?>
        
                                <?php if ($this->lang->line('pages ' . $content['page'] . ' help_text ' . $content['name'], FALSE)) : ?>
                                    <span class="help-block"><?php echo lang('pages ' . $content['page'] . ' help_text ' . $content['name']); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                          
                    <?php endforeach; ?>
                    
                </div>
                
            <?php endforeach; ?>
            
        </div>
        
    <div class="row text-right">
        <a class="btn btn-default" href="<?php echo $cancel_url; ?>"><?php echo lang('core button cancel'); ?></a>
        <button type="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> <?php echo lang('core button save'); ?></button>
    </div>

    <div class="row"><br /></div>

<?php echo form_close(); ?>