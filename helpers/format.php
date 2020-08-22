<?php 
// Format Class
class Format
{
	// Format ngay thang
	public function formatDate($date)
	{
		return date('F j, Y, g: i a', strtotime($date));
	}

	// Format chuan SEO
	public function textShorten($text, $limit = 400)
	{
		$text = $text. " ";
		$text = substr($text, 0, $limit);
		$text = substr($text, 0, strrpos($text, ' '));
		$text = $text.".....";
		return $text;
	}

	// Format kiem tra form (validation)
	public function validation($data)
	{
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	// Format kiem tra ten cua server
	public function title()
	{
		$path = $_SERVER['SCRIPT_FILENAME'];
		$title = basename($path, '.php');
		if($title == 'index'){
			$title = 'home';
		}elseif($title == 'contact'){
			$title = 'contact';
		}
		return $title = ucfirst($title);
	}
}
?>