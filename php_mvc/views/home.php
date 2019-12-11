<?php

$page = <<<HTML

<main>
  <p>This example (in addition to the pdo stuff) is a great example for showing how a MVC type structure can be used with a modular site using AJAX.  A modular site has content in which the main parts (in this case the nav) are added, instead of one page where all content is added.  Just a different way of doing it.</p>

  <div>{$nameList}</div>
</main>

HTML;

return $page;

?>


