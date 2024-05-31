<?php 


define('DB_HOST', '213.162.197.2');
define('DB_USER', 'uhdtgnaj_dmtoolsadm');
define('DB_PASS', '926145CaPry$*@');
define('DB_DABA', 'uhdtgnaj_DATMANTOOLS');   

  if (isset($_GET['phrase'])){
    $return_arr = array();
    try{
      $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_DABA, DB_USER, DB_PASS);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      $stmt = $conn->prepare("SELECT 
                                 Cri_Id
                                ,Cri_Descrip
                                ,Cun_NomClav
                                ,convert(Cri_FecAlta, char(10)) as Cri_FecAlta
                                ,Cri_Estatus
                            from ALCATART 
                            inner join ADCATUNI on Cun_Id = Cri_Unidad
                            WHERE Cri_Descrip LIKE :phrase 
                            AND Cri_Estatus = 1");
      $stmt->execute(array('phrase' => '%'.$_GET['phrase'].'%'));
      
      while($row = $stmt->fetch()) {
        $return_arr[] = array('prodid' => $row['Cri_Id'],'producto' => utf8_encode($row['Cri_Descrip']), 'unidad' => utf8_encode($row['Cun_NomClav']));        
      }
    }catch(PDOException $e) {
      echo 'ERROR: ' . $e->getMessage();
    }
    /* Toss back results as json encoded array. */
    echo json_encode($return_arr);
  }
?>