<?php
/**
 * navigation.php — shared menu HTML
 *
 * These hrefs are normal page loads (index.php?page=...). They are not Fetch.
 * After a page loads, js/contacts.js talks to the controllers.
 *
 * $nav is echoed by index.php on every screen, including Welcome.
 */
$nav=<<<HTML
     <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Modular Website</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=welcome">Welcome</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=listContacts">List Contacts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=addContact">Add Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=updateDeleteContacts">Update/Delete Contacts</a>
                </li>
            </ul>
        </div>
    </nav>
HTML;
