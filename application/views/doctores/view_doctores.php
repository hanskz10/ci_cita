    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo $titulo; ?></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Mantenimiento</a></li>
        <li class="active">Doctores</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div id="mensaje"></div>
          <div class="box">
            <div class="box-body">
              <a href="doctores/NuevoDoctor">
                <button type="button" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Doctor</button>
              </a>
              <table id="GridDoctores" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Apellidos</th>
                    <th>Nombres</th>
                    <th>Especialidad</th>
                    <th>Estado</th>
                    <th class="no-sort"></th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  if($doctores)
                  {
                    foreach($doctores as $doctor)
                    {
                      $idDoctor = base64_encode($doctor->idDoctor);
                      echo '<tr>';
                      echo '<td>'.$doctor->apellidos.'</td>';
                      echo '<td>'.$doctor->nombre.'</td>';
                      echo '<td>'.$doctor->especialidad.'</td>';
                      echo '<td>';
                      if($doctor->estado == 1)
                      {
                        echo "<span class='label label-primary'>Activado</span>";
                      } else {
                        echo "<span class='label label-danger'>Desactivado</span>";
                      }  
                      echo '</td>';
                      echo '<td>';
                      echo '<a href="doctores/EditarDoctor/'.$idDoctor.'"><button type="button" title="Editar doctor" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></button></a> &nbsp;';                      
                ?>
                      <button type="button" onclick="EliminarDoctor('<?php echo $doctor->nombre.' '.$doctor->apellidos; ?>', '<?php echo $idDoctor; ?>')" title="Eliminar doctor" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button>
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
                    <th>Apellidos</th>
                    <th>Nombres</th>
                    <th>Especialidad</th>
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