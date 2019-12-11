<?php

$page = <<<HTML
<main>
  <p>To update a record update the record and click the corresponding "update" button.  To delete a record click the corresponding "delete" button.</p>
  <div id="result"></div>
  <div id="updateDeleteList">{$nameList}</div>
</main>

HTML;

return $page;
?>
