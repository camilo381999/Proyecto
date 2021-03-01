<div class="registro-title">
					<h1>Registro</h1>
				</div>

				<div class="form-group">
					<input name="Nombre" type="text" class="form-control"  placeholder="Nombre" <?php $validar-> mostrar_nombre(); ?>>
                    <?php 
                        $validar -> mostrar_error_nombre();
                    ?>
                </div>

				<div class="form-group">
					<input name="Apellido" type="text" class="form-control"  placeholder="Apellido" <?php $validar-> mostrar_apellido(); ?>>
                    <?php 
                        $validar -> mostrar_error_apellido();
                    ?>
				</div>

				<div class="form-group">
					<input name="Cedula" type="text" class="form-control"  placeholder="Cédula" <?php $validar-> mostrar_cedula(); ?>>
                    <?php 
                        $validar -> mostrar_error_cedula();
                    ?>
				</div>

				<div class="form-group">
					<input name="Correo" type="email" class="form-control"  placeholder="Correo" <?php $validar-> mostrar_correo(); ?>>
                    <?php 
                        $validar -> mostrar_error_correo();
                    ?>
				</div>

				<div class="form-group">
					<input name="Telefono" type="text" class="form-control"  placeholder="Teléfono" <?php $validar-> mostrar_telefono(); ?>>
                    <?php 
                        $validar -> mostrar_error_telefono();
                    ?>
				</div>

				<div class="form-group">
					<input name="Contrasena" type="password" class="form-control"  placeholder="Contraseña">
                    <?php 
                        $validar -> mostrar_error_contrasena();
                    ?>
				</div>

				<button name="registrar" type="submit" class="btn btn-primary btn-block">Registrar</button>
