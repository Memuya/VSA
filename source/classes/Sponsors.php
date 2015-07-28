<?php
class Sponsors {
	private $count;
	private $data;

	public function __construct() {
		$this->data = [];
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

		$q = DB::$db->prepare("
			SELECT *, ads.id as adID
			FROM ads
			INNER JOIN sponsors
			ON sponsors.id = ads.company
			WHERE status = :status
		") or die(SQL_ERROR);

		$q->execute([':status' => $status]);

		$this->count = $q->rowCount();

		if($this->count != 0)
			while($r = $q->fetch(PDO::FETCH_OBJ))
				$this->data[] = $r;

		return $this->data;
	}

	public function deleteAd($id) {
		$id = (int)$id;

		$q = DB::$db->prepare("
			SELECT id, img
			FROM ads
			WHERE id = :id
		");
		$q->execute([':id' => $id]);

		$c = $q->rowCount();
		$r = $q->fetch(PDO::FETCH_OBJ);

		if($c !== 0) {
			//delete image
			unlink('../img/sponsors/'.$r->img);

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

	public function getCount() {
		return $this->count;
	}
}