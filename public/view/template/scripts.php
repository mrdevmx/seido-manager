<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="<?php echo $pathTheme;?>vendor/global/global.min.js"></script>
<script src="<?php echo $pathTheme;?>vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="<?php echo $pathTheme;?>vendor/chart.js/Chart.bundle.min.js"></script>
<script src="<?php echo $pathTheme;?>js/custom.min.js"></script>
<script src="<?php echo $pathTheme;?>js/deznav-init.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.17/sweetalert2.all.min.js"></script>
<script src="<?php echo $pathTheme;?>js/plugins-init/sweetalert.init.js"></script>

<script src="<?php echo $pathTheme;?>js/table2excel.js"></script>	
	
<!-- Counter Up -->
<script src="<?php echo $pathTheme;?>vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="<?php echo $pathTheme;?>vendor/jquery.counterup/jquery.counterup.min.js"></script>	
		
<!-- Apex Chart -->
<script src="<?php echo $pathTheme;?>vendor/apexchart/apexchart.js"></script>	
	
<!-- Chart piety plugin files -->
<script src="<?php echo $pathTheme;?>vendor/peity/jquery.peity.min.js"></script>
	
<!-- Dashboard 1 -->
<script src="<?php echo $pathTheme;?>js/dashboard/dashboard-1.js"></script>

<!-- Datetable -->
<script src="<?php echo $pathTheme;?>vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $pathTheme;?>js/plugins-init/datatables.init.js"></script>

<script>
    $('#logout').click(function(){
        $('#timer').fadeIn(300);
        Swal.fire({
            position: 'top-end',
            icon: 'info',
            title: 'Cerrando sesión',
            showConfirmButton: false,
            timer: 1500
        })
        setTimeout(function(){
            window.location.href = "./conexion/funciones/login/logout";
        },2500);
    });

</script>