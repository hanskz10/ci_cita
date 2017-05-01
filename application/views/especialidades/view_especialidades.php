    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo $titulo; ?></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Mantenimiento</a></li>
        <li class="active">Especialidades</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div id="mensaje"></div>
          <div class="box">
            <div class="box-body">
              <a href="especialidades/NuevaEspecialidad">
                <button type="button" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Especialidad</button>
              </a>
              <table id="GridEspecialidades" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th class="no-sort"></th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  if($especialidades)
                  {
                    foreach($especialidades as $especialidad)
                    {
                      $idEspecialidad = base64_encode($especialidad->idEspecialidad);
                      echo '<tr>';
                      echo '<td>'.$especialidad->descripcion.'</td>';
                      echo '<td>';
                      if($especialidad->estado == 1)
                      {
                        echo "<span class='label label-primary'>Activado</span>";
                      } else {
                        echo "<span class='label label-danger'>Desactivado</span>";
                      }  
                      echo '</td>';
                      echo '<td>';
                      echo '<a href="especialidades/EditarEspecialidad/'.$idEspecialidad.'"><button type="button" title="Editar especialidad" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></button></a> &nbsp;';                      
                ?>
                      <button type="button" onclick="EliminarEspecialidad('<?php echo $especialidad->descripcion; ?>', '<?php echo $idEspecialidad; ?>')" title="Eliminar especialidad" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button>
                <?php
                      echo '</td>';  
                      echo '</tr>';
                    }
                  } else {
                    echo '<tr><td colspan=5><center>No existe información</center></td></tr>';
                  }
                ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th></th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->  