<?php

/*THIS EXAMPLE IS THE SAME AS EXAMPLE ONE BUT I AM USING THE "USE" FUNCTION. THE USE FUNCTION IS HELPFUL WHEN WE DON'T WANT TO HAVE LONG NAME FOR OUR NEW STATEMENTS.*/

require_once 'admin/Product.php';
require_once 'user/Product.php';

use Admin\Product as adminProd;
use User\Product as userProd;

$adminProd = new adminProd();

$userProd = new userProd();

$adminProd->test();

$userProd->test();