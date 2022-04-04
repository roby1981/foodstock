<?php
if(is_numeric(end($request_url_array)))
    delete_from_database("generic", end($request_url_array));
?>