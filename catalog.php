<?
global $DB;
function create_catalog($results, $DB){
  //
  $result = $DB->Query($results);
  while($row = $result->fetch()){
    $array_id[$row['ID']] = $row['CODE'];
    $structure = $_SERVER['DOCUMENT_ROOT'].'/upload/iblock/'.$row['CODE'];

    //var_dump($structure);
    if(!is_dir($structure)){
      mkdir($structure, 0777, true);
    }
  }

      /*if (!mkdir($structure, 0777, true)) {
      die('Не удалось создать директории...');
  }*/

  //Вернули массив каталогов 
  //var_dump($array_id); 
  
  return $array_id;
  
  
}

//SELECT CODE FROM `b_iblock_section` WHERE `IBLOCK_ID` = 26 AND `IBLOCK_SECTION_ID` = 69; 
//подкаталог
//Атрибут DEPTH_LEVEL отвечает за структурность каталога
//SELECT * FROM `b_iblock_section` WHERE `IBLOCK_ID` = 26 AND `IBLOCK_SECTION_ID` = 69 ORDER BY `b_iblock_section`.`DEPTH_LEVEL` ASC 
$sqld = "SELECT * FROM `b_iblock_section` WHERE `IBLOCK_ID` = 26 AND `DEPTH_LEVEL` = 1";
//$results = $DB->Query("SELECT * FROM `b_iblock_section` WHERE `IBLOCK_ID` = 26 AND `DEPTH_LEVEL` = 1");
$results = "SELECT * FROM `b_iblock_section` WHERE `IBLOCK_ID` = 26 AND `DEPTH_LEVEL` = 1";
//Создали каталоги для хранения картинок
$catalog = create_catalog($results, $DB);

//Получить BLOCK_ID= 26
//SELECT * FROM `b_iblock_section` WHERE `ID` = 69 OR `IBLOCK_SECTION_ID` = 69; 
function create_sub_catalog($catalog, $DB){
  //var_dump($catalog); 

  foreach($catalog as $key => $var){
    //$sql = "SELECT * FROM `b_iblock_section` WHERE `ID` = $key ";
    echo '<b>'.$key.' '.$var.'</b><br>';

    //Проверяем есть ли каталог, есть ли нет, создадим
    $structure = $_SERVER['DOCUMENT_ROOT'].'/upload/iblock/'.$var;
    if(!is_dir($structure)){
      mkdir($structure, 0777, true);
    }
  

    $sql1 = "SELECT CODE FROM `b_iblock_section` WHERE `IBLOCK_SECTION_ID` =  $key";
    //echo $sql1.'<br>';
    $results1 = $DB->Query($sql1);
    while($row = $results1->fetch()){
        foreach($row as $sub){
          echo $sub.'<br>';
          //Создадим подкаталог
          $structure1 = $_SERVER['DOCUMENT_ROOT'].'/upload/iblock/'.$var.'/'.$sub;
          echo $structure1.'<br>';
          if(!is_dir($structure1)){
            mkdir($structure1, 0777, true);
          }
        }
    
   
    }
   
  }
  
}
create_sub_catalog($catalog, $DB);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");

?>
