<?php

class Process extends Controller {

	function __construct(){
		parent::__construct();
				
	}
	
	function index()
    {	
		$data['content'] = 'home';
		$this->load->view('template',$data);
	}
	
	function manual(){
		
		$data['content'] = 'manual';
		$this->load->view('template',$data);
	}
	
	function about(){
		
		$data['content'] = 'about';
		$this->load->view('template',$data);
	}
	
	function pocess_image(){
		
		$path = "canvas/";//.$this->session->userdata('session_id');
		if(!(is_dir($path))){
			mkdir($path);
		}

		$files = scandir($path);

		//unset($files[0]);
		//unset($files[1]);

		$counter = count($files);
		$counter = $counter+1;
		$counter = str_pad($counter,4, "0", STR_PAD_LEFT);
		
		$filename = date("Y-m-d").'_'.$counter.'.png';

		$image = $GLOBALS['HTTP_RAW_POST_DATA'];
		$image = str_replace('data:image/png;base64,', '', $image);
		$image = str_replace(' ', '+', $image);

		$data = base64_decode($image);

		$uploads_dir="$path/";
		$file = $uploads_dir.$filename;
		$success = file_put_contents($file, $data);
		
		$this->session->set_userdata(array("phtCnt" =>date("Y-m-d").'_'.$counter));
		
		//echo  $image;
		
	}
	
	function process_crop(){
		
		$path = "canvas/";//.$this->session->userdata('session_id');
		if(!(is_dir($path))){
			mkdir($path);
		}

		$files = scandir($path);

		unset($files[0]);
		unset($files[1]);

		$counter = count($files);
		$counter = $counter+1;
		$counter = str_pad($counter,4, "0", STR_PAD_LEFT);
		
		$filename = date("Y-m-d").'_'.$counter.'.png';

		$image = $_POST['image'];
		$image = str_replace('data:image/png;base64,', '', $image);
		$image = str_replace(' ', '+', $image);

		$data = base64_decode($image);

		$uploads_dir="$path/";
		$file = $uploads_dir.$filename;
		$success = file_put_contents($file, $data);
		
		$this->session->set_userdata(array("phtCrp" =>date("Y-m-d").'_'.$counter));
	}
	
	function upload_pictures(){
		
		$path = "uploads/".$this->session->userdata('session_id');
		
		if(!(is_dir($path))){
			mkdir($path);
		}
		
		$check_files = '';
	
		for($i=0; $i<count($_FILES["file"]["name"]); $i++){
			$uploads_dir="$path/";
			$name = $_FILES["file"]["name"][$i];
			$nstore = move_uploaded_file($_FILES["file"]["tmp_name"][$i], "$uploads_dir$name");
			
			if(file_exists("$uploads_dir/$name")){
				$check_files.= base_url().$uploads_dir.'/'.$name.'|';
			}
			
		}
		
		$check_files = trim($check_files,"|");
		
		echo $check_files;
	}
	
	function execute(){
		$file = "canvas/".$this->session->userdata('phtCnt').".png";
		if (file_exists($file)) {
			//set appropriate headers
			header('Content-Description: File Transfer');
			header('Content-Type: image/png');
			header('Content-Disposition: attachment; filename='.basename($file));
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			ob_clean();
			flush();

			//read the file from disk and output the content.
			readfile($file);
			exit;
		}
	}
	
	function commence(){
		$file = "canvas/".$this->session->userdata('phtCrp').".png";
		if (file_exists($file)) {
			//set appropriate headers
			header('Content-Description: File Transfer');
			header('Content-Type: image/png');
			header('Content-Disposition: attachment; filename='.basename($file));
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			ob_clean();
			flush();

			//read the file from disk and output the content.
			readfile($file);
			exit;
		}
	}
	
	
}








