<?php
require_once('./config.php');
if (isset($_GET['phrase'])){
    $return_arr = array();
    try{
        $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_DABA, DB_USER, DB_PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare('SELECT 
                                 Cpo_Id
                                ,Cpo_NomCome
                            from ADCATPRO 
                            WHERE Cpo_NomCome LIKE :phrase 
                            AND Cpo_Estatus = 1');
        $stmt->execute(array('phrase' => '%'.$_GET['phrase'].'%'));

        while($row = $stmt->fetch()) {
            $return_arr[] = array('provid' => $row['Cpo_Id'], 'provname' => utf8_encode($row['Cpo_NomCome']));
        }
    }catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    /* Toss back results as json encoded array. */
    echo json_encode($return_arr);
}
?>