<?php

/**
* Updated: Mohammad M. AlBanna
* Website: MBanna.info
*/


//MySQL server and database
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'bypos';
$tables = 'pos_itemtemp,pos_salestemp,item_void,pos_promotion_h,pos_promotion_d,pos_paymenttemp';

//Call the core function
backup_tables($dbhost, $dbuser, $dbpass, $dbname, $tables);

//Core function
function backup_tables($host, $user, $pass, $dbname, $tables = '*') {
    $link = mysqli_connect($host,$user,$pass, $dbname);

    // Check connection
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;
    }

    mysqli_query($link, "SET NAMES 'utf8'");

    //get all of the tables
    if($tables == '*')
    {
        $tables = array();
        $result = mysqli_query($link, 'SHOW TABLES');
        while($row = mysqli_fetch_row($result))
        {
            $tables[] = $row[0];
        }
    }
    else
    {
        $tables = is_array($tables) ? $tables : explode(',',$tables);
    }

    $return = '';
    //cycle through
    $terminal=$_GET['terminal'];
    foreach($tables as $table)
    {
        $result = mysqli_query($link, "SELECT * FROM $table WHERE terminal_id = '$terminal'");
        $num_fields = mysqli_num_fields($result);
        $num_rows = mysqli_num_rows($result);

        $counter = 1;

        //Over tables
        for ($i = 0; $i < $num_fields; $i++) 
        {   //Over rows
            while($row = mysqli_fetch_row($result))
            {   
                if($counter == 1){
                    $return.= 'INSERT INTO '.$table.' VALUES(';
                } else{
                    $return.= '(';
                }

                //Over fields
                for($j=0; $j<$num_fields; $j++) 
                {
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = str_replace("\n","\\n",$row[$j]);
                    if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                    if ($j<($num_fields-1)) { $return.= ','; }
                }

                if($num_rows == $counter){
                    $return.= ");\n";
                } else{
                    $return.= "),\n";
                }
                ++$counter;
            }
        }
        $return.="\n\n\n";
    }

    //save file
    $fileName = './closedaydata/'.$terminal.'.sql';
    $handle = fopen($fileName,'w+');
    fwrite($handle,$return);
    if(fclose($handle)){
        echo "<script>alert('DATA BERHASIL DIBUAT')</script>";
        exit; 
    }
}