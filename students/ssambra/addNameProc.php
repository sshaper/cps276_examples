<?php
class AddNamesProc{

    public function addClearNames() {
        if(isset($_POST['addNamesButton'])) {

            if(isset($_POST['names'])) {
                $nameArray = explode(" ", $_POST['names']);
            }

            $name = $nameArray[1].", ".$nameArray[0];

            $newNameArray = explode("\n", $_POST['namelist']);

            array_push($newNameArray, $name);

            sort($newNameArray);

            $output = implode("\n", $newNameArray);

            return $output;
        
        }else if(isset($_POST['clearNamesButton'])) {
            
            if(isset($_POST['namelist'])) {
                $output = "";
            }

            return $output;
        }

    }


}
?>