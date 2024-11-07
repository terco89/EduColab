<!-- modal para el edit de banner -->
<div class="modal fade" id="editPhoto" tabindex="-1" role="dialog" aria-labelledby="editPhotoLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editPhotoLabel">Editar foto o color</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" id="bgForm">
                                <input type="hidden" id="bgOption" name="bgOption" value="background"> <!-- Valor por defecto -->

                                <!-- Navbar para seleccionar entre Fondo y Color -->
                                <ul class="nav nav-tabs mb-3" id="bgTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="background-tab" data-toggle="tab" href="#background" role="tab"
                                            aria-controls="background" aria-selected="true" onclick="setBgOption('background')">Fondo</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="color-tab" data-toggle="tab" href="#color" role="tab"
                                            aria-controls="color" aria-selected="false" onclick="setBgOption('color')">Color</a>
                                    </li>
                                </ul>

                                <!-- Contenido del Tab -->
                                <div class="tab-content" id="bgTabContent">
                                    <!-- Selección de Fondos -->
                                    <div class="tab-pane fade show active" id="background" role="tabpanel" aria-labelledby="background-tab">
                                        <div id="backgroundSelector">
                                            <select id="bgDropdown" name="bg" class="form-control">
                                                <!-- Opciones generadas dinámicamente por JavaScript -->
                                            </select>
                                            <div id="bgPreview"
                                                style="margin-top: 10px; width: 100%; height: 200px; border: 1px solid #ccc;">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Selección de Colores -->
                                    <div class="tab-pane fade" id="color" role="tabpanel" aria-labelledby="color-tab">
                                        <div id="colorSelector">
                                            <input type="color" id="colorPicker" name="color" value="#ffffff" class="form-control">
                                            <div id="colorPreview"
                                                style="margin-top: 10px; width: 100%; height: 200px; border: 1px solid #ccc; background-color: #ffffff;">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" name="sub" value="Guardar" class="btn btn-primary mt-3">
                            </form>
                        </div>
                    </div>
                </div>
            </div>



            <!-- modal para Arcguvar clase -->
            <?php if ($fondo['estado'] == "activa") { ?>
                <div class="modal fade" id="archivarClase" tabindex="2" role="dialog" aria-labelledby="archivarClaseLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="archivarClaseLabel">¿Desea archivar esta clase?</h5>
                            </div>
                            <div class="modal-body">
                                <form method="POST">
                                    <input type="hidden" name="id_clase_archivar" value="<?php echo $_GET['id']; ?>">
                                    <button type="submit" class="btn btn-danger">Si, quiero archivar</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="modal fade" id="archivarClase" tabindex="2" role="dialog" aria-labelledby="archivarClaseLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="archivarClaseLabel">¿Desea desarchivar esta clase?</h5>
                            </div>
                            <div class="modal-body">
                                <form method="POST">
                                    <input type="hidden" name="id_clase_desarchivar" value="<?php echo $_GET['id']; ?>">
                                    <button type="submit" class="btn btn-danger">Si, quiero desarchivar</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>



            <!-- modal para eliminar clase -->
            <div class="modal fade" id="eliminarClase" tabindex="2" role="dialog" aria-labelledby="eliminarClaseLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="eliminarClaseLabel">¿Desea eliminar esta clase?</h5>
                        </div>
                        <div class="modal-body">
                            <form method="POST">
                                <input type="hidden" name="id_clase_eliminar" value="<?php echo $_GET['id']; ?>">
                                <button type="submit" class="btn btn-danger">Si, quiero eliminarla</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>