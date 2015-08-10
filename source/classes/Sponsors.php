<?php
class Sponsors {
	private $count;
	private $data;

	public function __construct() {
		$this->data = [];
	}

	public static function countAds($status = '1') {
		try {
			$q = DB::$db->prepare("
				SELECT *, ads.id as adID
				FROM ads
				INNER JOIN users
				ON users.id = ads.user_id
				WHERE status = :status
			") or die(SQL_ERROR);

			$q->execute([':status' => $status]);
		} catch(PDOException $ex) {
			die($ex->getMessage());
		}

		$count = $q->rowCount();

		return $count;
	}

	/**
	* Returns all active or pending ads depending on argument passed through to signature
	* Returns all active ads by default
	*
	* @param string $status
	*/
	public function getAds($status = '1') {
		switch($status) {
			case '0':
				break;
			case '1':
				break;
			default:
				die("Unknown status passed through to getAds() method.");
				break;
		}

		try {
			$q = DB::$db->prepare("
				SELECT *, ads.id as adID
				FROM ads
				INNER JOIN users
				ON users.id = ads.user_id
				WHERE status = :status
			") or die(SQL_ERROR);

			$q->execute([':status' => $status]);
		} catch(PDOException $ex) {
			die($ex->getMessage());
		}

		$this->count = $q->rowCount();

		if($this->count != 0)
			while($r = $q->fetch(PDO::FETCH_OBJ))
				$this->data[] = $r;

		return $this->data;
	}

	public function deleteAd($id) {
		$id = (int)$id;

		$q = DB::$db->prepare("
			SELECT id, img_ext
			FROM ads
			WHERE id = :id
		");
		$q->execute([':id' => $id]);

		$c = $q->rowCount();
		$r = $q->fetch(PDO::FETCH_OBJ);

		if($c !== 0) {
			//delete image
			unlink('../img/sponsors/'.$r->id.".".$r->img_ext);

			$q = DB::$db->prepare("
				DELETE FROM ads
				WHERE id = :id
			");
			$q->execute([':id' => $id]);
		}
	}

	public function acceptAd($id) {
		$id = (int)$id;

		$q = DB::$db->prepare("
			SELECT id
			FROM ads
			WHERE id = :id
			AND status = '0'
		");
		$q->execute([':id' => $id]);

		$c = $q->rowCount();
		$r = $q->fetch(PDO::FETCH_OBJ);

		if($c !== 0) {
			$q = DB::$db->prepare("
				UPDATE ads
				SET status = '1'
				WHERE id = :id
			");
			$q->execute([':id' => $id]);
		}
	}

	public function adAd($img, $user_id) {
		//validate user ID
		$user_id = (int)$user_id;

		//check to see if an advertisement has been submitted yet
		$q = DB::$db->prepare("SELECT user_id FROM ads WHERE user_id = :user_id");
		$q->execute([':user_id' => $user_id]);
		$c = $q->rowCount();

		if($c != 0) {
			Errors::add("You have already submitted an advertisement to VSA. If it is not being displayed on the front page, your advertisement is yet to be approved. Please <a href=\"".PATH."contact\">contact us</a> for any questions you may have.");
		} else {

			//set validation for image
			$allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
			$max_size = 5000000;

			//get image name
			$name = $img['name'];

			//image extension
			$ext = explode(".", $name);
			$ext = end($ext);
			$ext = strtolower($ext);

			//image size
			$size = $img['size'];

			//image temp name
			$tmp_name = $img['tmp_name'];

			//validate
			if(empty($img['name']))
				Errors::add("An image is required");
			else if(!in_array($ext, $allowed_ext))
				Errors::add("That file type (".$ext.") is not supported for upload");
			else if($size > $max_size || $size <= 0)
				Errors::add("Maximum file size is 5MB: ".$size);
			else {
				//add to database
				try {
					$q = DB::$db->prepare("
						INSERT INTO ads (user_id, img_ext, status)
						VALUES (:user_id, :img_ext, '0')
					");
					$q->execute([
						':user_id' => $user_id,
						':img_ext' => $ext
					]);
				} catch(PDOException $ex) {
					Errors::add($ex->getMessage());
				}

				$lastId = DB::$db->lastInsertId();

				//upload image here
				move_uploaded_file($tmp_name, "../img/sponsors/".$lastId.".".$ext);

				$email_message  = 'A new advertisement has been submitted to the VSA website.';

				//send an email to an administrator (all of them?) to notify them that they have a ad pending
				mail('admin@vacuumsociety.org.au', "A new advertisement has been submitted", $email_message);
			}
		}

		return Errors::displayErrors("Your advertisement has been successfully added. It will have to be checked by an administrator before being displayed on the VSA home page.");
	}

	public function getCount() {
		return $this->count;
	}
}