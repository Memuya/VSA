<?php
class Template {
	private $title;
	private $desc;
	private $tags;
	private $page;

	/**
	* Set class varibles
	* Prefix variable used in the setAvtivePage() method
	*
	* @param string $prefix
	*/
	public function __construct($prefix = null) {
		$this->setActivePage($prefix);
		$this->title = "Vacuum Society of Australia";
		$this->desc = "Vacuum Society of Australia";
		$this->tags = "Vacuum Society of Australia, Vacuum technology short courses, Applied Surface Science, Electronic Materials and Processing, Nanometer Structures, Plasma Science and Technique, Surface Engineering, Surface Science, Thin Film, Vacuum Science, Vacuum Technology";
	}

	/**
	* Appends onto the $title variable
	* 
	* @param string $title
	*/
	public function setTitle($title) {
		$this->title = $title." | ".$this->title;
	}

	/**
	* Set a description
	* 
	* @param string $desc
	*/
	public function setDesc($desc) {
		$this->desc = $desc;
	}

	/**
	* Appends onto the tags variable
	* 
	* @param string $tags
	*/
	public function setTags($tags) {
		$this->tags = $this->tags.", ".$tags;
	}

	/**
	* Set the current active page so the navigation link is set to active
	* Prefix is used for different folders
	* e.g - control pannel pages will have a cp_ prefix ($t = new Template("cp_");) so there are no clashes with other pages with the same name
	*
	* @param string $prefix
	*/
	public function setActivePage($prefix = null) {
		$page = explode("/", $_SERVER['PHP_SELF']);
		$page = end($page);
		$page = explode(".", $page);
		$page = current($page);
		$this->page = $prefix.$page;
	}

	/**
	* Returns the $title variable
	*/
	public function getTitle() {
		return $this->title;
	}

	/**
	* Returns the $desc variable
	*/
	public function getDesc() {
		return $this->desc;
	}

	/**
	* Returns the $tags variable
	*/
	public function getTags() {
		return $this->tags;
	}

	/**
	* Returns the $page variable
	*/
	public function getActivePage() {
		return $this->page;
	}

	/**
	* Includes (loads) a file
	* 
	* @param string $file
	*/
	public function load($file) {
		return $_SERVER['DOCUMENT_ROOT'].'/vsoa/'.$file;
	}
}