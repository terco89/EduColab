<!-- modal para el edit de banner -->
<div class="modal fade" id="editPhoto" tabindex="-1" role="dialog" aria-labelledby="editPhotoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPhotoLabel"style="font-weight: 700;font-size: 1.5em;color: #32418b;">Editar foto o color</h5>
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

                </form>
            </div>
            <div class="modal-footer">
            <input type="submit" name="sub" value="Guardar" class="btn btn-secondary mt-3" style="background-color: #32418B;">

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
                    <h5 class="modal-title" id="archivarClaseLabel"style="font-weight: 700;font-size: 1.5em;color: #32418b;">¿Desea archivar esta clase?</h5>
                </div>
                <div class="modal-body">
                    <p>Al archivar esta clase, no aparecerá en la lista activa de clases, pero podrá restaurarla en cualquier momento desde el archivo.</p>
                    <br><p style="text-align: end; margin:0;">¿Está seguro de que desea continuar?</p>

                </div>
                <div class="modal-footer">
                    <form method="POST">
                        <input type="hidden" name="id_clase_archivar" value="<?php echo $_GET['id']; ?>">
                        <button type="submit" class="btn btn-light">Si, quiero archivar</button>
                        <button type="button" class="btn btn-secondary" style="background-color: #32418B;" data-dismiss="modal">Cancelar</button>
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
                    <h5 class="modal-title" id="archivarClaseLabel"style="font-weight: 700;font-size: 1.5em;color: #32418b;">¿Desea desarchivar esta clase?</h5>
                </div>
                <div class="modal-body">
                    <p>Al desarchivar esta clase, volverá a aparecer en la lista de clases activas.</p>
                    <p style="text-align: end; margin:0;">¿Está seguro de que desea continuar?</p>
                </div>
                <div class="modal-footer">
                    <form method="POST">
                        <input type="hidden" name="id_clase_desarchivar" value="<?php echo $_GET['id']; ?>">
                        <button type="submit" class="btn btn-light">Si, quiero desarchivar</button>
                        <button type="button" class="btn btn-secondary" style="background-color: #32418B;"data-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php } ?>



<!-- modal para eliminar clase -->
<div class="modal fade" id="eliminarClase" tabindex="-1" role="dialog" aria-labelledby="eliminarClaseLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarClaseLabel" style="font-weight: 700;font-size: 1.5em;color: #32418b;">¿Desea eliminar esta clase?</h5>

            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <p><strong style="color: #32418b;">Advertencia:</strong> Si elimina esta clase, perderá todo registro de ella. ¡Esta acción es irreversible!</p>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <form method="POST">
                    <input type="hidden" name="id_clase_eliminar" value="<?php echo htmlspecialchars($_GET['id']); ?>">
                    <!-- Confirm Deletion Button -->
                    <button type="submit" class="btn btn-light">Sí, quiero eliminarla</button>
                    <!-- Cancel Button -->
                    <button type="button" class="btn btn-secondary" style="background-color: #32418b;" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
    <style>
        .btn-primary {
            background-image: linear-gradient(to right, #32418B, #A09AE5, #BA8CE9, #D598DA);
            border: none;
            transition: .5s;
        }

        .btn-primary:hover {
            transform: scale(1.1);
            background-image: linear-gradient(to right, #32418B, #A09AE5, #BA8CE9, #D598DA);
        }
        .nav-tabs .nav-link.active{
           color: #32418B;
        }
        .nav-link{
            color: gray;
        }
    </style>
</div>