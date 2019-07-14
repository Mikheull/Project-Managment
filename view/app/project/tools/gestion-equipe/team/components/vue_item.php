<tbody>
    <tr>
        <td style="width: 50%"><?= $tm['name'] ;?></td>
        <td style="width: 30%"><?= $tm['date_creation'] ;?></td>
        <td style="width: 10%" class="text-align-center"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam('2') ?>/t/gestion-equipe/team/<?= $tm['public_token'] ;?>/edit"><i class="fas fa-ellipsis-h"> </i> </a> </td>
    </tr>
</tbody>