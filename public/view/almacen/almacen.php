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
$(document).ready(function() {
    $(document).on("click", ".remove .remove_btn", function() {
        $(this).parent('.remove').remove();
    });
    $(document).on("click", ".removes .remove_btn", function() {
        $(this).parent('.removes').remove();
    });
    /*$(document).on("keypress", "#div_prov #prov", function (e) {
          console.log(e);
          console.log($(this));
          //prov($(this));
     });*/

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
                    <input type="text" id="pu_' + index + '" name="pu[]" onkeyup="calcularMult(' + index + ')" class="form-control">\n\
                 </div>\n\
                 <div class="form-group col-md-2 input-group input-info">\n\
                    <div class="input-group-prepend">\n\
                        <div class="input-group-text"><i class="la la-dollar"></i></div>\n\
                    </div>\n\
                    <input type="number" id="total_' + index + '" name="total[]" class="form-control" disabled>\n\
                 </div>\n\
                 <button type="button" class="remove_btn btn btn-danger btn-xs" style="margin: auto;"><i class="fa fa-close"></i></button>\n\
            </div>';

    $("#frmregent").append(add);

    var provid = $("#provid").val();
    var product = {
        url: function(phrase) {
            return "./view/almacen/autocompleteProduct.php?phrase=" + phrase + "&provid=" + provid +
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
});


var prov = {
    url: function(phrase) {
        return "./view/almacen/autocompleteProv.php?phrase=" + phrase + "&format=json";
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
    if ($("#provname").val() != '') {
        $("#agregar").removeAttr('disabled');
        $('.remove').remove();
    } else {
        $("#agregar").prop("disabled", true);
        $('.remove').remove();
        $("#provid").val('');
    }
}

function calcularMult(idx) {
    $("#total_" + idx).val($("#pu_" + idx).val() * $("#cantidad_" + idx).val());
    /*var sum = 0;
    $("input[id^='total_']").each(function() {
      sum += Number($(this).val());
    });        
      $("#total").val(sum); */
}


$("#btn-send").click(function() {
    var obj = [];
    var elems = $(".remove");
    for (i = 1; i <= elems.length; i += 1) {
        var prodid = $("#prodid_" + i).val();
        var producto = $("#producto_" + i).val();
        var cantidad = $("#cantidad_" + i).val();
        var pu = $("#pu_" + i).val();
        var subtotal = $("#total_" + i).val();


        tmp = {
            'producto': producto,
            'prodid': prodid,
            'cantidad': cantidad,
            'precio': pu,
            'subtotal': subtotal
        };
        obj.push(tmp);
    }

    var modo = $('#modo').val();
    var provid = $('#provid').val();
    var fecentra = $("#fecentra").val();
    var requi = $('#requi').val();
    var recibe = $('#recibe').val();

    var postData = {
        'modo': modo,
        'provid': provid,
        'fecentra': fecentra,
        'requi': requi,
        'recibe': recibe,
        'productos': obj
    };

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
            return "./view/almacen/autocompleteSalidas.php?phrase=" + phrase + "&format=json";
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
</script>

</html>