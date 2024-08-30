<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Catálogo Usuarios</h4>
                    <span>Element</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Catálogos</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Usuarios</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Listado de Usuarios</h4>
                        <button type="button" id="btnaddus" class="btn btn-sm btn-primary mb-2" data-toggle="modal"
                            data-target="#modalUsuario">Agregar Usuario</button>
                        <div class="modal fade" id="modalUsuario">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><label id="titleus">Agregar Nuevo</label> Usuario</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="basic-form">
                                            <form id="frmuser" name="frmuser" method="post"
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
                                                    <label class="col-sm-4 col-form-label">Nombre</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="nombre" name="nombre"
                                                            class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Apellido</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="apellido" name="apellido"
                                                            class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Correo</label>
                                                    <div class="col-sm-8 input-group">
                                                        <input type="text" id="correo" name="correo"
                                                            class="form-control" placeholder="">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">@arctec.com.mx</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row" id="hiddencon">
                                                    <label id="newpass"
                                                        class="col-sm-4 col-form-label">Contraseña</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="contrasena" name="contrasena"
                                                            class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Tipo Usuario</label>
                                                    <div class="col-sm-8">
                                                        <select id="tipous" name="tipous" class="form-control">
                                                            <option value="selected">Seleccione</option>
                                                            <option value="2">Administrador</option>
                                                            <option value="3">Contador</option>
                                                            <option value="4">Auxiliar Administrativo</option>
                                                            <option value="5">Auxiliar Contable</option>
                                                            <option value="6">Almacenista</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-danger light"
                                            data-dismiss="modal">Cerrar</button>
                                        <a href="javascript:void()" id="btn-guarda-usuario"
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
                                                        <input type="text" id="idmodo" name="idmodo" class="form-control"
                                                            value="3">
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