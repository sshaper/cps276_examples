<?php

/*THIS EXAMPLE I AM USING TOO FILES EACH CONTAINING THE SAME CLASS NAME BUT WITH TWO DIFFERENT NAMESPACES*/

require_once 'admin/Product.php';
require_once 'user/Product.php';

$adminProd = new Admin\Product();

$userProd = new User\Product();

$adminProd->test();

$userProd->test();