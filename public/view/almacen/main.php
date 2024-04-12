<div class="content-body">
    <div class="container-fluid">
        <div class="form-head d-flex mb-3 align-items-start">
            <div class="mr-auto d-none d-lg-block">
                <h2 class="text-black font-w600 mb-0">Almacen</h2>
                <p class="mb-0">Dashboard</p>
            </div>
            <div class="dropdown custom-dropdown ml-3">
                <button type="button" class="btn btn-primary light d-flex align-items-center svg-btn"
                    data-toggle="modal" data-target="#modalEntrada">
                    <i class="la la-mail-forward"></i>
                    <span class="fs-16 ml-3">Registrar entrada</span>
                </button>
            </div>
            <div class="dropdown custom-dropdown ml-3">
                <button type="button" class="btn btn-primary light d-flex align-items-center svg-btn"
                    data-toggle="modal" data-target="#modalSalida">
                    <i class="la la-mail-reply"></i>
                    <span class="fs-16 ml-3">Registrar salida</span>
                </button>
            </div>
        </div>
        <div class="modal fade" id="modalEntrada" data-backdrop="static">
            <div class="modal-dialog modal-lg modal-dialog" role="document" style="max-width: 90%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><label id="titleus">Registrar Entrada</label></h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="basic-form">
                            <form id="frmregent" name="frmregent" method="post" enctype="multipart/form-data">
                                <div class="form-group row" style="display:none">
                                    <label class="col-sm-4 col-form-label">Modo</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="modo" name="modo" class="form-control" value="1">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6 input-info">
                                        <label>Proveedor</label>
                                        <input type="text" id="provname" name="provname" class="form-control"
                                            placeholder="" onchange="onoff()">
                                        <input type="text" id="provid" name="provid" class="form-control" placeholder=""
                                            style="display:none;">
                                    </div>
                                    <div class="form-group col-md-3 input-info">
                                        <label>No. Requisición</label>
                                        <input type="text" id="requi" name="requi" class="form-control">
                                    </div>
                                    <div class="form-group col-md-3 input-info">
                                        <label>Recibe</label>
                                        <input type="text" id="recibe" name="recibe" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4" id="producto">
                                        <label>Producto</label>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Unidad</label>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label>Cantidad</label>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>P.U</label>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Total</label>
                                    </div>
                                </div>
                            </form>
                            <div class="container-fluid">
                                <button type="button" class="btn btn-primary btn-sm" id="agregar" disabled>Agregar
                                    Producto <span class="btn-icon-right"><i class="fa fa-plus"></i></span></button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Cerrar</button>
                        <a href="javascript:void()" id="btn-send" class="btn btn-sm btn-primary text-white">Agregar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalSalida" data-backdrop="static">
            <div class="modal-dialog modal-lg modal-dialog" role="document" style="max-width: 90%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><label id="titleus">Registrar Salida</label></h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="basic-form">
                            <form id="frmrsalidas" name="frmrsalidas" method="post" enctype="multipart/form-data">
                                <div class="form-group row" style="display:none">
                                    <label class="col-sm-4 col-form-label">Modo</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="modos" name="modos" class="form-control" value="2">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3 input-info">
                                        <label>Solicita</label>
                                        <input type="text" id="solicita" name="solicita" class="form-control" onchange="onoffs()">
                                    </div>
                                    <div class="form-group col-md-3 input-info">
                                        <label>Autoriza</label>
                                        <input type="text" id="autoriza" name="autoriza" class="form-control" onchange="onoffs()">
                                    </div>
                                    <div class="form-group col-md-3 input-info">
                                        <label>Entrega</label>
                                        <input type="text" id="entrega" name="entrega" class="form-control" onchange="onoffs()">
                                    </div>
                                    <div class="form-group col-md-3 input-info">
                                            <label>Destino</label>
                                            <select multiple class="form-control" id="destino">
                                                <option>Ext - Fachada Principal</option>
                                                <option>Ext - Fachada Posterior</option>
                                                <option>Ext - Patio Servicio</option>
                                                <option>Ext - Lateral</option>
                                                <option>Int - P.B Muros</option>
                                                <option>Int - P.B Plafones</option>
                                                <option>Int - P.B Piso</option>
                                                <option>Int - P.A Muros</option>
                                                <option>Int - P.A Plafones</option>
                                                <option>Int - P.A Piso</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4" id="producto">
                                        <label>Producto</label>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Unidad</label>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label>Existencia</label>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label>Cantidad</label>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Comentario</label>
                                    </div>
                                </div>
                            </form>
                            <div class="container-fluid">
                                <button type="button" class="btn btn-primary btn-sm" id="agregarsalida" disabled>Agregar
                                    Producto <span class="btn-icon-right"><i class="fa fa-plus"></i></span></button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Cerrar</button>
                        <a href="javascript:void()" id="btn-send-salida" class="btn btn-sm btn-primary text-white">Agregar</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-4 col-lg-12">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <h4 class="card-title">Timeline</h4>
                    </div>
                    <div class="card-body">
                        <div id="DZ_W_TimeLine" class="widget-timeline dz-scroll" style="height:370px;">
                            <ul class="timeline">
                                <?php print $timelineMovimientosResumen; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <div class="container">
                            <h4 class="card-title">Kardex</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Entradas</th>
                                        <th>Salidas</th>
                                        <th>Existencia</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php print $tableKardex; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Entradas</th>
                                        <th>Salidas</th>
                                        <th>Existencia</th>
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