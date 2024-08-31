        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="deznav">
            <div class="deznav-scroll">
				<ul class="metismenu" id="menu">
                <?php if($permisos == 1){ ?>
                     <!--<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-networking"></i>
							<span class="nav-text">Dashboard</span>
						</a>
                        <ul aria-expanded="false">
							<li><a href="./">Dashboard</a></li>
						</ul>
                    </li>-->
                <?php }?>

                <?php if($permisos <= 2){ ?>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-networking"></i>
							<span class="nav-text">Administración</span>
						</a>
                        <ul aria-expanded="false">
							<li><a href="./admin">Dashboard</a></li>
						</ul>
                    </li>
                <?php }?>
                
                <?php if($permisos <= 6){ ?>
                    <li><a class="has-arrow ai-icon" href="./almacen" aria-expanded="false">
							<i class="flaticon-381-layer-1"></i>
							<span class="nav-text">Almacen</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="./almacen">Dashboard</a></li>
                        </ul>
                    </li>
                <?php }?>

                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-database"></i>
							<span class="nav-text">Catálogos</span>
						</a>
                        <ul aria-expanded="false">
                        <?php if($permisos <= 2){ ?><li><a href="./usuarios">Catálogo Usuarios</a></li><?php }?>
                        <?php if($permisos <= 6){ ?>
                            <li><a href="./proveedores">Catálogo Proveedores</a></li>
                            <li><a href="./productos">Catálogo Productos</a></li>
                        <?php }?>
                        </ul>
                    </li>
                </ul>
            
				<div class="container copyright text-center">
                    <img src="./src/images/ico_logo_mrdev.svg" alt="MRDEV" style="width: 15px;">
					<p class="text-center" style="padding: 0 !important; margin: 0 !important; display: inline-flex">
                        <strong>MR<span style="color: #000;">DEV</span></strong>
                    </p>
                    <p class="text-center" style="padding: 0 !important; margin: 0 !important">
                        © <?php echo date("Y"); ?> All Rights Reserved
                    </p>
					
				</div>
			</div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->