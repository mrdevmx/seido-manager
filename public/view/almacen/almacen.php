<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './view/template/head.php'?>
</head>

<body>
    <?php include './view/template/loader.php'?>
    <div id="main-wrapper">
        <?php include './view/template/header.php'?>
        <?php include './view/template/nav.php'?>
        <?php include 'main.php'?>
    </div>
    <?php include './view/template/scripts.php'?>
</body>
<script>
// custom invoice styles for modal - declare at global scope for print functionality
var invoiceStyles = '\
        <style>\
            :root { --primary-color: #002060; --accent-color: #0047FF; --text-main: #000000; --text-muted: #333333; --bg-page: transparent; --doc-bg: transparent; --table-header-bg: #002060; --table-row-odd: #E0E2E5; --table-row-even: #D5D8DC; }\
            #modalDetalle .modal-body { padding: 0; background-color: var(--doc-bg); border-radius: 4px; overflow: hidden; }\
            #modalDetalle .invoice-container {width: 100%; min-height: 279.4mm; background-color: var(--doc-bg); position: relative; display: flex; flex-direction: column; padding: 40px 20px; font-family: \\\'Montserrat\\\', sans-serif;}\
            #modalDetalle .invoice-header {display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 2px; width: 100%;}\
            #modalDetalle .header-left {padding: 40px 0 0 40px; width: 45%; display: block;}\
            #modalDetalle .logo {height: 70px; margin-bottom: 30px; display: flex; align-items: center; gap: 15px;}\
            #modalDetalle .logo-img {max-width: 280px; max-height: 100%; object-fit: contain;}\
            #modalDetalle .bill-to {display: block;}\
            #modalDetalle .bill-to h3 {font-size: 12px; color: var(--text-main); margin-bottom: 8px; font-weight: 700;}\
            #modalDetalle .bill-to h2 {font-size: 18px; font-weight: 800; color: var(--text-main); margin-bottom: 8px; letter-spacing: 0.5px;}\
            #modalDetalle .bill-to p {font-size: 13px; line-height: 1.5; color: var(--text-main); margin-bottom: 2px;}\
            #modalDetalle .header-right {width: 55%; display: flex; justify-content: flex-end;}\
            #modalDetalle .dark-box {color: #000000; padding: 40px; width: 100%; min-height: max-content; padding-bottom: 50px; text-align: right;}\
            #modalDetalle .dark-box h1 {font-weight: 800; font-size: 42px; letter-spacing: 2px; margin-bottom: 30px; height: 70px; display: flex; align-items: center; justify-content: flex-end; text-transform: uppercase;}\
            #modalDetalle .dark-box-details {display: flex; flex-direction: column; align-items: flex-end; gap: 8px; font-size: 13px;}\
            #modalDetalle .detail-row {display: flex; justify-content: flex-end; gap: 5px; white-space: nowrap; width: 100%;}\
            #modalDetalle .detail-label {font-weight: 600;}\
            #modalDetalle .detail-value {font-weight: 600; text-align: right;}\
            #modalDetalle main {padding: 0 40px; flex-grow: 1; display: flex; flex-direction: column;}\
            #modalDetalle .invoice-table {width: 100%; border-collapse: collapse; margin-bottom: 40px;}\
            #modalDetalle .invoice-table thead {background-color: var(--table-header-bg); color: white;}\
            #modalDetalle .invoice-table th {padding: 12px 15px; font-size: 10px; text-align: left; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;}\
            #modalDetalle .invoice-table th.col-sl {width: 50px; text-align: center;}\
            #modalDetalle .invoice-table th.col-qty, #modalDetalle .invoice-table th.col-price, #modalDetalle .invoice-table th.col-total {text-align: center;}\
            #modalDetalle .invoice-table tbody tr {background-color: var(--table-row-odd); border-bottom: 2px solid var(--doc-bg);}\
            #modalDetalle .invoice-table tbody tr:nth-child(even) {background-color: var(--table-row-even);}\
            #modalDetalle .invoice-table td {padding: 16px 15px; font-size: 11px; color: var(--text-main);}\
            #modalDetalle .invoice-table td strong {font-weight: 700;}\
            #modalDetalle .invoice-table td.col-sl, #modalDetalle .invoice-table td.col-qty, #modalDetalle .invoice-table td.col-price, #modalDetalle .invoice-table td.col-total {text-align: center; font-weight: 600;}\
            #modalDetalle .invoice-summary {display: flex; justify-content: space-between; margin-top: auto; padding-bottom: 30px; width: 100%;}\
            #modalDetalle .summary-left {width: 40%;}\
            #modalDetalle .auth-title {font-size: 12px; font-weight: 800; margin-bottom: 20px; text-transform: uppercase;}\
            #modalDetalle .signature-line {border-bottom: 1px solid var(--text-main); width: 100%; margin-top: 50px;}\
            #modalDetalle .summary-right {width: 45%; display: flex; flex-direction: column; align-items: flex-end;}\
            #modalDetalle .totals-table {width: 100%; border-collapse: collapse;}\
            #modalDetalle .totals-table td {padding: 10px 0; font-size: 12px; font-weight: 700;}\
            #modalDetalle .totals-table td:last-child {text-align: right;}\
            #modalDetalle .totals-table tr {border-bottom: 0px solid #D5D8DC;}\
            #modalDetalle .totals-table tr:last-child {border-bottom: none;}\
            #modalDetalle .grand-total-box {width: 100%; border-top: 2px solid var(--text-main); margin-top: 5px;}\
            #modalDetalle .totals-table tr.grand-total td {font-size: 15px; font-weight: 800; padding-top: 15px; padding-bottom: 15px;}\
            #modalDetalle .invoice-footer {padding: 10px 40px 40px 40px; margin-top: auto;}\
            #modalDetalle .footer-line {border-top: 2px solid #D5D8DC;}\
        </style>';

$(document).ready(function() {
    $('head').append(invoiceStyles);
    $(document).on("click", ".remove .remove_btn", function() {
        // use closest to find the ancestor row even if wrapped by additional divs
        $(this).closest('.remove').remove();
        actualizarTotales();
    });
    $(document).on("click", ".removes .remove_btn", function() {
        $(this).closest('.removes').remove();
    });
    /*$(document).on("keypress", "#div_prov #prov", function (e) {
          console.log(e);
          console.log($(this));
          //prov($(this));
     });*/

});

// handler for clicking on timeline movements (loads modal with detail)
$(document).on('click', '.detalle-movimiento', function(){
    var tipo = $(this).data('tipo');
    var id   = $(this).data('id');
    $.ajax({
        url: './almacen',
        type: 'POST',
        dataType: 'json',
        data: { action: 'detalle', tipo: tipo, id: id },
        success: function(resp){
            console.log('detalle respuesta:', resp);
            var header = resp.header || {};
            var html = '';
            // support alternative key names in case backend returns other aliases
            var requisicion = header.requisicion || header.Ent_Requic || header.Sal_Solici || '';
            var proveedor   = header.proveedor || header.Cpo_NomCome || '';
            var fecha       = header.fecha || header.Ent_FecEnt || header.Sal_FecSal || '';
            var recibe      = header.recibe || header.recibido || '';
            var solicitud   = header.solicitud || header.Sal_Solici || '';
            var solicitante = header.solicitante || header.Sal_SolPer || '';
            var autorizado  = header.autorizado || header.Sal_Autori || '';
            var entregado   = header.entregado || header.Sal_Entreg || '';
            var destino     = header.destino || header.Sal_Destin || '';
            // formato de fecha largo en español
            var formattedDate = '';
            if(fecha){
                try{
                    var d = new Date(fecha);
                    if(!isNaN(d)){
                        formattedDate = d.toLocaleDateString('es-MX', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
                        formattedDate = formattedDate.charAt(0).toUpperCase() + formattedDate.slice(1);
                    } else {
                        formattedDate = fecha;
                    }
                }catch(e){ formattedDate = fecha; }
            }

            // build invoice-like header layout
            html += '<div class="invoice-container">';
            html += '  <header class="invoice-header">';
            html += '    <div class="header-left">';
            html += '      <div class="logo">';
            html += '         <img src="./public/src/images/logotipo-arctec-horizontal.png" alt="Construcciones Arctec Logo" class="logo-img">';
            html += '      </div>';
            html += '      <div class="bill-to">';
            if(tipo == 1){
                html += '        <h3>PROVEEDOR:</h3>';
                html += '        <h2>'+proveedor+'</h2>';
                html += '        <p><strong>Recibe:</strong> '+recibe+'</p>';
            } else {
                html += '        <h3>SOLICITANTE:</h3>';
                html += '        <h2>'+solicitante+'</h2>';
                html += '        <p><strong>Autorizó:</strong> '+autorizado+'</p>';
                html += '        <p><strong>Destino:</strong> '+destino+'</p>';
            }
            html += '      </div>';
            html += '    </div>';
            html += '    <div class="header-right">';
            html += '      <div class="dark-box">';
            html += '        <h1>' + (tipo==1? 'ENTRADA':'SALIDA') + '</h1>';
            html += '        <div class="dark-box-details">';
            html += '          <div class="detail-row">';
            html += '            <span class="detail-label">Fecha:</span>';
            html += '            <span class="detail-value text-right">'+(formattedDate||fecha)+'</span>';
            html += '          </div>';
            if(tipo == 1){
                html += '          <div class="detail-row">';
                html += '            <span class="detail-label">Documento:</span>';
                html += '            <span class="detail-value text-right">Entrada de Almacén</span>';
                html += '          </div>';
                html += '          <div class="detail-row">';
                html += '            <span class="detail-label">Requisición: #</span>';
                html += '            <span class="detail-value">'+requisicion+'</span>';
                html += '          </div>';
            } else {
                html += '          <div class="detail-row">';
                html += '            <span class="detail-label">Solicitud: #</span>';
                html += '            <span class="detail-value">'+solicitud+'</span>';
                html += '          </div>';
            }
            html += '        </div>';
            html += '      </div>';
            html += '    </div>';
            html += '  </header>';

            // MAIN TABLE
            html += '  <main>';
            html += '    <table class="invoice-table">';
            html += '      <thead>';
            html += '        <tr>';
            html += '          <th class="col-sl">N.º</th>';
            html += '          <th class="col-desc">PRODUCTO</th>';
            html += '          <th class="col-qty">CANTIDAD</th>';
            if(tipo == 1){
                html += '          <th class="col-price">P.U.</th>';
                html += '          <th class="col-total">TOTAL</th>';
            } else {
                html += '          <th>COMENTARIO</th>';
            }
            html += '        </tr>';
            html += '      </thead>';
            html += '      <tbody>';
            $.each(resp.productos||[],function(i,p){
                html += '        <tr>';
                html += '          <td class="col-sl">'+(i+1)+'</td>';
                html += '          <td class="col-desc"><strong>'+(p.producto||'')+'</strong></td>';
                html += '          <td class="col-qty">'+(p.cantidad||'')+'</td>';
                if(tipo == 1){
                    var puVal = parseFloat(p.pu) || 0;
                    var totVal = parseFloat(p.total);
                    if(isNaN(totVal)){ totVal = puVal * (parseFloat(p.cantidad) || 0); }
                    var puFmt = puVal.toLocaleString('es-MX', {style: 'currency', currency: 'MXN'});
                    var totFmt = totVal.toLocaleString('es-MX', {style: 'currency', currency: 'MXN'});
                    html += '          <td class="col-price">' + puFmt + '</td>';
                    html += '          <td class="col-total">' + totFmt + '</td>';
                } else {
                    html += '          <td>'+(p.comentario||'')+'</td>';
                }
                html += '        </tr>';
            });
            html += '      </tbody>';
            html += '    </table>';

            // calculate totals for diseño de factura
            var subtotal = 0;
            $.each(resp.productos||[], function(i,p){
                var val = parseFloat(p.total || p.cantidad * p.pu || 0) || 0;
                subtotal += val;
            });
            var iva = subtotal * 0.16;
            var total = subtotal + iva;

            html += '    <!-- SUMMARY SECTION -->';
            html += '    <div class="invoice-summary">';
            html += '      <div class="summary-left">';
            if(tipo == 1){
                html += '        <h3 class="auth-title">AUTORIZÓ:</h3>';
                html += '        <div class="signature-line"></div>';
            } else {
                html += '        <h3 class="auth-title">ENTREGÓ: '+entregado+'</h3>';
                html += '        <div class="signature-line"></div>';
            }
            html += '      </div>';
            html += '      <div class="summary-right">';
            if(tipo == 1){
                var fmtSubtotal = subtotal.toLocaleString('es-MX', {style: 'currency', currency: 'MXN'});
                var fmtIva = iva.toLocaleString('es-MX', {style: 'currency', currency: 'MXN'});
                var fmtTotal = total.toLocaleString('es-MX', {style: 'currency', currency: 'MXN'});
                html += '        <table class="totals-table">';
                html += '          <tr><td>SUB TOTAL</td><td>' + fmtSubtotal + '</td></tr>';
                html += '          <tr><td>IVA (16%)</td><td>' + fmtIva + '</td></tr>';
                html += '        </table>';
                html += '        <div class="grand-total-box">';
                html += '          <table class="totals-table">';
                html += '            <tr class="grand-total"><td>TOTAL</td><td>' + fmtTotal + '</td></tr>';
                html += '          </table>';
                html += '        </div>';
            }
            html += '      </div>';
            html += '    </div>';
            html += '  </main>';
            html += '  <footer class="invoice-footer">';
            html += '    <div class="footer-line"></div>';
            html += '  </footer>';
            html += '</div>';
            $('#detalleContent').html(html);
            $('#modalDetalle').modal('show');
        },
        error: function(jqXHR, textStatus, err){
            console.error('AJAX error detalle:', textStatus, err, jqXHR.responseText);
            Swal.fire({icon:'error',title:'Error',text:'No se pudo obtener el detalle.'});
        }
    });
});
$("#agregar").click(function() {
    var cont = $(".remove").length;
    var index = cont + 1;
    var add = '\n\
            <div class="remove form-row" id="' + index + '">\n\
                 <div class="form-group col-md-4 input-info" id="producto">\n\
                     <input type="text" id="producto_' + index + '" name="producto[]" class="producto form-control" placeholder="">\n\
                     <input type="text" id="prodid_' + index + '" name="prodid[]" class="form-control" placeholder="" style="display:none;">\n\
                 </div>\n\
                 <div class="form-group col-md-2 input-info">\n\
                     <input type="text" id="unidad_' + index + '" name="unidad[]" class="form-control" disabled>\n\
                 </div>\n\
                 <div class="form-group col-md-1 input-info">\n\
                     <input type="text" id="cantidad_' + index + '" name="cantidad[]" onkeyup="calcularMult(' + index + ')" class="form-control">\n\
                 </div>\n\
                 <div class="form-group col-md-2 input-group input-info">\n\
                    <div class="input-group-prepend">\n\
                        <div class="input-group-text"><i class="la la-dollar"></i></div>\n\
                    </div>\n\
                    <input type="text" id="pu_' + index + '" name="pu[]" onkeyup="calcularMult(' + index + ')" onblur="formatCurrency(this)" class="form-control currency-input">\n\
                 </div>\n\
                 <div class="form-group col-md-2 input-group input-info">\n\
                    <div class="input-group-prepend">\n\
                        <div class="input-group-text"><i class="la la-dollar"></i></div>\n\
                    </div>\n\
                    <input type="text" id="total_' + index + '" name="total[]" class="form-control currency-input" disabled>\n\
                 </div>\n\
                 <div class="form-group col-md-1 input-info">\n\
                    <button type="button" class="remove_btn btn btn-danger btn-xs" style="margin: auto;"><i class="fa fa-close"></i></button>\n\
                </div>\n\
            </div>';
    $("#frmregent").append(add);

    var provid = $("#provid").val();
    var product = {
        url: function(phrase) {
            return "./autocomplete/autocompleteProduct.php?phrase=" + phrase + "&provid=" + provid +
                "&format=json";
        },
        getValue: "producto",
        list: {
            maxNumberOfElements: 10000,
            hideOnEmptyPhrase: true,
            match: {
                enabled: false,
                caseSensitive: false,
                method: function(element, phrase) {

                    if (element.search(phrase) > -1) {
                        return true;
                    } else {
                        return false;
                    }
                }
            },
            showAnimation: {
                type: "slide", //normal|slide|fade
                time: 400,
                callback: function() {}
            },

            hideAnimation: {
                type: "slide",
                time: 400,
                callback: function() {}
            },
            onClickEvent: function() {
                var selectedItemValue = $("#producto_" + index).getSelectedItemData().prodid;
                $("#prodid_" + index).val(selectedItemValue).trigger("change");

                var selectedUnidad = $("#producto_" + index).getSelectedItemData().unidad;
                $("#unidad_" + index).val(selectedUnidad).trigger("change");

            }
        }
    };
    $("#producto_" + index).easyAutocomplete(product);
    actualizarTotales();
});


var prov = {
    url: function(phrase) {
        return "./autocomplete/autocompleteProv.php?phrase=" + phrase + "&format=json";
    },
    getValue: "provname",
    list: {
        maxNumberOfElements: 10000,
        match: {
            enabled: false,
            caseSensitive: false,
            method: function(element, phrase) {

                if (element.search(phrase) > -1) {
                    return true;
                } else {
                    return false;
                }
            }
        },
        showAnimation: {
            type: "slide", //normal|slide|fade
            time: 400,
            callback: function() {}
        },

        hideAnimation: {
            type: "slide",
            time: 400,
            callback: function() {}
        },
        onClickEvent: function() {
            var selectedItemValue = $("#provname").getSelectedItemData().provid;
            $("#provid").val(selectedItemValue).trigger("change");
        }
    }
}
$("#provname").easyAutocomplete(prov);

function onoff() {
    var provname = $("#provname").val();
    var fecentra = $("#fecentra").val();
    var requi = $("#requi").val();
    var recibe = $("#recibe").val();
    
    if (provname != '' && fecentra != '' && requi != '' && recibe != '') {
        $("#agregar").removeAttr('disabled');
    } else {
        $("#agregar").prop("disabled", true);
        $('.remove').remove();
        // keep provider id even if other fields empty
        actualizarTotales();
    }
}

function calcularMult(idx) {
    var pu = parseFloat($("#pu_" + idx).val().replace(/[^0-9.-]+/g,'')) || 0;
    var cantidad = parseFloat($("#cantidad_" + idx).val()) || 0;
    var total = pu * cantidad;
    $("#total_" + idx).val(total > 0 ? total.toLocaleString('es-MX', {minimumFractionDigits: 2, maximumFractionDigits: 2}) : '');
    actualizarTotales();
}

function actualizarTotales() {
    var subtotal = 0;
    $("input[id^='total_']").each(function() {
        var valor = $(this).val().replace(/[^0-9.-]+/g,'');
        subtotal += parseFloat(valor) || 0;
    });
    
    var iva = subtotal * 0.16;
    var total = subtotal + iva;
    
    $("#subtotal").val(subtotal.toLocaleString('es-MX', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
    $("#iva").val(iva.toLocaleString('es-MX', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
    $("#total").val(total.toLocaleString('es-MX', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
}

function formatCurrency(input) {
    let value = input.value.replace(/[^0-9.-]/g, '');
    if (value) {
        value = parseFloat(value);
        if (!isNaN(value)) {
            input.value = value.toLocaleString('es-MX', {minimumFractionDigits: 2, maximumFractionDigits: 2});
        }
    }
}


$("#btn-send").click(function() {
    console.log('btn-send clicked');
    var provid_global = $('#provid').val();
    console.log('valor provid_global', provid_global);
    if (!provid_global) {
        Swal.fire({
            icon: 'warning',
            title: 'Proveedor requerido',
            text: 'Selecciona un proveedor antes de agregar.'
        });
        return;
    }
    try {
        var obj = [];
        var elems = $(".remove");
        console.log('elementos con clase remove', elems.length);
        elems.each(function() {
            var $row = $(this); 
            var prodid = $row.find("input[name='prodid[]']").val();
            var producto = $row.find("input[name='producto[]']").val();
            var cantidad = $row.find("input[name='cantidad[]']").val();
            var pu = $row.find("input[name='pu[]']").val();
            var subtotal = $row.find("input[name='total[]']").val();
            // strip currency formatting before sending
            pu = pu.replace(/[^0-9.-]+/g, '');
            subtotal = subtotal.replace(/[^0-9.-]+/g, '');
            tmp = {
                'producto': producto,
                'prodid': prodid,
                'cantidad': cantidad,
                'precio': pu,
                'subtotal': subtotal
            };
            obj.push(tmp);
        });

        var modo = $('#modo').val();
        var fecentra = $("#fecentra").val();
        var requi = $('#requi').val();
        var recibe = $('#recibe').val();

        var postData = {
            'modo': modo,
            'provid': provid_global,
            'fecentra': fecentra,
            'requi': requi,
            'recibe': recibe,
            'productos': obj
        };
        console.log('postData', postData);
    } catch(err) {
        console.error('error construyendo datos', err);
        return;
    }

    var formURL = "./almacen";
    $.ajax({
        url: formURL,
        type: "POST",
        async: false,
        data: postData,
        success: function(data, textStatus) {
            console.log(data);
            Swal.fire({
                icon: 'success',
                title: 'Se Registró la entrada',
                text: 'Espere un momento...',
                showConfirmButton: false,
                timer: 2000
            }).then((result) => {
                window.location.href = "./almacen";
            })

        },
        error: function(jqXHR, textStatus) {
            console.log(textStatus);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Comuniquese con el administrador del sistema',
            })
        }
    });
});



/***** SALIDAS *****/
$("#agregarsalida").click(function() {
    var cont = $(".removes").length;
    var index = cont + 1;
    var add = '\n\
            <div class="removes form-row" id="' + index + '">\n\
                 <div class="form-group col-md-4 input-info" id="producto">\n\
                     <input type="text" id="productos_' + index + '" name="productos[]" class="productos form-control" placeholder="">\n\
                     <input type="text" id="prodids_' + index + '" name="prodids[]" class="form-control" placeholder="" style="display:none;">\n\
                 </div>\n\
                 <div class="form-group col-md-2 input-info">\n\
                     <input type="text" id="unidads_' + index + '" name="unidads[]" class="form-control" disabled>\n\
                 </div>\n\
                 <div class="form-group col-md-1 input-info">\n\
                    <input type="text" id="existencia_' + index + '" name="existencia[]" class="form-control" disabled>\n\
                 </div>\n\
                 <div class="form-group col-md-1 input-info">\n\
                     <input type="text" id="cantidads_' + index + '" name="cantidads[]" onkeyup="calcularExistencia(' + index + ')" class="form-control">\n\
                 </div>\n\
                 <div class="form-group col-md-3 input-info">\n\
                    <input type="text" id="comentario_' + index + '" name="comentario[]" class="form-control">\n\
                 </div>\n\
                 <button type="button" class="remove_btn btn btn-danger btn-xs" style="margin: auto;"><i class="fa fa-close"></i></button>\n\
            </div>';

    $("#frmrsalidas").append(add);

    var provid = $("#provid").val();
    var productSalidas = {
        url: function(phrase) {
            return "./autocomplete/autocompleteSalidas.php?phrase=" + phrase + "&format=json";
        },
        getValue: "producto",
        list: {
            maxNumberOfElements: 10000,
            hideOnEmptyPhrase: true,
            match: {
                enabled: false,
                caseSensitive: false,
                method: function(element, phrase) {

                    if (element.search(phrase) > -1) {
                        return true;
                    } else {
                        return false;
                    }
                }
            },
            showAnimation: {
                type: "slide", //normal|slide|fade
                time: 400,
                callback: function() {}
            },

            hideAnimation: {
                type: "slide",
                time: 400,
                callback: function() {}
            },
            onClickEvent: function() {
                console.log();
                var selectedid = $("#productos_" + index).getSelectedItemData().prodid;
                $("#prodids_" + index).val(selectedid).trigger("change");

                var selectedUnidad = $("#productos_" + index).getSelectedItemData().unidad;
                $("#unidads_" + index).val(selectedUnidad).trigger("change");

                var selectedexistencia = $("#productos_" + index).getSelectedItemData().existencia;
                $("#existencia_" + index).val(selectedexistencia).trigger("change");
            }
        }
    };
    $("#productos_" + index).easyAutocomplete(productSalidas);
});

function onoffs() {
    console.log($("#destino").val());
    if ($("#solicita").val() != '' || $("#autoriza").val() != '') {
        if($("#entrega").val() != ''){
            $("#agregarsalida").removeAttr('disabled');
            $('.removes').remove();
        }
    } else {
        $("#agregarsalida").prop("disabled", true);
        $('.removes').remove();
    }
}

$("#btn-send-salida").click(function() {
    var obj = [];
    var elems = $(".removes");
    for (i = 1; i <= elems.length; i += 1) {
        var prodid = $("#prodids_" + i).val();
        var producto = $("#productos_" + i).val();
        var cantidad = $("#cantidads_" + i).val();
        var comentario = $("#comentario_" + i).val();


        tmp = {
            'producto': producto,
            'prodid': prodid,
            'cantidad': cantidad,
            'comentario': comentario
        };
        obj.push(tmp);
    }

    var modo = $('#modos').val();
    var solicita = $('#solicita').val();
    var autoriza = $('#autoriza').val();
    var entrega = $('#entrega').val();
    var fecsale = $('#fecsale').val();
    var destino = $('#destino').val();
    var solicitud = (solicita.charAt(0)+solicita.charAt(1)+autoriza.charAt(0)+autoriza.charAt(1));

    var postData = {
        'modo': modo,
        'solicitud': solicitud,
        'solicita': solicita,
        'autoriza': autoriza,
        'entrega': entrega,
        'fecsale': fecsale,
        'destino': destino,
        'productos': obj
    };
    console.log(postData);
    var formURL = "./almacen";
    $.ajax({
        url: formURL,
        type: "POST",
        async: false,
        data: postData,
        success: function(data, textStatus) {
            console.log(data);
            Swal.fire({
                icon: 'success',
                title: 'Se Registró la salida',
                text: 'Espere un momento...',
                showConfirmButton: false,
                timer: 2000
            }).then((result) => {
                window.location.href = "./almacen";
            })

        },
        error: function(jqXHR, textStatus) {
            console.log(textStatus);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Comuniquese con el administrador del sistema',
            })
        }
    });
});

// imprimir solo el contenido del modalDetalle
$(document).on('click', '#btn-print-detalle', function(){
    var $content = $('#detalleContent').clone();
    // quitar posibles botones o elementos no deseados
    $content.find('#btn-print-detalle').remove();
    $content.find('.btn').remove();

    var headHtml = '<title>Detalle del Movimiento</title>';
    // copiar hojas de estilo actuales
    $('link[rel="stylesheet"]').each(function(){
        var href = $(this).attr('href');
        if(href) headHtml += '<link rel="stylesheet" href="'+href+'">';
    });
    // estilos mínimos para la tabla de factura y diseño general
    // Modifico para aplicar un CSS adecuado para que se imprima correctamente la nueva ventana
    var printStyles = invoiceStyles.replace(/#modalDetalle /g, "");
    printStyles += "<style>html { margin: 0; padding: 0; } @page { size: letter; margin: 0 !important; } body { padding: 0 !important; background-color: white !important; margin: 0; width: 215.9mm; height: 279.4mm; } .invoice-container { width: 215.9mm; height: 279.4mm !important; box-shadow: none; background-color: var(--doc-bg) !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; page-break-after: avoid; } main { flex: 1; }</style>";
    headHtml += printStyles;

    var printWindow = window.open("", "_blank");
    if(printWindow){
        printWindow.document.write("<!doctype html><html><head>"+headHtml+"</head><body>"+$content.html()+"</body></html>");
        printWindow.document.close();
        printWindow.onload = function() {
            printWindow.focus();
            printWindow.print();
            setTimeout(function(){ printWindow.close(); }, 500);
        };
    } else {
        alert("Por favor habilita las ventanas emergentes (pop-ups) para imprimir el documento.");
    }
});
</script>

</html>