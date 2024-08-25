<?php

//THIS IS AN EXAMPLE OF ENCAPULATION WHERE THE PROPERTIES ARE PRIVATE AND WE USE METHODS TO GET/SET THE PROPERTY VALUES
class Account {
    private $_totalBalance = 0;


    public function makeDeposit( $amount ) {
        $this->_totalBalance += $amount;
    }
   
    public function makeWithdrawal( $amount ) {
        if ( $amount < $this->_totalBalance ) {
            $this->_totalBalance -= $amount;
        } 
        else {
            die( "Insufficient funds" );
        }
    }

    public function getTotalBalance() {
        return $this->_totalBalance;
    }
}


$a = new Account;
$a->makeDeposit( 500 );
$a->makeWithdrawal( 100 );
echo $a->getTotalBalance()."<br>";
$a->makeWithdrawal( 1000 );