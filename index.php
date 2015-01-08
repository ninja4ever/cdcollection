<?php
include_once 'core/tool_functions.php';
__autoload("core/dbconfig.php");
__autoload("core/cd_functions.class.php");
$main = new Main;
?>
<!doctype html>
<head>
	<title>Kolekcja płyt CD</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/sitecss.css" rel="stylesheet">

    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/jquery-ui-1.10.4.js"></script>
    <link href="css/jquery-ui-1.10.4.custom.css" rel="stylesheet">

    <script src="js/del_info.js" type="text/javascript"></script>
</head>
<body>
    <div id="wrapper">
        <div id="header">
        	<nav class="menu1">
                <ul class="main">
                   <li> <a href="index.php" ><img src="image/home_ico_2.png" alt="strona domowa">Home</a> </li>
                    <li> <a href="index.php?f=addcd"><img src="image/add_ico.png" alt="dodawanie">Dodaj płytę CD</a> </li>
                </ul>
            </nav>

        </div>
        <div id="content">
        	<?php
        	if(isset($_GET['f'])){
        		$f = $_GET['f'];
        	if (isset($_GET['id'])) {
            $id = $_GET['id'];
        	}
        	if (isset($_GET['page'])) {
            $page = $_GET['page'];
        	} else {
            $page = '0';
        	}

        		switch ($f) {
        			case 'view':
        				$main->view($page);
        				break;
        			case 'addcd':
        				$main->add_cd();
        				break;
        			case 'savecd':
        				$main->save_cd();
        				break;
        			case 'cddel':
        				$main->del_cd($id);
        				break;
        			case 'cdedit':
        				$main->edit_cd($id);
        				break;
        			case 'cdview':
        				$main->view_single($id);
        				break;
        		}
        		
        	}
        	else 
        	{
	        	
	            $page = '0';
	        	
        		$main->view($page);
        	}

        	?>
        </div>
    </div>

    <div id="dialog-confirm"></div>
</body>
</html>