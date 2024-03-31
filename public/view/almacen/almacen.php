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
    $(document).ready ( function () {
        $(document).on ("click", ".remove .remove_btn", function () {
            $(this).parent('.remove').remove();
        });
        /*$(document).on("keypress", "#div_prov #prov", function (e) {
          console.log(e);
          console.log($(this));
          //prov($(this));
     });*/

    });
     $("#agregar").click(function(){
    var cont = $(".remove").length;
    var index = cont + 1;
    var add = '\n\
            <div class="remove form-row" id="'+index+'">\n\
                 <div class="form-group col-md-6" id="producto">\n\
                     <label>Producto</label>\n\
                     <input type="text" id="producto_'+index+'" name="producto[]" class="producto form-control" placeholder="">\n\
                 </div>\n\
                 <div class="form-group col-md-2">\n\
                     <label>Unidad</label>\n\
                     <input type="text" id="unidad_'+index+'" name="unidad[]" class="form-control" disabled>\n\
                 </div>\n\
                 <div class="form-group col-md-1">\n\
                     <label>Cantidad</label>\n\
                     <input type="text" id="cantidad_'+index+'" name="cantidad[]" class="form-control">\n\
                 </div>\n\
                 <button type="button" class="remove_btn btn btn-danger btn-xs" style="margin: auto;">Eliminar<span class="btn-icon-right"><i class="fa fa-close"></i></span></button>\n\
            </div>';
    
    $("#frmregent").append(add);   

    var provid = $("#provid").val();
    var product = {
      url: function(phrase) {
        return "./view/almacen/autocompleteProduct.php?phrase=" + phrase + "&provid=" +provid +"&format=json";
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
        onSelectItemEvent: function() {
            console.log();
          var selectedItemValue = $("#producto_"+index).getSelectedItemData().precio;
          $("#mm_"+index).val(selectedItemValue).trigger("change");

          var selectedUnidad = $("#producto_"+index).getSelectedItemData().unidad;
          $("#unidad_"+index).val(selectedUnidad).trigger("change");
        }
      }
    };
    $("#producto_"+index).easyAutocomplete(product);
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
        onSelectItemEvent: function() {
          var selectedItemValue = $("#provname").getSelectedItemData().provid;
          $("#provid").val(selectedItemValue).trigger("change");
        }
      }
  }
  $("#provname").easyAutocomplete(prov);
</script>
</html>
