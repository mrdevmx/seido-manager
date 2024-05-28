<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Catálogo Productos</h4>
                    <span>Element</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Catálogos</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Productos</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Listado de Productos</h4>
                        <button type="button" id="btnaddus" class="btn btn-sm btn-primary mb-2" data-toggle="modal"
                            data-target="#modalArticulo">Agregar Producto</button>
                        <div class="modal fade" id="modalArticulo">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><label id="titleus">Nuevo Producto</label></h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="basic-form">
                                            <form id="frmproducto" name="frmproducto" method="post"
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
                                                    <label class="col-sm-4 col-form-label">Producto</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="producto" name="producto"
                                                            class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Unidad</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="multi-value-select">
                                                            <?php print $selectUnidades; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Proveedor</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="multi-value-select" multiple="multiple">
                                                            <option selected="selected">orange</option>
                                                            <option>white</option>
                                                            <option selected="selected">purple</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-danger light"
                                            data-dismiss="modal">Cerrar</button>
                                        <a href="javascript:void()" id="btnfrmproducto"
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
                                        <th>Descripción</th>
                                        <th>SKU</th>
                                        <th>Unidad</th>
                                        <th>Precio</th>
                                        <th>Proveedor</th>
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
                                        <th>Descripción</th>
                                        <th>SKU</th>
                                        <th>Unidad</th>
                                        <th>Precio</th>
                                        <th>Proveedor</th>
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