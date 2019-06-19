<?php


/**
 * Script du générateur de tableau rapport
 * 
 * utilisé dans :
 *  (Direct) - dist/js/task/reports.js
 *  (Direct) - dist/js/task/reports.min.js
 * 
 */

/******************************************************************************/


/**
 * Declaration des variables
 */
session_start();

require_once ('../../../../db.php');

require_once ('../../../../model/class/main.php');
require_once ('../../../../model/class/db_connect.php');

require_once ('../../../../model/class/router.php');
require_once ('../../../../model/class/config.php');
require_once ('../../../../model/class/user.php');
require_once ('../../../../model/class/project.php');
require_once ('../../../../model/class/task.php');
require_once ('../../../../model/class/authentication.php');
require_once ('../../../../model/class/utils.php');


$main = new main();
$router = new router($db);
$config = new config();
$user = new user($db);
$project = new project($db);
$task = new task($db);
$auth = new authentication($db);
$utils = new utils($db);

$project_token = $_POST['ref'];
$activity = $task -> getActivity( $project_token );

?>

    <script>
        const squares = document.querySelector('.squares');
        let dayPerMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        let months = ['janvier', 'fevrier', 'mars', 'avril', 'mai', 'juin', 'juillet', 'aout', 'septembre', 'octobre', 'novembre', 'decembre']
        let indice = 0;
        let day = 0;

        for (var i = 1; i < 366; i++) {
            if( day >= dayPerMonth[indice] ){
                indice ++;
                day = 0;
            }
            day ++;
            
            const level = Math.floor(Math.random() * 4);
            squares.insertAdjacentHTML('beforeend', `<li data-level="${level}" class="test link" data-tippy-content="${day} ${months[indice]} 2019"></li>`);
        }



        
        tippy('.test')
    </script>

<?php


// End of file
/******************************************************************************/
