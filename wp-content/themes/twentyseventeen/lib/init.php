<?php

define("CECP_SLUG",'cecp_theme');
define ("CECP_DIR",get_template_directory().'/');
define("CECP_URL",get_template_directory_uri().'/');


require(CECP_DIR ."lib/initPostTypeClasses.php");
require(CECP_DIR ."lib/initMetaBoxes.php");
//require(CECP_DIR ."lib/customFunctions.php");
require(CECP_DIR ."lib/initWidget.php");
//require(CECP_DIR ."lib/admin/initAdmin.php");

//my-cecp 
//require(CECP_DIR ."lib/my-cecp/myCecp.php");



