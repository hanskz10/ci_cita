<?php
$descripcion = array(
  'name'        =>  'descripcion',
  'id'          =>  'descripcion',
  'size'        =>  50,
  'value'       =>  set_value('descripcion', @$especialidades[0]->descripcion),
  'type'        =>  'text',
  'class'       =>  'form-control',
  'placeholder' =>  'Ingresar descripcion',
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
      <h1><?php echo ($titulo == 'Nueva Especialidad')?'Nueva Especialidad':'Editar Especialidad'; ?></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="<?php echo base_url(); ?>categorias">Categorías</a></li>
        <li class="active"><?php echo ($titulo == 'Nueva Especialidad')?'Nueva Especialidad':'Editar Especialidad'; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div id="mensaje" class="text-center"></div>
          <div class="box box-info">            
            <form class="form-horizontal" name="FormEspecialidad" id="FormEspecialidad">
              <div class="box-body">
                <div class="form-group">
                  <label for="nombre" class="col-sm-2 control-label">Descripcion</label>
                  <div class="col-sm-8">
                    <input type="hidden" value="<?php echo @$especialidades[0]->idEspecialidad; ?>" id="idEspecialidad" name="idEspecialidad" />
                    <?php echo form_input($descripcion); ?>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="estado" class="col-sm-2 control-label">Estado</label>
                  <div class="col-sm-8">
                      <?php echo  form_dropdown('estado', $estado, set_value('estado', @$especialidades[0]->estado),'class="form-control" id="estado" '.$disabled.' '); ?>                    
                  </div>  
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="button" onclick="regresar()" class="btn btn-default">Regresar</button>
                <?php if($titulo == 'Nueva Especialidad'){ ?>
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
    