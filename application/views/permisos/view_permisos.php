    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Lista de permisos</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Mantenimiento</a></li>
        <li class="active">Permisos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <table id="GridPermisos" class="table table-bordered table-striped">
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
                      echo '<a href="permisos/EditarPermiso/'.$idRol.'"><button type="button" title="Ver permisos" class="btn btn-success btn-xs"><span class="fa fa-search"></span></button></a> &nbsp;';
                      echo '</td>';  
                      echo '</tr>';
                    }
                  } else {
                    echo '<tr><td colspan=3><center>No existe información</center></td></tr>';
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