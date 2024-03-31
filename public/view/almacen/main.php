<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Kardex del día</h4>
                    <span>Element</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Almacen</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Kardex</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="container"><h4 class="card-title">Movimientos al <?php echo strftime("%A %d de %B del %Y");?></h4></div>
                        <div class="container text-right">
                        <button type="button" id="btnaddus" class="btn btn-sm btn-primary mb-2" data-toggle="modal"
                            data-target="#modalEntrada">Registrar Entrada</button>
                            <button type="button" id="btnaddus" class="btn btn-sm btn-primary mb-2" data-toggle="modal"
                            data-target="#modalEntrada">Registrar Salida</button>
                        </div>
                        <div class="modal fade" id="modalEntrada"  data-backdrop="static">
                            <div class="modal-dialog modal-lg modal-dialog" role="document" style="max-width: 90%;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><label id="titleus">Registrar Entrada</label></h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="basic-form">
                                            <form id="frmregent" name="frmregent" method="post"
                                                enctype="multipart/form-data">
                                                <div class="form-group row" style="display:none">
                                                    <label class="col-sm-4 col-form-label">Modo</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="modo" name="modo" class="form-control"
                                                            value="0">
                                                            <input type="text" id="id" name="id" class="form-control"
                                                            value="0">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>Proveedor</label>
                                                        <input type="text" id="prov" name="prov" class="producto form-control" placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label>No. Requisición</label>
                                                        <input type="text" id="requi" name="requi" class="form-control">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label>Factura</label>
                                                        <input type="text" id="recibe" name="recibe" class="form-control">
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="container-fluid">
                                                <button type="button" class="btn btn-success btn-sm" id="agregar">Agregar Producto <span class="btn-icon-right"><i class="fa fa-plus"></i></span></button>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-danger light"
                                            data-dismiss="modal">Cerrar</button>
                                        <a href="javascript:void()" id="btnfrmuser"
                                            class="btn btn-sm btn-primary text-white">Agregar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="modalUsuarioContrasenia">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Cambiar Contraseña</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="basic-form">
                                            <form id="frmusercontrasenia" name="frmusercontrasenia" method="post"
                                                enctype="multipart/form-data">
                                                <div class="form-group row" style="display:none">
                                                    <label class="col-sm-4 col-form-label">id</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="idcontrasenia" name="idcontrasenia" class="form-control"
                                                            value="0">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label id="newpass"
                                                        class="col-sm-4 col-form-label">Nueva Contraseña</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="contrasenaid" name="contrasenaid"
                                                            class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-danger light"
                                            data-dismiss="modal">Cerrar</button>
                                        <a href="javascript:void()" id="btncontrasenia"
                                            class="btn btn-sm btn-primary text-white">Actualizar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Estatus</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php print $table; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Estatus</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>