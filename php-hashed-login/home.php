<?php
require_once 'classes/Page.php';
require_once 'classes/Admin.php';
$page = new Page();
$admin = new Admin();
$output = "";
$output = $admin->displayUsernamePassword();

echo $page->head("Encrypted Login - Home Page");
echo $page->security();
?>

  <body>
    <div id="wrapper" class="container">
      
      <h1>Home Page</h1>
      <?php echo $page->nav(); ?>
      <p>Below is a list of all usernames and encrypted passwords.</p>
        <div><?php echo $output; ?></div>

      
  </body>
</html>