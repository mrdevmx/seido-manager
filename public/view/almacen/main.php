<div class="content-body">
    <div class="container-fluid">
        <div class="form-head d-flex mb-3 align-items-start">
            <div class="mr-auto d-none d-lg-block">
                <h2 class="text-black font-w600 mb-0">Almacen</h2>
                <p class="mb-0">Dashboard</p>
            </div>
            <div class="dropdown custom-dropdown ml-3">
                <button type="button" class="btn btn-primary d-flex align-items-center svg-btn"
                    data-toggle="modal" data-target="#modalEntrada">
                    <i class="la la-mail-forward"></i>
                    <span class="fs-16 ml-3">Registrar entrada</span>
                </button>
            </div>
            <div class="dropdown custom-dropdown ml-3">
                <button type="button" class="btn btn-primary d-flex align-items-center svg-btn"
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
                                    <div class="form-group col-md-4 input-info">
                                        <label>Proveedor</label>
                                        <input type="text" id="provname" name="provname" class="form-control"
                                            placeholder="" onchange="onoff()">
                                        <input type="text" id="provid" name="provid" class="form-control" placeholder=""
                                            style="display:none;">
                                    </div>
                                    <div class="form-group col-md-3 input-info">
                                        <label>Fecha Entrada</label>
                                        <input type="date" id="fecentra" name="fecentra" class="form-control"
                                            placeholder="">
                                    </div>
                                    <div class="form-group col-md-2 input-info">
                                        <label>No. Requisición</label>
                                        <input type="text" id="requi" name="requi" class="form-control">
                                    </div>
                                    <div class="form-group col-sm-3 input-info">
                                        <label>Recibe</label>
                                        <select class="form-control" id="recibe" name ="recibe">
                                            <?php print $usuarioSelect; ?>
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
                                    <div class="form-group col-md-2 input-info">
                                        <label>Solicita</label>
                                        <input type="text" id="solicita" name="solicita" class="form-control" onchange="onoffs()">
                                    </div>
                                    <div class="form-group col-md-2 input-info">
                                        <label>Autoriza</label>
                                        <input type="text" id="autoriza" name="autoriza" class="form-control" onchange="onoffs()">
                                    </div>
                                    <div class="form-group col-sm-2 input-info">
                                        <label>Entrega</label>
                                        <select class="form-control" id="entrega" name ="entrega">
                                            <?php print $usuarioSelect; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 input-info">
                                        <label>Fecha Salida</label>
                                        <input type="date" id="fecsale" name="fecsale" class="form-control"
                                            placeholder="">
                                    </div>
                                    <div class="form-group col-md-3 input-info">
                                            <label>Destino</label>
                                            <select multiple class="form-control" id="destino">
                                            <option>Casa 47 - Jacaranda</option>
                                                <option>Casa 48 - Jacaranda</option>
                                                <option>Casa 49 - Jacaranda</option>
                                                <option>Casa 50 - Jacaranda</option>
                                                <option>Casa 51 - Jacaranda</option>
                                                <option>Casa 52 - Jacaranda</option>
                                                <option>Casa 54 - Jacaranda</option>
                                                <option>Casa 55 - Jacaranda</option>
                                                <option>Casa 56 - Jacaranda</option>
                                                <option>Casa 57 - Jacaranda</option>
                                                <option>Casa 58 - Jacaranda</option>
                                                <option>Casa 59 - Jacaranda</option>
                                                <option>Casa 60 - Jacaranda</option>
                                                <option>Casa 61 - Jacaranda</option>
                                                <option>Casa 62 - Jacaranda</option>
                                                <option>Casa 63 - Jacaranda</option>
                                                <option>Casa 64 - Jacaranda</option>
                                                <option>Casa 65 - Jacaranda</option>
                                                <option>Casa 66 - Jacaranda</option>
                                                <option>Casa 67 - Jacaranda</option>
                                                <option>Casa 68 - Jacaranda</option>
                                                <option>Casa 69 - Jacaranda</option>
                                                <option>Casa 70 - Flor de Mayo</option>
                                                <option>Casa 71 - Flor de Mayo</option>
                                                <option>Casa 72 - Flor de Mayo</option>
                                                <option>Casa 73 - Flor de Mayo</option>
                                                <option>Casa 74 - Flor de Mayo</option>
                                                <option>Casa 75 - Flor de Mayo</option>
                                                <option>Casa 76 - Flor de Mayo</option>
                                                <option>Casa 77 - Flor de Mayo</option>
                                                <option>Casa 78 - Flor de Mayo</option>
                                                <option>Casa 79 - Flor de Mayo</option>
                                                <option>Casa 80 - Flor de Mayo</option>
                                                <option>Casa 81 - Flor de Mayo</option>
                                                <option>Casa 82 - Flor de Mayo</option>
                                                <option>Casa 83 - Flor de Mayo</option>
                                                <option>Casa 84 - Flor de Mayo</option>
                                                <option>Casa 85 - Flor de Mayo</option>
                                                <option>Casa 86 - Flor de Mayo</option>
                                                <option>Casa 87 - Flor de Mayo</option>
                                                <option>Casa 88 - Flor de Mayo</option>
                                                <option>Casa 89 - Flor de Mayo</option>
                                                <option>Casa 90 - Lluvia de oro</option>
                                                <option>Casa 91 - Lluvia de oro</option>
                                                <option>Casa 92 - Lluvia de oro</option>
                                                <option>Casa 93 - Lluvia de oro</option>
                                                <option>Casa 94 - Lluvia de oro</option>
                                                <option>Casa 95 - Lluvia de oro</option>
                                                <option>Casa 96 - Lluvia de oro</option>
                                                <option>Casa 97 - Lluvia de oro</option>
                                                <option>Casa 98 - Lluvia de oro</option>
                                                <option>Casa 99 - Lluvia de oro</option>
                                                <option>Casa 100 - Lluvia de oro</option>
                                                <option>Casa 101 - Lluvia de oro</option>
                                                <option>Casa 102 - Lluvia de oro</option>
                                                <option>Casa 103 - Lluvia de oro</option>
                                                <option>Casa 104 - Lluvia de oro</option>
                                                <option>Casa 105 - Lluvia de oro</option>
                                                <option>Casa 106 - Lluvia de oro</option>
                                                <option>Casa 107 - Lluvia de oro</option>
                                                <option>Casa 108 - Lluvia de oro</option>
                                                <option>Casa 109 - Lluvia de oro</option>
                                                <option>Casa 110 - Lluvia de oro</option>
                                                <option>Casa 111 - Lluvia de oro</option>
                                                <option>Casa 112 - Lluvia de oro</option>
                                                <option>Casa 113 - Lluvia de oro</option>
                                                <option>Casa 114 - Lluvia de oro</option>
                                                <option>Casa 1 - Tikal</option>
                                                <option>Casa 2 - Tikal</option>
                                                <option>Casa 3 - Tikal</option>
                                                <option>Casa 4 - Tikal</option>
                                                <option>Casa 5 - Tikal</option>
                                                <option>Casa 6 - Tikal</option>
                                                <option>Casa 7 - Tikal</option>
                                                <option>Casa 8 - Tikal</option>
                                                <option>Casa 9 - Tikal</option>
                                                <option>Casa 10 - Tikal</option>
                                                <option>Casa 11 - Tikal</option>
                                                <option>Casa 12 - Tikal</option>
                                                <option>Casa 13 - Tikal</option>
                                                <option>Casa 14 - Tikal</option>
                                                <option>Casa 15 - Tikal</option>
                                                <option>Casa 16 - Tikal</option>
                                                <option>Casa 17 - Tikal</option>
                                                <option>Casa 18 - Tikal</option>
                                                <option>Casa 19 - Tikal</option>
                                                <option>Casa 20 - Tikal</option>
                                                <option>Casa 21 - Tikal</option>
                                                <option>Casa 22 - Tikal</option>
                                                <option>Casa 23 - Tikal</option>
                                                <option>Casa 24 - Chichénitza</option>
                                                <option>Casa 25 - Chichénitza</option>
                                                <option>Casa 26 - Chichénitza</option>
                                                <option>Casa 27 - Chichénitza</option>
                                                <option>Casa 28 - Chichénitza</option>
                                                <option>Casa 29 - Chichénitza</option>
                                                <option>Casa 30 - Chichénitza</option>
                                                <option>Casa 31 - Chichénitza</option>
                                                <option>Casa 32 - Chichénitza</option>
                                                <option>Casa 33 - Chichénitza</option>
                                                <option>Casa 34 - Chichénitza</option>
                                                <option>Casa 35 - Chichénitza</option>
                                                <option>Casa 36 - Chichénitza</option>
                                                <option>Casa 37 - Chichénitza</option>
                                                <option>Casa 38 - Chichénitza</option>
                                                <option>Casa 39 - Chichénitza</option>
                                                <option>Casa 40 - Chichénitza</option>
                                                <option>Casa 41 - Chichénitza</option>
                                                <option>Casa 42 - Chichénitza</option>
                                                <option>Casa 43 - Chichénitza</option>
                                                <option>Casa 44 - Copán</option>
                                                <option>Casa 45 - Copán</option>
                                                <option>Casa 46 - Copán</option>
                                                <option>Casa 47 - Copán</option>
                                                <option>Casa 48 - Copán</option>
                                                <option>Casa 49 - Copán</option>
                                                <option>Casa 50 - Copán</option>
                                                <option>Casa 51 - Copán</option>
                                                <option>Casa 52 - Copán</option>
                                                <option>Casa 53 - Copán</option>
                                                <option>Casa 54 - Copán</option>
                                                <option>Casa 55 - Copán</option>
                                                <option>Casa 56 - Copán</option>
                                                <option>Casa 57 - Copán</option>
                                                <option>Casa 58 - Copán</option>
                                                <option>Casa 59 - Copán</option>
                                                <option>Casa 60 - Copán</option>
                                                <option>Casa 61 - Copán</option>
                                                <option>Casa 62 - Copán</option>
                                                <option>Casa 63 - Copán</option>
                                                <option>Casa 64 - Copán</option>
                                                <option>Casa 65 - Copán</option>
                                                <option>Casa 66 - Copán</option>
                                                <option>Casa 67 - Copán</option>
                                                <option>Casa 68 - Copán</option>
                                                <option>Casa 69 - Caracol</option>
                                                <option>Casa 70 - Caracol</option>
                                                <option>Casa 71 - Caracol</option>
                                                <option>Casa 72 - Caracol</option>
                                                <option>Casa 73 - Caracol</option>
                                                <option>Casa 74 - Caracol</option>
                                                <option>Casa 75 - Caracol</option>
                                                <option>Casa 76 - Caracol</option>
                                                <option>Casa 77 - Caracol</option>
                                                <option>Casa 78 - Caracol</option>
                                                <option>Casa 79 - Caracol</option>
                                                <option>Casa 80 - Caracol</option>
                                                <option>Casa 81 - Caracol</option>
                                                <option>Casa 82 - Caracol</option>
                                                <option>Casa 83 - Caracol</option>
                                                <option>Casa 84 - Caracol</option>
                                                <option>Casa 85 - Caracol</option>
                                                <option>Casa 86 - Caracol</option>
                                                <option>Casa 87 - Caracol</option>
                                                <option>Casa 88 - Caracol</option>
                                                <option>Casa 89 - Caracol</option>
                                                <option>Casa 90 - Caracol</option>
                                                <option>Casa 91 - Caracol</option>
                                                <option>Casa 92 - Palenque</option>
                                                <option>Casa 93 - Palenque</option>
                                                <option>Casa 94 - Palenque</option>
                                                <option>Casa 95 - Palenque</option>
                                                <option>Casa 96 - Palenque</option>
                                                <option>Casa 97 - Palenque</option>
                                                <option>Casa 98 - Palenque</option>
                                                <option>Casa 99 - Palenque</option>
                                                <option>Casa 100 - Palenque</option>
                                                <option>Casa 101 - Palenque</option>
                                                <option>Casa 102 - Palenque</option>
                                                <option>Casa 103 - Palenque</option>
                                                <option>Casa 104 - Palenque</option>
                                                <option>Casa 105 - Palenque</option>
                                                <option>Casa 106 - Palenque</option>
                                                <option>Casa 107 - Palenque</option>
                                                <option>Casa 108 - Palenque</option>
                                                <option>Casa 109 - Palenque</option>
                                                <option>Casa 110 - Palenque</option>
                                                <option>Casa 111 - Palenque</option>
                                                <option>Casa 112 - Palenque</option>
                                                <option>Casa 113 - Palenque</option>
                                                <option>Casa 114 - Palenque</option>
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
            <div class="col-xl-6 col-lg-12">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <h4 class="card-title">Timeline</h4>
                    </div>
                    <div class="card-body">
                        <div id="DZ_W_TimeLine" class="widget-timeline dz-scroll">
                            <ul class="timeline">
                                <?php print $timelineMovimientosResumen; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12">
                <div class="card">
                    <div class="card-header  border-0 pb-0">
                        <h4 class="card-title">Entradas, Salidas y Notificaciones</h4>
                    </div>
                    <div class="card-body"> 
                        <div id="DZ_W_Todo1" class="widget-media dz-scroll" style="height:400px;">
                            <ul class="timeline">
                                <li>
                                    <div class="timeline-panel">
			    						<div class="media mr-2 media-warning">
			    							<i class="la la-exclamation"></i>
			    						</div>
                                        <div class="media-body">
			    							<h5 class="mb-1">Dr sultads Send you Photo</h5>
			    							<small class="d-block">29 July 2020 - 02:26 PM</small>
			    						</div>
			    						<div class="dropdown">
			    							<button type="button" class="btn btn-warning light sharp" data-toggle="dropdown">
			    								<svg width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
			    							</button>
			    							<div class="dropdown-menu">
			    								<a class="dropdown-item" href="#">Edit</a>
			    								<a class="dropdown-item" href="#">Delete</a>
			    							</div>
			    						</div>
			    					</div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
			    						<div class="media mr-2 media-danger">
			    							<i class="la la-times-circle-o"></i>
			    						</div>
			    						<div class="media-body">
			    							<h5 class="mb-1">Resport created successfully</h5>
			    							<small class="d-block">29 July 2020 - 02:26 PM</small>
			    						</div>
			    						<div class="dropdown">
			    							<button type="button" class="btn btn-danger light sharp" data-toggle="dropdown">
			    								<svg width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
			    							</button>
			    							<div class="dropdown-menu">
			    								<a class="dropdown-item" href="#">Edit</a>
			    								<a class="dropdown-item" href="#">Delete</a>
			    							</div>
			    						</div>
			    					</div>
                                </li>
			    				 <li>
                                    <div class="timeline-panel">
			    						<div class="media mr-2 media-info">
			    							<i class="la la-flag-o"></i>
			    						</div>
                                        <div class="media-body">
			    							<h5 class="mb-1">Dr sultads Send you Photo</h5>
			    							<small class="d-block">29 July 2020 - 02:26 PM</small>
			    						</div>
			    						<div class="dropdown">
			    							<button type="button" class="btn btn-info light sharp" data-toggle="dropdown">
			    								<svg width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
			    							</button>
			    							<div class="dropdown-menu">
			    								<a class="dropdown-item" href="#">Edit</a>
			    								<a class="dropdown-item" href="#">Delete</a>
			    							</div>
			    						</div>
			    					</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
			</div>
            <div class="col-xl-12">
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