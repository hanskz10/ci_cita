<?php
$descripcion = array(
  'name'        =>  'descripcion',
  'id'          =>  'descripcion',
  'size'        =>  35,
  'value'       =>  set_value('descripcion', @$menu[0]->descripcion),
  'type'        =>  'text',
  'class'       =>  'form-control',
  'placeholder' =>  'Ingresar descripción'
);

$url = array(
  'name'        =>  'url',
  'id'          =>  'url',
  'size'        =>  30,
  'value'       =>  set_value('url', @$menu[0]->url),
  'type'        =>  'text',
  'class'       =>  'form-control',
  'placeholder' =>  'Ingresar url'
);

$iconos = array(
  'name'        =>  'iconos',
  'id'          =>  'iconos',
  'size'        =>  30,
  'value'       =>  set_value('iconos', @$menu[0]->iconos),
  'type'        =>  'text',
  'class'       =>  'form-control',
  'placeholder' =>  'Ingresar icono'
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
      <h1><?php echo ($titulo == 'Nuevo Menú')?'Nuevo Menú':'Editar Menú'; ?></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="<?php echo base_url(); ?>menu">Menú</a></li>
        <li class="active"><?php echo ($titulo == 'Nuevo Menú')?'Nuevo Menú':'Editar Menú'; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div id="mensaje" class="text-center"></div>
          <div class="box box-info">            
            <form class="form-horizontal" name="FormMenu" id="FormMenu">
              <div class="box-body">
                <div class="form-group">
                  <label for="descripcion" class="col-sm-2 control-label">Descripción</label>
                  <div class="col-sm-8">
                    <input type="hidden" value="<?php echo @$menu[0]->idMenu; ?>" id="idMenu" name="idMenu" />
                    <?php echo form_input($descripcion); ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="linea" class="col-sm-2 control-label">Línea</label>
                  <div class="col-sm-8">
                      <select name="linea" id="linea" class="form-control">
                        <option value="0">--- Elegir opción ---</option>
                      <?php
                        $linea = (!empty($linea))?$linea:'';
                        foreach($list_menus as $list_menu) 
                        {
                          $selected = ($list_menu->idMenu==$linea)?'selected="selected"':'';
                      
                          echo '<option value="'.$list_menu->idMenu.'" '.$selected.'>'.$list_menu->descripcion.'</option>';
                        }
                      ?>
                    </select>
                  </div>  
                </div>

                <div class="form-group">
                  <label for="url" class="col-sm-2 control-label">URL</label>
                  <div class="col-sm-8">
                    <?php echo form_input($url); ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="iconos" class="col-sm-2 control-label">Icono</label>
                  <div class="col-sm-8">
                    <?php echo form_input($iconos); ?>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="estado" class="col-sm-2 control-label">Estado</label>
                  <div class="col-sm-8">
                      <?php echo  form_dropdown('estado', $estado, set_value('estado', @$menu[0]->estado),'class="form-control" id="estado" '.$disabled.' '); ?>                    
                  </div>  
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="button" onclick="regresar()" class="btn btn-default">Regresar</button>
                <?php if($titulo == 'Nuevo Menú'){ ?>
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
    