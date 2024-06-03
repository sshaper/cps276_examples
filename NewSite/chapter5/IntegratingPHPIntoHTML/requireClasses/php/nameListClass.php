<?php 
class NameList {
    public function getNames() {
        $names = ["Scott", "Karen", "Mike", "Judy", "John", "Abby", "Bobbie"];
        $output = "<ul>";
        foreach ($names as $name) {
            $output .= "<li>{$name}</li>";
        }
        $output .= "</ul>";
        return $output;
    }
}
?>