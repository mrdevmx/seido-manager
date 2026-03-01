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
                                                <?php print $andadorSelect; ?>   
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
                                <?php if (isset($notifications)) { print $notifications; } else { ?>
                                <li>
                                    <div class="timeline-panel">
                                        <div class="media mr-2 media-info">
                                            <i class="la la-info"></i>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">No hay notificaciones</h5>
                                        </div>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>

                            <!-- Modal para ver detalle de notificaciones agrupadas -->
                                                        <div class="modal fade" id="notifModal" tabindex="-1" role="dialog" aria-labelledby="notifModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-md" role="document" style="max-width:900px;">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="notifModalLabel">Notificaciones</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div id="notifModalBody">
                                      <!-- Contenido generado por JS -->
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <?php if (isset($notificationsData)) { ?>
                            <script>
                                window.notifications = <?php echo json_encode($notificationsData, JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT); ?>;
                            </script>
                            <?php } else { ?>
                            <script>window.notifications = {};</script>
                            <?php } ?>

                            <script>
                            (function(){
                                function escapeHtml(str){
                                    if(str === null || str === undefined) return '';
                                    return String(str)
                                        .replace(/&/g, '&amp;')
                                        .replace(/</g, '&lt;')
                                        .replace(/>/g, '&gt;')
                                        .replace(/"/g, '&quot;')
                                        .replace(/'/g, '&#039;');
                                }

                                function renderTableForType(type, items){
                                    if(!items || items.length === 0){
                                        return '<div class="alert alert-info">No hay elementos para este tipo de notificación.</div>';
                                    }
                                    // Mapas de encabezados por tipo: [ [key,label], ... ] en el orden deseado
                                    var headerMap = {
                                        'low_stock': [ ['producto','Producto'], ['existencia','Existencia'], ['last_ent','Últ. entrada'], ['last_sal','Últ. salida'], ['ultima_entrada','Últ. entrada'], ['ultima_salida','Últ. salida'] ],
                                        'zero_stock': [ ['producto','Producto'], ['existencia','Existencia'], ['last_ent','Últ. entrada'], ['last_sal','Últ. salida'], ['ultima_entrada','Últ. entrada'], ['ultima_salida','Últ. salida'] ],
                                        'negative': [ ['producto','Producto'], ['existencia','Existencia'], ['last_ent','Últ. entrada'], ['last_sal','Últ. salida'] ],
                                        'high_consumption': [ ['producto','Producto'], ['current_month_cnt','Salidas (mes actual)'], ['prev_month_cnt','Salidas (mes anterior)'], ['diferencia','Diferencia'] ],
                                        'no_movement': [ ['producto','Producto'], ['ultima_ent','Últ. entrada'], ['ultima_sal','Últ. salida'] ],
                                        'pending': null
                                    };

                                    var columns = [];
                                    var labels = {};
                                    if(headerMap[type]){
                                        headerMap[type].forEach(function(pair){
                                            var k = pair[0];
                                            var l = pair[1];
                                            // include if the key exists in items OR it's a computed column like 'diferencia'
                                            if(items.length > 0 && ((k in items[0]) || k === 'diferencia')){
                                                columns.push(k);
                                                labels[k] = l;
                                            }
                                        });
                                    }

                                    // Si no se definió un mapa o quedó vacío, usar claves del primer item
                                    if(columns.length === 0){
                                        var ks = Object.keys(items[0]);
                                        ks.forEach(function(k){ columns.push(k); labels[k] = k.replace(/_/g,' '); });
                                    }

                                    var html = '<div class="table-responsive"><table class="table table-sm"><thead><tr>';
                                    columns.forEach(function(k){ html += '<th>'+escapeHtml(labels[k])+'</th>'; });
                                    html += '</tr></thead><tbody>';
                                    items.forEach(function(it){
                                        html += '<tr>';
                                        columns.forEach(function(k){
                                            var v = '';
                                            if(k === 'diferencia'){
                                                var curr = Number(it.current_month_cnt || it.current_month || 0);
                                                var prev = Number(it.prev_month_cnt || it.prev_month || 0);
                                                v = curr - prev;
                                            } else if(k in it){
                                                v = it[k] !== null ? it[k] : '';
                                            }
                                            html += '<td>'+escapeHtml(v)+'</td>';
                                        });
                                        html += '</tr>';
                                    });
                                    html += '</tbody></table></div>';
                                    return html;
                                }

                                document.addEventListener('click', function(e){
                                    var target = e.target;
                                    // find closest .view-notif button
                                    while(target && target !== document){
                                        if(target.classList && target.classList.contains('view-notif')) break;
                                        target = target.parentNode;
                                    }
                                    if(!target || target === document) return;
                                    var type = target.getAttribute('data-type');
                                    var items = (window.notifications && window.notifications[type]) ? window.notifications[type] : [];
                                    var titleMap = {
                                        'negative':'Existencia negativa',
                                        'pending':'Entradas pendientes',
                                        'low_stock':'Baja existencia',
                                        'high_consumption':'Aumento de consumo',
                                        'no_movement':'Sin movimiento'
                                    };
                                    var label = titleMap[type] || 'Notificaciones';
                                    var modalLabel = document.getElementById('notifModalLabel');
                                    var modalBody = document.getElementById('notifModalBody');
                                    if(modalLabel) modalLabel.textContent = label;
                                    if(modalBody) modalBody.innerHTML = renderTableForType(type, items);
                                    // allow bootstrap to open the modal via data-toggle attribute; if not, try to open via jQuery if available
                                    // (we avoid depending on jQuery here)
                                });
                            })();
                            </script>
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