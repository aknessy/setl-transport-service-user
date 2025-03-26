<?php
/**
 * Amazon S3 Upload PHP class
 *
 * @version 0.1
 */
class S3_upload {
	function __construct()
	{
    $this->CI =& get_instance();
		$this->CI->load->library('S3');
		$this->CI->config->load('s3', TRUE);
		$s3_config = $this->CI->config->item('s3');
		$this->bucket_name = $s3_config['bucket_name'];
		$this->s3_url = $s3_config['s3_url'];
	}

	//Add this in the function below S3::ACL_PUBLIC_READ,
	function upload_file($file_path,$file_name,$folder_name)
	{
		$file = pathinfo($file_path);
		$mime_type = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file_path);
		$saved = $this->CI->s3->putObjectFile(
				$file_path,
				$this->bucket_name,
				$folder_name.'/'.$file_name,
				S3::ACL_PUBLIC_READ,
				array(),
				$mime_type
		);
		if($saved){
			$res['file'] = $file_name;
			$res['status'] = TRUE;
		}else{
			$res['file'] = '';
			$res['status'] = FALSE;
		}
		return $res;
	}

	function driver_upload_file($file_path,$file_name,$folder_name)
	{
		$file = pathinfo($file_path);
		$mime_type = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file_path);
		$saved = $this->CI->s3->putObjectFile(
				$file_path,
				$this->bucket_name,
				$folder_name.'/'.$file_name,
				S3::ACL_PRIVATE,
				array(),
				$mime_type
		);
		if($saved){
			$res['file'] = $file_name;
			$res['status'] = TRUE;
		}else{
			$res['file'] = '';
			$res['status'] = FALSE;
		}
		return $res;
	}
	public function delete_file($uri)
	{
		$delete = $this->CI->s3->deleteObject($this->bucket_name,$uri);
		if ($delete){
			return $delete;
		}
	}

	public function getImg($url)
	{
		return $this->CI->s3->getObject($this->bucket_name,$url);
	}

	function multi_delete($folderName,$file)
	{
		foreach ($file as $key => $value){
			$val=(array_values($value));
			for($i=0;$i<sizeof($value);$i++)
			{
			  $this->CI->s3->deleteObject($this->bucket_name,$folderName.'/'.$val[$i]);
			}
		}
	}
}