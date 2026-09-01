<?php
/**
 * router.php — chooses which HTML view to show
 *
 * Reads ?page= from the URL (a page request, not Fetch).
 * Fetch requests skip this file and call controllers/addContact.php etc. directly.
 */

$path = "index.php?page=welcome";

// ?? "welcome" means: if page is missing, show Welcome. Visiting index.php still works.
$page = $_GET["page"] ?? "welcome";

if ($page === "addContact") {
    require_once "views/addContactView.php";
    $content = init(); // init() returns an HTML string; it does not echo
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
