<?php
class Format{
	public function formatDate($date){
		return date('F j, Y, g:i a', strtotime($date));
	}

	public function rewriteText($string) {
        $text = preg_replace('/[^-a-z0-9-]+/', '-', strtolower($string));
        return $text;
    }
    
	public function textShorten($text, $limit = 400){
		$text = $text. " ";
		$text = substr($text, 0, $limit);
		$text = substr($text, 0, strrpos($text, ' '));
		$text = $text."...";
		return $text;
	}

	public function validation($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
}

?>