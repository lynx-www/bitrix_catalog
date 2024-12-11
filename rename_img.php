<?php

global $DB;
 //echo "rename";
 // Файл для переименовывания  картинок
 $sql = "SELECT * FROM `b_iblock_element`,`b_file` WHERE `b_iblock_element`.`DETAIL_PICTURE` = `b_file`.`ID` AND `b_iblock_element`.`IBLOCK_ID`=26"; 
 //SELECT * FROM `b_file` WHERE `ID` = 2780; 
 //$sql = "SELECT *  FROM `b_iblock_element` WHERE  DETAIL_PICTURE = 2780;" ;  OR `IBLOCK_SECTION_ID` = 69"
 $sql = "SELECT ID, CODE FROM `b_iblock_section` WHERE `ID` = 69"; 

 function rename_img($results, $DB){
    $result = $DB->Query($results);
    $row = $result->fetch();
        //var_dump($row);
      //  echo $row['CODE'];

    $sql1 = "SELECT ID, CODE FROM `b_iblock_section` WHERE `IBLOCK_SECTION_ID` = 69";
    $results1 = $DB->Query($sql1);
    while($row1 = $results1->fetch()){
        echo '<b>'.$row['ID'].' '.$row['CODE'].' '.$row1['ID'].' '.$row1['CODE'].'</b><br>'; 

        $sql2 = "SELECT * FROM `b_iblock_element`, `b_file` WHERE `IBLOCK_SECTION_ID` = ".$row1['ID']." AND b_file.ID = b_iblock_element.PREVIEW_PICTURE; ";

        $results2 = $DB->Query($sql2);
        while($row2 = $results2->fetch()){
            echo ' '.$row2['NAME'].' '.$row2['CODE'].'<br>'.$row2['PREVIEW_PICTURE'].' '.$row2['DETAIL_PICTURE'].' '.$row2['SUBDIR'].' '.$row2['ORIGINAL_NAME'].' '.$row2['FILE_NAME'].'<br>';
            
            $from = $_SERVER['DOCUMENT_ROOT'].'/upload/'.$row2['SUBDIR'].'/'.$row2['FILE_NAME'];
            echo "ОТКУДА ===".$from;
           
            $uploads_dir = '/'.$row['CODE'].'/'.$row1['CODE'].'/'.$row2['ORIGINAL_NAME'];
            echo "<br>КУДА ===".$uploads_dir.'<br>';
            //rename("/tmp/tmp_file.txt", "/home/user/login/docs/my_file.txt");
        }
            //var_dump($row1);
       /* $sql2 = "SELECT * FROM `b_iblock_element` WHERE `IBLOCK_SECTION_ID` = ".$row1['ID']."";
        echo $sql2.'<br>';
        $results2 = $DB->Query($sql2);
        while($row2 = $results2->fetch()){
            echo ' '.$row2['NAME'].' '.$row2['CODE'].' '.$row2['PREVIEW_PICTURE'].' '.$row2['DETAIL_PICTURE'].'<br>';
            $sql3 = "SELECT * FROM `b_file` WHERE `ID` = ".$row2['PREVIEW_PICTURE']."";
            echo $sql3;
            /*$results3 = $DB->Query($sql3);
            while($row3 = $results3->fetch()){
                echo $row3['SUB_DIR'].'<br>';
            }*/
        }
        
        
    }

    function find_file($DB){
        //Функция проверки на пустой каталог
       $sql = "SELECT SUBDIR FROM `b_file`";
       $result = $DB->Query($sql);
       while($row = $result->fetch()){
        foreach($row as $key){
            //var_dump($key);
            $from = $_SERVER['DOCUMENT_ROOT'].'/upload/'.$key;
            $f = scandir($from);
            print_r($f);
        }
        
    }
    }

    function rename_db_img($DB){
        $var = 2789;
        $sql = "SELECT ID, SUBDIR, FILE_NAME, ORIGINAL_NAME  FROM `b_file` WHERE `ID` = ".$var."";
        $result = $DB->Query($sql);
        while($row = $result->fetch()){
     
            $from = $_SERVER['DOCUMENT_ROOT'].'/upload/'.$row['SUBDIR'].'/'.$row['FILE_NAME'];
            $to = $_SERVER['DOCUMENT_ROOT'].'/upload/'.$row['SUBDIR'].'/'.$row['ORIGINAL_NAME'];
            echo $from.'<br>'.$to;
            rename($from, $to);
            $sql = "UPDATE `b_file` SET `FILE_NAME` = '".$row['ORIGINAL_NAME']."' WHERE `b_file`.`ID` =  ".$var."";
            echo $sql;
            $result = $DB->Query($sql);
            $row = $result->fetch();


         
    }
}

    
    
 //rename_img($sql, $DB);
 rename_db_img($DB);
 //find_file($DB);

/**
 * SELECT * FROM `b_file` WHERE `ID` = 2780 
 * SELECT * FROM `b_iblock_element` WHERE `PREVIEW_PICTURE` = 2780 
 *  //////IBLOCK_SECTION_ID 157
 * SELECT *  FROM `b_iblock_section` WHERE `ID` = 157 
 * IBLOCK_SECTION_ID 69
 * NAME Баки и теплообменники
 * 
 * SELECT * FROM `b_iblock_section` WHERE `CODE` LIKE 'komplektuyushie_dlya_bani' 
 * XML_ID 543
 * CODE komplektuyushie_dlya_bani
 * ID 69
 * 
 * SELECT * FROM `b_iblock_section` WHERE `IBLOCK_ID` = 26 AND `DEPTH_LEVEL` = 1
 * 
 * 
 */
?>
