<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form_builder {

	public function __construct($config = array())
	{
		$CI =& get_instance();
		$CI->load->helper('url');
	}

	function create_form($form = array())
	{	
		$form_data = json_decode($form->form_data,true);
		
		foreach($form_data as $form_data_Key => $form_data_Value) {
			//echo "<pre>";

			echo '<div class="row">';
	            echo '<div class="form-group col-md-12">';
				echo '<h5 class="box-title">'.$form_data_Value['group_name'].'</h5>';
				echo '</div>';
				
				foreach($form_data_Value['fields'] as  $key => $val) {
					
					if ( isset($val['input_type']) &&  $val['input_type'] != 'button' )
					{
						$type = $val['input_type'];

						echo '<div class="c__custom c__custom_width col-md-4">';
                        	echo '<div class="col-md-12">';
                            echo '<label>'.$val['label'].'</label>';
                            echo '</div>';
                            
                        $required = ( isset($val['required']) ) ? 'required' : '';

                        if ( $type == 'select' )
						{	


							if(isset($val['select_type']) && $val['select_type'] == 'dynamic')
							{
								
							} else
							{
								// print_r($val);
								echo '<select name="'.$val['name'].'" class="form-control" id="'.$val['name'].'" '.$required.'>';

								foreach($val['options'] as  $optionKey => $optionVal) {
									echo '<option value="'.$optionVal['value'].'">'.$optionVal['option'].'</option>';
								}

	                            echo '</select>';
								
							}
							
						}

						else if ( $type == 'checkbox')
						{	

							echo "<div>";
							
							foreach ( $val['options'] as $opt => $checkbox )
							{

								echo '<div class="checkbox checkbox-sec margin-right mr-4 pull-left" style="clear:both;">';
                                echo '<input type="checkbox" name="'.$val['name'].'[]" value="'.$checkbox['value'].'" id="checkbox_credit_card'.$key.''.$opt.'">';
                                echo '<label for="checkbox_credit_card'.$key.''.$opt.'"><span>'.$checkbox['option'].'</span></label>';
                                echo '</div>';
							}
							echo "</div>";
						}

						else if ( $type == 'radio')
						{	

							echo "<div>";
							
								foreach ( $val['options'] as $opt => $checkbox )
								{

									echo '<div class="radio radio-sec margin-right mr-4">';
	                                echo '<input type="radio" name="card['.$val['name'].']" value="'.$checkbox['value'].'" id="radio_credit_card_r_'.$opt.'">';
									echo '<label for="radio_credit_card_r_'.$opt.'"><span>'.$checkbox['option'].'</span></label>';
	                                echo '</div>';

								}

							echo "</div>";
						}

						else if ( $type == 'textarea' )
						{
							echo '<textarea name="'.$val['name'].'" id="'.$val['name'].'" rows="3" class="form-control" '.$required.'></textarea>';
						}

						else if ( $type == 'text' || $type == 'number' ||  $type == 'email' || $type == 'password' )
						{
							echo '<input type="'.$type.'" class="form-control" name="'.$val['name'].'" id="'.$val['name'].'" placeholder="'.$val['placeholder'].'" '.$required.'/>';
						}

                        echo '</div>';
					}

					
				}

			echo '</div>';
		}

	}

	function check_val( $val )
	{
		return ( isset($val) ) ? $val : '';
	}

}