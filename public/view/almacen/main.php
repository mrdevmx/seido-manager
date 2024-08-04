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
                                                <option>Casa 60</option>
                                                <option>Casa 61</option>
                                                <option>Casa 62</option>
                                                <option>Casa 63</option>
                                                <option>Casa 64</option>
                                                <option>Casa 65</option>
                                                <option>Casa 66</option>
                                                <option>Casa 67</option>
                                                <option>Casa 68</option>
                                                <option>Casa 69</option>
                                                <option>Casa 70</option>
                                                <option>Casa 71</option>
                                                <option>Casa 72</option>
                                                <option>Casa 73</option>
                                                <option>Casa 74</option>
                                                <option>Casa 75</option>
                                                <option>Casa 76</option>
                                                <option>Casa 77</option>
                                                <option>Casa 78</option>
                                                <option>Casa 79</option>
                                                <option>Casa 80</option>
                                                <option>Casa 81</option>
                                                <option>Casa 82</option>
                                                <option>Casa 83</option>
                                                <option>Casa 84</option>
                                                <option>Casa 85</option>
                                                <option>Casa 86</option>
                                                <option>Casa 87</option>
                                                <option>Casa 88</option>
                                                <option>Casa 89</option>
                                                <option>Casa 90</option>
                                                <option>Casa 91</option>
                                                <option>Casa 92</option>
                                                <option>Casa 93</option>
                                                <option>Casa 94</option>
                                                <option>Casa 95</option>
                                                <option>Casa 96</option>
                                                <option>Casa 97</option>
                                                <option>Casa 98</option>
                                                <option>Casa 99</option>
                                                <option>Casa 100</option>
                                                <option>Casa 101</option>
                                                <option>Casa 102</option>
                                                <option>Casa 103</option>
                                                <option>Casa 104</option>
                                                <option>Casa 105</option>
                                                <option>Casa 106</option>
                                                <option>Casa 107</option>
                                                <option>Casa 108</option>
                                                <option>Casa 109</option>
                                                <option>Casa 110</option>
                                                <option>Casa 111</option>
                                                <option>Casa 112</option>
                                                <option>Casa 113</option>
                                                <option>Casa 114</option>
                                                <option>Casa 115</option>
                                                <option>Casa 116</option>
                                                <option>Casa 117</option>
                                                <option>Casa 118</option>
                                                <option>Casa 119</option>
                                                <option>Casa 120</option>
                                                <option>Casa 121</option>
                                                <option>Casa 122</option>
                                                <option>Casa 123</option>
                                                <option>Casa 124</option>
                                                <option>Casa 125</option>
                                                <option>Casa 126</option>
                                                <option>Casa 127</option>
                                                <option>Casa 128</option>
                                                <option>Casa 129</option>
                                                <option>Casa 130</option>
                                                <option>Casa 131</option>
                                                <option>Casa 132</option>
                                                <option>Casa 133</option>
                                                <option>Casa 134</option>
                                                <option>Casa 135</option>
                                                <option>Casa 136</option>
                                                <option>Casa 137</option>
                                                <option>Casa 138</option>
                                                <option>Casa 139</option>
                                                <option>Casa 140</option>
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