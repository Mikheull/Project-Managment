<?php 
if(defined(secure_files)){
    http_response_code(403);
     die('Forbidden');
}
?>