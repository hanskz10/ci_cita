<?php
$nombre = array(
  'name'        =>  'nombre',
  'id'          =>  'nombre',
  'size'        =>  35,
  'value'       =>  set_value('nombre', @$pacientes[0]->nombre),
  'type'        =>  'text',
  'class'       =>  'form-control',
  'placeholder' =>  'Ingresar nombre',
  //'onkeypress'  => 'return validarn(event);',
);

$apellidos = array(
  'name'        =>  'apellidos',
  'id'          =>  'apellidos',
  'size'        =>  50,
  'value'       =>  set_value('apellidos', @$pacientes[0]->apellidos),
  'type'        =>  'text',
  'class'       =>  'form-control',
  'placeholder' =>  'Ingresar apellidos',
  //'onkeypress'  => 'return validarn(event);',
);

$email = array(
  'name'        =>  'email',
  'id'          =>  'email',
  'size'        =>  50,
  'value'       =>  set_value('email', @$pacientes[0]->email),
  'type'        =>  'email',
  'class'       =>  'form-control',
  'placeholder' =>  'Ingresar email',
  //'onkeypress'  => 'return validarn(event);',
);

$direccion = array(
  'name'        =>  'direccion',
  'id'          =>  'direccion',
  'size'        =>  100,
  'value'       =>  set_value('direccion', @$pacientes[0]->direccion),
  'type'        =>  'text',
  'class'       =>  'form-control',
  'placeholder' =>  'Ingresar dirección'
);

$celular = array(
  'name'        =>  'celular',
  'id'          =>  'celular',
  'size'        =>  11,
  'value'       =>  set_value('celular', @$pacientes[0]->celular),
  'type'        =>  'text',
  'class'       =>  'form-control',
  'placeholder' =>  'Ingresar celular',
  //'onkeypress'  => 'return validarn(event);',
);

$estado = array(
  '0'           =>  '--- Elegir opción ---',
  '1'           =>  'Activo',
  '2'           =>  'Desactivado',
);

$disabled = "";
/*
if($this->session->userdata('ID') == @$usuarios[0]->idUsuario AND $this->session->userdata('ROLUSUARIO') != 1){
  $disabled = "disabled='disabled'";
}
*/ 
?>
    <section class="content-header">
      <h1><?php echo ($titulo == 'Nuevo Paciente')?'Nuevo Paciente':'Editar Paciente'; ?></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="<?php echo base_url(); ?>pacientes">Pacientes</a></li>
        <li class="active"><?php echo ($titulo == 'Nuevo Paciente')?'Nuevo Paciente':'Editar Paciente'; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div id="mensaje" class="text-center"></div>
          <div class="box box-info">            
            <form class="form-horizontal" name="FormPaciente" id="FormPaciente">
              <div class="box-body">
                <div class="form-group">
                  <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                  <div class="col-sm-8">
                    <input type="hidden" value="<?php echo @$pacientes[0]->idPaciente; ?>" id="idPaciente" name="idPaciente" />
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
                  <label for="direccion" class="col-sm-2 control-label">Dirección</label>
                  <div class="col-sm-8">
                    <?php echo form_input($direccion); ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="celular" class="col-sm-2 control-label">Celular</label>
                  <div class="col-sm-8">
                    <?php echo form_input($celular); ?>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="estado" class="col-sm-2 control-label">Estado</label>
                  <div class="col-sm-8">
                      <?php echo form_dropdown('estado', $estado, set_value('estado', @$pacientes[0]->estado),'class="form-control" id="estado" '.$disabled.' '); ?>                    
                  </div>  
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="button" onclick="regresar()" class="btn btn-default">Regresar</button>
                <?php if($titulo == 'Nuevo Paciente'){ ?>
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
    