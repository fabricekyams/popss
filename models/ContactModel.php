<?php
class ContactModel extends Model{
	
	/**
	 * enregistrer un nouveau message
	 * @param unknown $message
	 */
	public function extractMail($mail){
		extract($mail);
		$date = date("Y-m-d H:i:s");
	}
	
}