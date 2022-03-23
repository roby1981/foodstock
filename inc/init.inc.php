<?php
// Re(start) Session
session_name(SESSION_NAME);
session_start();

// Create DB Class
$Database = new mysqli(DB_HOST, DB_USER, DB_PW, DB_NAME);