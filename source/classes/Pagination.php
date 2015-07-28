<?php
class Pagination {
	protected $limit, $page, $amount, $pages;

	/**
	* Returns a list links to navigate through pages
	*
	* @param string $link
	*/
	public function getPageLinks($link) {
		$output = '<div class="pagination">';

		for($x = 0; $x < $this->pages; $x++) {
			$css_class = ($this->page == ($x+1)) ? ' class="active"' : null;
			$output .= '<a href="'.$link.'?page='.($x+1).'"'.$css_class.'>'.($x+1).'</a> ';
		}

		$output .= '</div>';

		return $output;
	}
}