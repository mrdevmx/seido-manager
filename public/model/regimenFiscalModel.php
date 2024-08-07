<?php
/*
****************************************************************************
** DESCRIPCION: Modelo Regimen Fiscal catalogo del SAT				    ****
****************************************************************************
** REFERENCIAS:                                                         ****
****************************************************************************
** Creó:       Jesus Alberto Martinez Rodriguez						    ****
** Fecha:		06/Agosto/2024											****
****************************************************************************
*/
class regimenFiscalModel{
    private $table = 'CCREGFIS';
    private $db;
    private $typeConnection = 1;
    private $regimenes;
    private $tableView;
    private $selectView;
 
    public function __construct(){
        $this->db=Conectar::conexion($this->typeConnection);
        $this->regimenes=array();
    }
    public function getRegimenes(){
        $query=$this->db->query("select 
                                     Ref_Id
                                    ,Ref_RegiFis
                                    ,Ref_Descrip
                                    ,Ref_TipoPer
                                    ,convert(Ref_FecAlta, char(10)) as Ref_FecAlta
                                    ,convert(Ref_FecModi, char(10)) as Ref_FecModi
                                    ,Ref_Estatus
                                from ".$this -> table);
        if ($query->num_rows > 0) {
            while($row=$query->fetch_assoc()){
                $this->regimenes[]=$row;
            }
        }else{
            return false;
        }
        $this->db->close();
        return $this->regimenes;
    }

    public function getRegimenById($id){
		$query=$this->db->query("select
                                     Ref_Id
                                    ,Ref_RegiFis
                                    ,Ref_Descrip
                                    ,Ref_TipoPer
                                    ,convert(Ref_FecAlta, char(10)) as Ref_FecAlta
                                    ,convert(Ref_FecModi, char(10)) as Ref_FecModi
                                    ,Ref_Estatus
                                from ".$this->table." where Ref_Id = ".$id);
        if ($query->num_rows > 0) {
		    while($row=$query->fetch_assoc()){
                $this->regimenes[]=$row;
            }
        }else{
            return false;
        }

		$this->db->close();
        return $this->regimenes;
	}

    public function getRegimenesTable(){
        $regimenes=$this->getRegimenes();
        $i=1;
        foreach($regimenes as $regimen){
            $estatus = ($regimen["Ref_Estatus"] == 1) ? '<span class="badge light badge-success"><i class="fa fa-circle text-success mr-1"></i>Activo</span>' : '<span class="badge light badge-danger"><i class="fa fa-circle text-danger mr-1"></i>Inactivo</span>';
            $this->tableView.= <<< EOT
                <tr>
                    <td align="center">$i</td>
                    <td>{$regimen["Ref_RegiFis"]}</td>
                    <td>{$regimen["Ref_Descrip"]}</td>
                    <td>{$regimen["Ref_TipoPer"]}</td>
                    <td>$estatus</td>
                    <td class="text-center">
                    <div class="dropdown ml-auto text-center">
                        <div class="btn-link" data-toggle="dropdown">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" onclick=" return cargardatos({$regimen["Ref_Id"]})" href="javascript:void()">Editar</a>
                        </div>
                    </div>
                    </td>
                </tr>
            EOT;
            $i++;
        }
        return $this->tableView;
    }

    public function getRegimenesSelect(){
        $regimenes=$this->getRegimenes();
        $i=1;
        foreach($regimenes as $regimen){

            $this->selectView.= <<< EOT
                <option value="{$regimen['Ref_RegiFis']}">{$regimen["Ref_RegiFis"]} - {$regimen["Ref_Descrip"]}</option>
            EOT;
            $i++;
        }
        return $this->selectView;
    }

}
?>
