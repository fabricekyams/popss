<?php

function input($id,$placeholder,$value=array(),$atts=null, $type = 'text'){  
	$value=!empty($value)? $value[$id] : '';
	
	$return = "<div class='form-group'> <input name='$id' type='$type'  id='$id' required='required' placeholder='$placeholder' class='form-control' value='$value'";
	if (isset($att)){
		foreach ($atts as $att){
			$return.=$att;
		}
	}
	$return .= "></div>";
	return $return;
	//return "<div class='form-group'> <input name='$id' type='$type'  id='$id' required='required' placeholder='$placeholder' class='form-control' value='$value'></div>";
}

function textarea($id,$placeholder,$value='',$row = 10 ){
	$value=!empty($value)? $value[$id] : '';
	return "<div class='form-group'> <textarea name='$id'  id='$id' required='required' placeholder='$placeholder' class='form-control' rows= '$row' value='$value'>$value</textarea></div>";
}

function selectbox($id, $cats = array()){
	$return = "<select id = '$id' name ='$id' class='form-control'>\n";
	foreach ($cats as $catid => $value){
		$select = '';
		if (isset($_POST['cat_id']) && $catid == $_POST['cat_id']){
			$select = "selected='selected'";
		}
		$return .=  "<option value='$catid' $select >$value</option>\n";
	}
	$return .= "</select>";
	return $return;
}