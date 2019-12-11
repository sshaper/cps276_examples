<?php

class Page {
	public function nav(){
		$nav = <<<NAV
      <nav>
        <ul>
          <li><a href="index.php">Names List</a></li>
          <li><a href="add_names.php">Add Name and Info</a></li>
          <li><a href="update_delete_name.php">Update/Delete Names</a></li>
        </ul>
      </nav>
NAV;
		return $nav;
	}
}