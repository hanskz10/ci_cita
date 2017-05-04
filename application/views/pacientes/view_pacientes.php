    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo $titulo; ?></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Mantenimiento</a></li>
        <li class="active">Pacientes</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div id="mensaje"></div>
          <div class="box">
            <div class="box-body">
              <a href="pacientes/NuevoPaciente">
                <button type="button" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Paciente</button>
              </a>
              <table id="GridPacientes" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Apellidos</th>
                    <th>Nombres</th>
                    <th>Email</th>
                    <th>Estado</th>
                    <th class="no-sort"></th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  if($pacientes)
                  {
                    foreach($pacientes as $paciente)
                    {
                      $idPaciente = base64_encode($paciente->idPaciente);
                      echo '<tr>';
                      echo '<td>'.$paciente->apellidos.'</td>';
                      echo '<td>'.$paciente->nombre.'</td>';
                      echo '<td>'.$paciente->email.'</td>';
                      echo '<td>';
                      if($paciente->estado == 1)
                      {
                        echo "<span class='label label-primary'>Activado</span>";
                      } else {
                        echo "<span class='label label-danger'>Desactivado</span>";
                      }  
                      echo '</td>';
                      echo '<td>';
                      echo '<a href="pacientes/EditarPaciente/'.$idPaciente.'"><button type="button" title="Editar paciente" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></button></a> &nbsp;';
                ?>
                      <button type="button" onclick="EliminarPaciente('<?php echo $paciente->nombre.' '.$paciente->apellidos; ?>', '<?php echo $idPaciente; ?>')" title="Eliminar paciente" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button>
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
                    <th>Email</th>
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