<h1>Bandeja de Entrada</h1>

<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Etapa</th>
            <th>Fecha Modificación</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($etapas as $e): ?>
            <tr>
                <td><?=$e->Tramite->id?></td>
                <td><?= $e->Tramite->Proceso->nombre ?></td>
                <td><?=$e->Tarea->nombre?></td>
                <td><?= strftime('%c',mysql_to_unix($e->updated_at))?></td>
                <td>
                    <a href="<?=site_url('etapas/ejecutar/'.$e->id)?>" class="btn btn-primary">Realizar</a>
                    <?php if($e->netapas==1):?><a href="<?=site_url('tramites/eliminar/'.$e->tramite_id)?>" class="btn btn-danger" onclick="return confirm('¿Esta seguro que desea eliminar este tramite?')"><i class="icon-trash icon-white"></i></a><?php endif ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>