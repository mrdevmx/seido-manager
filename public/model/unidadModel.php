<?php
/*
****************************************************************************
** DESCRIPCION: Modelo unidades					                        ****
****************************************************************************
** REFERENCIAS:                                                         ****
****************************************************************************
** Creó:       Jesus Alberto Martinez Rodriguez						    ****
** Fecha:		28/Mayo/2024											****
****************************************************************************
*/
class unidadesModel{
    private $table = 'ADCATUNI';
    private $db;
    private $typeConnection = 2;
    private $unidades;
    private $tableView;
    private $selectView;
 
    public function __construct(){
        $this->db=Conectar::conexion($this->typeConnection);
        $this->unidades=array();
    }
    public function getunidades(){
        $query=$this->db->query("select 
                                     Cun_Id
                                    ,Cun_Clave
                                    ,Cun_NomClav
                                    ,Cun_Tipo
                                    ,convert(Cun_FecAlta, char(10)) as Cri_FecAlta
                                    ,convert(Cun_FecModi, char(10)) as Cun_FecModi
                                    ,Cun_Estatus
                                from ".$this -> table);
        if ($query->num_rows > 0) {
            while($row=$query->fetch_assoc()){
                $this->unidades[]=$row;
            }
        }else{
            return false;
        }
        $this->db->close();
        return $this->unidades;
    }

    public function getUnidadById($id){
		$query=$this->db->query("select
                                     Cun_Id
                                    ,Cun_Clave
                                    ,Cun_NomClav
                                    ,Cun_Tipo
                                    ,convert(Cun_FecAlta, char(10)) as Cun_FecAlta
                                    ,convert(Cun_FecModi, char(10)) as Cun_FecModi
                                    ,Cun_Estatus 
                                from ".$this->table." 
                                where Cun_Id = ".$id);
        if ($query->num_rows > 0) {
		    while($row=$query->fetch_assoc()){
                $this->unidades[]=$row;
            }
        }else{
            return false;
        }

		$this->db->close();
        return $this->unidades;
	}

    public function getUnidadesTable(){
        $unidades=$this->getunidades();
        $i=1;
        foreach($unidades as $unidad){
            $estatus = ($unidad["Cun_Estatus"] == 1) ? '<span class="badge light badge-success"><i class="fa fa-circle text-success mr-1"></i>Activo</span>' : '<span class="badge light badge-danger"><i class="fa fa-circle text-danger mr-1"></i>Inactivo</span>';
            $this->tableView.= <<< EOT
                <tr>
                    <td align="center">$i</td>
                    <td>{$unidad["Cun_Clave"]}</td>
                    <td>{$unidad["Cun_NomClav"]}</td>
                    <td>{$unidad["Cun_Tipo"]}</td>
                    <td>{$unidad["Cun_FecAlta"]}</td>
                    <td>$estatus</td>
                    <td class="text-center">
                    <div class="dropdown ml-auto text-center">
                        <div class="btn-link" data-toggle="dropdown">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" onclick=" return cargardatos({$unidad["Cun_Estatus"]})" href="javascript:void()">Editar</a>
                            <a class="dropdown-item" onclick=" return cargarid({$unidad["Cun_Estatus"]})" data-toggle="modal" data-target="#modalarticuloContrasenia" href="javascript:void()">Cambiar Contraseña</a>
                        </div>
                    </div>
                    </td>
                </tr>
            EOT;
            $i++;
        }
        return $this->tableView;
    }

    public function getUnidadesSelect(){
        $unidades=$this->getunidades();
        $i=1;
        foreach($unidades as $unidad){

            $this->selectView.= <<< EOT
                <option value="{$unidad['Cun_Id']}">{$unidad["Cun_Clave"]} - {$unidad["Cun_NomClav"]}</option>
            EOT;
            $i++;
        }
        return $this->selectView;
    }
}
?>
