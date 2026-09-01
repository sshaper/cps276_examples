<?php
/**
 * navigation.php — shared navbar HTML
 *
 * These links are normal page requests (they load index.php).
 * They are not Fetch. After a page loads, contacts.js handles add/list/update/delete.
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
