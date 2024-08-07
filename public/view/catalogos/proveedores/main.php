<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Catálogo Proveedores</h4>
                    <span>Element</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Catálogos</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Proveedores</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Listado de Proveedores</h4>
                        <button type="button" id="btnaddus" class="btn btn-sm btn-primary mb-2" data-toggle="modal"
                            data-target="#modalProveedor">Agregar Proveedor</button>
                        <div class="modal fade" id="modalProveedor">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><label id="titleus">Nuevo Proveedor</label></h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="basic-form">
                                            <form id="frmproveedor" name="frmproveedor" method="post"
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
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Nombre comercial</label>
                                                    <div class="col-sm-8 input-info">
                                                        <input type="text" id="nomco" name="nomco"
                                                            class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Razon social</label>
                                                    <div class="col-sm-8 input-info">
                                                        <input type="text" id="raso" name="raso"
                                                            class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">RFC</label>
                                                    <div class="col-sm-8 input-info">
                                                        <input type="text" id="rfc" name="rfc"
                                                            class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Telefono</label>
                                                    <div class="col-sm-8 input-info">
                                                        <input type="text" id="tel" name="tel"
                                                            class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">RegimenFiscal</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="regimen" name ="regimen">
                                                        <option value="0">Seleccione</option>
                                                            <?php print $selectRegimen; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-danger light"
                                            data-dismiss="modal">Cerrar</button>
                                        <a href="javascript:void()" id="btn-guarda-proveedor"
                                            class="btn btn-sm btn-primary text-white">Agregar</a>
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
                                        <th>RFC</th>
                                        <th>Nombre Comercial</th>
                                        <th>Telefono</th>
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
                                        <th>RFC</th>
                                        <th>Nombre Comercial</th>
                                        <th>Telefono</th>
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