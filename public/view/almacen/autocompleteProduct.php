<?php 


  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASS', '926145');
  define('DB_DABA', 'DATMANTOOLS');  

  if (isset($_GET['phrase'])){
    $provid = $_GET['provid'];
    $prov = ($provid != '') ? 'AND Cpo_Id = '.$provid : '';
    $return_arr = array();
    try{
      $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_DABA, DB_USER, DB_PASS);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      $stmt = $conn->prepare("SELECT 
                                 Cri_Id
                                ,Cpo_Id
                                ,Cri_SKU
                                ,Cri_Descrip
                                ,Cun_NomClav
                                ,Cpo_NomCome
                                ,Cri_PreUnit
                                ,convert(Cri_FecAlta, char(10)) as Cri_FecAlta
                                ,Cri_Estatus
                            from ALCATART 
                            inner join ADCATUNI on Cun_Clave = Cri_Unidad
                            inner join ADCATPRO on Cpo_Id = Cri_Proveed 
                            WHERE Cri_Descrip LIKE :phrase 
                            AND Cri_Estatus = 1
                            ".$prov);
      $stmt->execute(array('phrase' => '%'.$_GET['phrase'].'%'));
      
      while($row = $stmt->fetch()) {
        $return_arr[] = array('prodid' => $row['Cri_Id'],'producto' => utf8_encode($row['Cri_Descrip']), 'precio' => utf8_encode($row['Cri_PreUnit']), 'unidad' => utf8_encode($row['Cun_NomClav']));        
      }
    }catch(PDOException $e) {
      echo 'ERROR: ' . $e->getMessage();
    }
    /* Toss back results as json encoded array. */
    echo json_encode($return_arr);
  }
?>