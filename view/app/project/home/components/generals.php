
<?php
    
    $SIZE_LIMIT = 5368709120; // 5 GB
    $disk_used = foldersize('dist/uploads/p/'. $router -> getRouteParam('2') .'/docs/');

    $disk_remaining = $SIZE_LIMIT - $disk_used;

function foldersize($path) {
    $total_size = 0;
    $files = scandir($path);
    $cleanPath = rtrim($path, '/'). '/';

    foreach($files as $t) {
        if ($t<>"." && $t<>"..") {
            $currentFile = $cleanPath . $t;
            if (is_dir($currentFile)) {
                $size = foldersize($currentFile);
                $total_size += $size;
            }
            else {
                $size = filesize($currentFile);
                $total_size += $size;
            }
        }   
    }

    return $total_size;
}

function format_size($size) {
    $units = explode(' ', 'B KB MB GB TB PB');
    $mod = 1024;
    
    for ($i = 0; $size > $mod; $i++) {
        $size /= $mod;
    }

    $endIndex = strpos($size, ".")+3;

    return substr( $size, 0, $endIndex).' '.$units[$i];
}

?>


<div class="col-12 zone_item">
    <div class="content light-border p-3">
        <div class="heading mr-bot"> <span class="color-dark text-sm">Informations du projet</span> </div>

        <div class="body">
            <div class="container inf_container">
                <div class="row">
                    <div class="col-lg-2 col-md-6 col-12">
                        <div class="p-3 inf_item">
                            <div class="inf">
                                <i data-feather="calendar"></i>
                            </div>
                            <div class="val">
                               <span>Créer le <?= $utils -> getData('pr_project', 'date_begin', 'public_token', $router -> getRouteParam('2') ) ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6 col-12">
                        <div class="p-3 inf_item">
                            <div class="inf">
                                <i data-feather="users"></i>
                            </div>
                            <div class="val">
                               <span><?= $allMembers['count'] ?> Membre<?= ($allMembers['count'] > 1) ? 's' : '' ?></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-md-6 col-12">
                        <div class="p-3 inf_item">
                            <div class="inf">
                                <i data-feather="bookmark"></i>
                            </div>
                            <div class="val">
                               <span><?= $allTasks['count'] ?> Tache<?= ($allTasks['count'] > 1) ? 's' : '' ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6 col-12">
                        <div class="p-3 inf_item">
                            <div class="inf">
                                <i data-feather="file-text"></i>
                            </div>
                            <div class="val">
                               <span>Documents (<?= format_size($disk_used) .'/5GB' ?>)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


