<?php
/**
 * welcome.php — landing view
 *
 * HTML only. No Fetch and no database on this screen.
 */
function init(){
    return <<<HTML
    <h1>Welcome</h1>
    <p>Welcome to the modular contacts application. Use the links above to add, list, update, or delete contacts.</p>
    <p>Adding, listing, updating, and deleting happen with Fetch in the background. The page does not fully reload for those actions.</p>
HTML;
}
?>
