<?php
/**
 * router.php — chooses which HTML view to show
 *
 * Reads ?page= from the URL. This is a page request, not Fetch.
 * Fetch skips this file and calls controllers/addContact.php (etc.) directly.
 *
 * Each view file defines init(). That function returns an HTML string; it does not echo.
 * index.php echoes $nav and $content.
 *
 * ?? "welcome" means: visiting index.php with no page still shows Welcome.
 */
$path = "index.php?page=welcome";

$page = $_GET["page"] ?? "welcome";

if ($page === "addContact") {
    require_once "views/addContactView.php";
    $content = init();
} else if ($page === "listContacts") {
    require_once "views/listContactsView.php";
    $content = init();
} else if ($page === "updateDeleteContacts") {
    require_once "views/updateDeleteContactsView.php";
    $content = init();
} else if ($page === "welcome") {
    require_once "views/welcome.php";
    $content = init();
} else {
    // Unknown page name: send the browser to Welcome.
    header("Location: " . $path);
    exit; // Stop so index.php does not print HTML after the redirect.
}
?>
