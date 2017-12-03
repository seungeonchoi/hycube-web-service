<?php
$name = "aaba@aa.aa.a!a";
echo $name."<br>";
if(!preg_match('/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]+(\.[a-zA-Z]+)*$/',$name)){
    echo "1";

}
if(!preg_match('/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\./',$name)){
    echo "2";

}
if(!preg_match('/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+/',$name)){
    echo "3";

}
if(!preg_match('/^[a-zA-Z0-9_.+-]+@/',$name)){
    echo "4";

}
if(!preg_match('/[a-zA-Z0-9_-.+]+@[a-zA-Z0-9-]+.[a-zA-Z]+(\.[a-zA-Z]+)*/',$name)){
    echo "5";

}


?>