<?php
$descripcion = array(
  'name'        =>  'descripcion',
  'id'          =>  'descripcion',
  'size'        =>  45,
  'value'       =>  set_value('descripcion', @$roles[0]->descripcion),
  'type'        =>  'text',
  'disabled'    =>  true,
  'class'       =>  'form-control',
  'placeholder' =>  'Ingresar rol'
);
?>
    <section class="content-header">
      <h1><?php echo $titulo; ?></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="<?php echo base_url(); ?>permisos">Permisos</a></li>
        <li class="active"><?php echo $titulo; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div id="mensaje" class="text-center"></div>
          <div class="box box-info">
            <form class="form-horizontal" name="FormPermiso" id="FormPermiso">
              <div class="box-body">
                <div class="form-group">
                  <label for="rol" class="col-sm-2 control-label">Rol</label>
                  <div class="col-sm-8">
                    <input type="hidden" value="<?php echo @$roles[0]->idRol; ?>" id="idRol" name="idRol" />
                    <?php echo form_input($descripcion); ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="especialidad" class="col-sm-2 control-label">Menú</label>
                  <div class="col-sm-8">
                    <select name="menu[]" id="menu" multiple="multiple" class="form-control" size="8">
                    <?php
                      foreach ($menus as $key => $value)
                      {
                        foreach ($permisos as $permiso)
                        {
                          if ($permiso->idMenu == $value->idMenu)
                          {
                            echo '<option value="'.$value->idMenu.'" selected="selected">'.$value->descripcion.'</option>';
                            continue 2;
                          }
                        }
                        echo '<option value="'.$value->idMenu.'">'.$value->descripcion.'</option>';
                      }
                    ?>
                    </select>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="button" onclick="regresar()" class="btn btn-default">Regresar</button>
                <button type="submit" class="btn btn-primary pull-right">Guardar</button>
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