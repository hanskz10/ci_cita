<?php
$nombre = array(
  'name'        =>  'nombre',
  'id'          =>  'nombre',
  'size'        =>  50,
  'value'       =>  set_value('nombre', @$usuarios[0]->nombre),
  'type'        =>  'text',
  'class'       =>  'form-control',
  'placeholder' =>  'Ingresar nombre',
  //'onkeypress'  => 'return validarn(event);',
);

$apellidos = array(
  'name'        =>  'apellidos',
  'id'          =>  'apellidos',
  'size'        =>  50,
  'value'       =>  set_value('apellidos', @$usuarios[0]->apellidos),
  'type'        =>  'text',
  'class'       =>  'form-control',
  'placeholder' =>  'Ingresar apellidos',
  //'onkeypress'  => 'return validarn(event);',
);

$email = array(
  'name'        =>  'email',
  'id'          =>  'email',
  'size'        =>  50,
  'value'       =>  set_value('email', @$usuarios[0]->email),
  'type'        =>  'text',
  'class'       =>  'form-control',
  'placeholder' =>  'Ingresar email',
  //'onblur'      =>  'validarEmail(this.value);',
);

$password1 = array(
  'name'        =>  'password1',
  'id'          =>  'password1',
  'size'        =>  50,
  'value'       =>  set_value('password1', @$usuarios[0]->password),
  'type'        =>  'password',
  'class'       =>  'form-control',
  'placeholder' =>  'Debe ingresar su password',
);

$password2 = array(
  'name'        =>  'password2',
  'id'          =>  'password2',
  'size'        =>  50,
  'value'       =>  set_value('password2', @$usuarios[0]->password),
  'type'        =>  'password',
  'class'       =>  'form-control',
  'placeholder' =>  'Debe confirmar su password',
);

$rol = array(
  '0'           =>  '--- Elegir opción ---',
  '1'           =>  'Administrador',
  '2'           =>  'Vendedor',
);


$estado = array(
  '0'           =>  '--- Elegir opción ---',
  '1'           =>  'Activo',
  '2'           =>  'Inactivo',
);

$disabled = "";
if($this->session->userdata('ID') == @$usuarios[0]->idUsuario AND $this->session->userdata('ROLUSUARIO') != 1){
    $disabled = "disabled='disabled'";
  }

 
?>
    <section class="content-header">
      <h1><?php echo ($titulo == 'Nuevo Usuario')?'Nuevo Usuario':'Editar Usuario'; ?></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="<?php echo base_url(); ?>usuarios">Usuarios</a></li>
        <li class="active"><?php echo ($titulo == 'Nuevo Usuario')?'Nuevo Usuario':'Editar Usuario'; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div id="mensaje"></div>
          <div class="box box-info">            
            <form class="form-horizontal" name="FormUsuario" id="FormUsuario">
              <div class="box-body">
                <div class="form-group">
                  <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                  <div class="col-sm-8">
                    <input type="hidden" value="<?php echo @$usuarios[0]->idUsuario; ?>" id="idUsuario" name="idUsuario" />
                    <input type="hidden" value="0" id="validamail" name="validamail" /> 
                    <?php echo form_input($nombre); ?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="apellidos" class="col-sm-2 control-label">Apellidos</label>
                  <div class="col-sm-8">
                    <?php echo form_input($apellidos); ?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="email" class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-8">
                    <?php echo form_input($email); ?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="password1" class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-8">
                    <?php echo form_input($password1); ?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="password2" class="col-sm-2 control-label">Confirmar password</label>
                  <div class="col-sm-8">
                    <?php echo form_input($password2); ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="rol" class="col-sm-2 control-label">Rol</label>
                  <div class="col-sm-8">
                      <?php echo  form_dropdown('id_rol', $rol, set_value('id_rol', @$usuarios[0]->idRol),'class="form-control" id="id_rol" '.$disabled.' '); ?>                    
                  </div>  
                </div>

                <div class="form-group">
                  <label for="estado" class="col-sm-2 control-label">Estado</label>
                  <div class="col-sm-8">
                      <?php echo  form_dropdown('estado', $estado, set_value('estado', @$usuarios[0]->estado),'class="form-control" id="estado" '.$disabled.' '); ?>                    
                  </div>  
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="button" onclick="regresar()" class="btn btn-default">Regresar</button>
                <?php if($titulo == 'Nuevo Usuario'){ ?>
                  <button type="submit" class="btn btn-primary pull-right">Agregar</button>
                <?php } else { ?>
                  <button type="submit" class="btn btn-primary pull-right">Guardar</button>
                <?php } ?>  
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    