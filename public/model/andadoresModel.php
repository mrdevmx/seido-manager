<?php
/*
****************************************************************************
** DESCRIPCION: Modelo andadores					                        ****
****************************************************************************
** REFERENCIAS:                                                         ****
****************************************************************************
** Creó:       Jazmin Martinez Rodriguez						    ****
** Fecha:		04/Junio/2024											****
****************************************************************************
*/
class andadoresModel{
    private $table = 'ADCATAND';
    PRIVATE $tableCasAnd = 'ADCASAND';
    private $db;
    private $typeConnection = 2;
    private $andadores;

    public function __construct(){
        $this->db=Conectar::conexion($this->typeConnection);
        $this->andadores=array();
    }

    public function getAndadores(){
        $query=$this->db->query("select
                                     Can_Id
                                    ,Can_CodAnd
                                    ,Can_NomAnd
                                    ,Can_FecAlt
                                    ,Can_FecMod
                                    ,Can_Estatu
                                from ".$this -> table);
        if ($query->num_rows > 0) {
            while($row=$query->fetch_assoc()){
                $this->andadores[]=$row;
            }
        }else{
            return false;
        }
        $this->db->close();
        return $this->andadores;
    }

    public function getCasAnd(){
        $result = $this->db->query("select
                                    CAS.Cnd_Id, CAS.Cnd_CodCas, CAS.Cnd_CodAnd, CA.Can_NomAnd
                                from ".$this->tableCasAnd." CAS inner join ".$this->table." CA on CAS.Cnd_CodAnd = CA.Can_CodAnd");
        $casand = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $casand[] = $row;
            }
            $this->db->close();
            return $casand;
        } else {
            $this->db->close();
            return false;
        }
    }
    public function getAndadorById($id){
        $query=$this->db->query("select
                                     Can_Id
                                    ,Can_CodAnd
                                    ,Can_NomAnd
                                    ,Can_FecAlt
                                    ,Can_FecMod
                                    ,Can_Estatu
                                from ".$this->table." where Can_Id = ".$id);
        if ($query->num_rows > 0) {
            $row=$query->fetch_assoc();
            return $row;
        }else{
            return false;
        }
        $this->db->close();
    }
    public function saveAndador($idAnd, $codAnd, $nomAnd, $fecAlt, $fecMod, $estatus){
        if($id == 0){
            $query = $this->db->prepare("INSERT INTO ".$this->table." (Can_CodAnd, Can_NomAnd, Can_FecAlt, Can_FecMod, Can_Estatu) VALUES (?, ?, ?, ?, ?)");
            $query->bind_param($codAnd, $nomAnd, $fecAlt, $fecMod, $estatus);
        } else {
            $query = $this->db->prepare("UPDATE ".$this->table." SET And_Nombre = ?, And_Descripcion = ?, And_Estatu = ? WHERE And_Id = ?");
            $query->bind_param($codAnd, $nomAnd, $fecAlt, $fecMod, $estatus, $idAnd);
        }
        if($query->execute()){
            return true;
        } else {
            return false;
        }
    }
    public function deleteAndador($id){
        $query = $this->db->prepare("DELETE FROM ".$this->table." WHERE Can_Id = ?");
        $query->bind_param("i", $id);
        if($query->execute()){          
            return true;
        } else {
            return false;
        }
    }
    public function getAndadoresTable(){            
        $andadores = $this->getAndadores();
        $i = 1;
        $table = '';
        if($andadores){
            foreach($andadores as $andador){
                $table .= '<tr>';
                $table .= '<td>'.$i.'</td>';
                $table .= '<td>'.$andador['And_Nombre'].'</td>';
                $table .= '<td>'.$andador['And_Descripcion'].'</td>';
                $table .= '<td>'.($andador['And_Estatu'] ? 'Activo' : 'Inactivo').'</td>';
                $table .= '<td>
                            <button class="btn btn-primary" onclick="editAndador('.$andador['And_Id'].')">Editar</button>
                            <button class="btn btn-danger" onclick="deleteAndador('.$andador['And_Id'].')">Eliminar</button>
                           </td>';
                $table .= '</tr>';
                $i++;
            }
        } else {
            $table .= '<tr><td colspan="5">No hay andadores registrados.</td></tr>';
        }
        return $table;
    }
    public function getAndadoresSelect(){
        $andadores = $this->getAndadores();
        $select = '';
        if($andadores){
            foreach($andadores as $andador){
                $select .= '<option value="'.$andador['Can_Id'].'">'.$andador['Can_NomAnd'].'</option>';
            }
        } else {
            $select .= '<option value="">No hay andadores disponibles</option>';
        }
        return $select;
    }
    public function getCasAndSelect(){
        $casand = $this->getCasAnd();
        $select = '';
        if($casand){
            foreach($casand as $casandador){
                $codAgrupador = $casandador['Cnd_CodCas']. '-'. $casandador['Cnd_CodAnd'];
                $select .= '<option value="'.$codAgrupador.'"> CASA '.$casandador['Cnd_CodCas'].' - '.$casandador['Can_NomAnd'].' </option>';
            }
        } else {
            $select .= '<option value="">No hay andadores disponibles</option>';
        }
        return $select;
    }
}