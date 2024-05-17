<?php 


  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASS', '926145');
  define('DB_DABA', 'DATMANTOOLS');  


    $return_arr = array();
    try{
      $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_DABA, DB_USER, DB_PASS);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      $stmt = $conn->prepare("select 
                                 Cri_Id
                                ,Cri_Descrip as 'producto'
                                ,Cun_NomClav
                                ,ifnull((select sum(ifnull(Ent_Cantid,0)) as 'entradas' from ALENTART where Ent_Produc = Cri_Id group by Ent_Produc),0) as 'entradas'
                                ,ifnull((select sum(ifnull(Sal_Cantid,0)) as 'salidas' from ALSALART where Sal_Produc = Cri_Id group by Sal_Produc),0) as 'salidas'
                                ,ifnull((select sum(ifnull(Ent_Cantid,0)) as 'entradas' from ALENTART where Ent_Produc = Cri_Id group by Ent_Produc),0)
                                  -
                                ifnull((select sum(ifnull(Sal_Cantid,0)) as 'salidas' from ALSALART where Sal_Produc = Cri_Id group by Sal_Produc),0) as 'existencia'
                              from ALCATART 
                              right join ALENTART on Ent_Produc = Cri_Id
                              left join ALSALART on Sal_Produc = Cri_Id
                              inner join ADCATUNI on Cri_Unidad = Cun_Clave
                              where Cri_Descrip LIKE :phrase 
                              group by Cri_Id
                              order by Cri_Id");


      $stmt->execute(array('phrase' => '%'.$_GET['phrase'].'%'));
      
      while($row = $stmt->fetch()) {
        $return_arr[] = array('prodid' => $row['Cri_Id'],'producto' => utf8_encode($row['producto']), 'unidad' => utf8_encode($row['Cun_NomClav']), 'existencia' => utf8_encode($row['existencia']));        
      }
    }catch(PDOException $e) {
      echo 'ERROR: ' . $e->getMessage();
    }
    /* Toss back results as json encoded array. */
    echo json_encode($return_arr);
?>