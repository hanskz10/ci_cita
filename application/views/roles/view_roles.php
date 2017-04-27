    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Lista de roles</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Mantenimiento</a></li>
        <li class="active">Roles</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div id="mensaje"></div>
          <div class="box">
            <div class="box-body">
              <a href="roles/NuevoRol">
                <button type="button" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Rol</button>
              </a>
              <table id="GridRoles" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th class="no-sort"></th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  if($roles)
                  {
                    foreach($roles as $rol)
                    {
                      $idRol = base64_encode($rol->idRol);
                      echo '<tr>';
                      echo '<td>'.$rol->descripcion.'</td>';
                      echo '<td>';
                      if($rol->estado == 1)
                      {
                        echo "<span class='label label-primary'>Activado</span>";
                      } else {
                        echo "<span class='label label-danger'>Desactivado</span>";
                      }  
                      echo '</td>';
                      echo '<td>';
                      echo '<a href="roles/EditarRol/'.$idRol.'"><button type="button" title="Editar rol" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></button></a> &nbsp;';                      
                ?>
                      <button type="button" onclick="EliminarRol('<?php echo $rol->descripcion; ?>', '<?php echo $idRol; ?>')" title="Eliminar rol" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button>
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