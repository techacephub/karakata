<?php
	// we include the database and the format classes
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../config/config.php');
	include_once ($filepath.'/Database.php');
	include_once ($filepath.'/Format.php');
?>

<?php
	class Product{
		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		// add product function
		public function addProduct($data, $file){
			$product_name      = mysqli_real_escape_string($this->db->link, $data['product_name']);
			$product_cat_id    = mysqli_real_escape_string($this->db->link, $data['product_cat_id']);
			$product_desc      = mysqli_real_escape_string($this->db->link, $data['product_desc']);
			$cost_price        = mysqli_real_escape_string($this->db->link, $data['cost_price']);
			$selling_price     = mysqli_real_escape_string($this->db->link, $data['selling_price']);
			$user_id           = mysqli_real_escape_string($this->db->link, $data['user_id']);
			$product_quantity  = mysqli_real_escape_string($this->db->link, $data['product_quantity']);

			// these lines of codes below are used to format the product image

			$permited = array('jpg', 'jpeg', 'png', 'gif'); // types of images that can only be uploaded
		  	$file_name = $file['image']['name'];
		  	$file_size = $file['image']['size'];
		  	$file_temp = $file['image']['tmp_name'];

		  	$div = explode('.', $file_name);
		  	$file_ext = strtolower(end($div));
		  	$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;

		  	$product_image = "product_images/".$unique_image; //  we store the product image in the product_images folder

		  	// check if fields submitted are empty

		  	if ($product_name == "" || $product_cat_id == "" || $product_desc == "" || $cost_price == "" || $selling_price == "" || $file_name == "" || $product_quantity == "") {
		  		$msg = "<span class='error'>Please make sure all fields are filled.</span>";
				return $msg;

		  	} 
		  	// check if image is more than 3 Megabyte
		  	elseif ($file_size > 3048567) {
		  		echo "<span class='error'>Image Size should be less than 3 MB</span>";
		  	
		  	} 
		  	// check if image uploaded is not in the supported file format
		  	elseif (in_array($file_ext, $permited) === false) {
		  		echo "<span class='error'>You can upload only:-".implode(', ',$permited)."</span>";

			}	
			// if all conditions are met, upload the image into the folder and submit the data to the database	  	
		  	else {
		  		move_uploaded_file($file_temp, $product_image);
		  		
		  		$query = "INSERT INTO product (product_name, product_image, product_desc, cost_price, selling_price, product_cat_id, user_id, product_quantity) VALUES ('$product_name', '$product_image', '$product_desc', '$cost_selling_price', '$product_cat_id', '$user_id', '$product_quantity')";

		  		$inserted_row = $this->db->insert($query);

				if ($inserted_row){
					$msg = "<span class='success'>New Product Inserted Successfully!</span>";
					return $msg;
				}
				else {
					$msg = "<span class='error'>Product Not Inserted!</span>";
					return $msg;
				}
		  	}
		}
	}
?>