<?php
class Main {
	
 private $connection;
 
    public function __construct(PDO $connection = null) {
        $this->connection = $connection;
        if ($this->connection === null) {
            try {
                $this->connection = new PDO(DB_SERVER, DB_USERNAME, DB_PASSWORD);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Połączenie nie mogło zostać utworzone.<br />';
            }
        }
    }

    public function view($page){
    	$limit = 5;
        if ($page)
            $start = ($page - 1) * $limit;    //pierwsza rzecz do wyświetlenia na stronie
        else
            $start = 0;
        $sql = "SELECT * FROM cdinfo";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        $rowsperpage = 10;
		// całkowita ilość stron
        $totalpages = ceil($count / $rowsperpage);
		// pobieranie strony bądź ustawianie domyślnej
        if ($page) {            
            $currentpage = $page;
        } else {          
            $currentpage = 1;
        } 
        if ($currentpage > $totalpages) {            
            $currentpage = $totalpages;
        } 
        if ($currentpage < 1) {    
            $currentpage = 1;
        } 
        $offset = ($currentpage - 1) * $rowsperpage;
        $sql = 'SELECT * FROM cdinfo ORDER BY data_dodania DESC Limit ' . $offset . ', ' . $rowsperpage;
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(); // fetching rows
        $count = $stmt->rowCount();
        if ($count) {
            $count = count($data); // getting count
            echo '<table class="user_table">
			<thead>
			<tr>
				<th>Nazwa CD</th>
			  	<th>Data dodania</th>
			  
			  	<th>Wykonawca</th>
			  	<th>data Wydania</th>
			  	<th>Pokaż</th>
			  	<th>Edycja</th>
			  	<th>Usuń</th>
			</tr>
			</thead>
                    <tbody>';
            foreach ($data as $row) { // iterating over rows
                echo '<tr>';
                if (strlen($row['nazwacd']) > 20) {
                    $tytul = substr($row['nazwacd'], 0, 19) . "...";
                } else {
                    $tytul = $row['nazwacd'];
                }
                echo '<td>' . $tytul . '</td>';
             	echo '<td>' . $row['data_dodania'] . '</td>';
                echo '<td>' . $row['wykonawca'] . '</td>';
                echo '<td>' . $row['data_wydania'] . '</td>';
                echo '<td><a class="see" href="index.php?f=cdview&&id=' . $row['idcdinfo'] . '">pokaż</a></td>';
                echo '<td><a class="edit" href="index.php?f=cdedit&&id=' . $row['idcdinfo'] . '">edycja</a></td>
        	<td><a class="del_cfg" href="index.php?f=cddel&&id=' . $row['idcdinfo'] . '" title="Dane płyty ' . $tytul . '">usuń</a></td>
        	</tr>';
            }
            echo '</tbody></table>';
    		$range = 3;
    		$pagedata = 'index.php?f=view';
            echo '<div class="pagination">';
            if ($currentpage > 1) {            
                echo " <a href='$pagedata&&page=1'><<</a> ";            
                $prevpage = $currentpage - 1;      
                echo " <a href='$pagedata&&page=$prevpage'><</a> ";
            } 
            for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {             
                if (($x > 0) && ($x <= $totalpages)) {                  
                    if ($x == $currentpage) {                     
                        echo ' <span class="current">' . $x . '</span> ';                      
                    } else {                        
                        echo " <a href='$pagedata&&page=$x'>$x</a> ";
                    }
                } 
            }      
            if ($currentpage != $totalpages) {          
                $nextpage = $currentpage + 1;             
                echo " <a href='$pagedata&&page=$nextpage'>></a> ";             
                echo " <a href='$pagedata&&page=$totalpages'>>></a> ";
            } 
            echo '</div>';
    	}
    	else {
        		echo '<div class="out_cont">
            		<p class="information" ><label>Brak danych w bazie.</label></p>
       				</div>';
   			}
	}

    public function add_cd(){
    		echo '<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>';
                echo '<script type="text/javascript">
          				tinymce.init({
            			selector: "textarea",
          				language : "pl",
  						theme: "modern",  
		    plugins: [
		         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
		         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
		         "save table contextmenu directionality emoticons template paste textcolor"
		   ],
		   content_css: "css/content.css",
		   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
		   style_formats: [
		        {title: \'Bold text\', inline: \'b\'},
		        {title: \'Red text\', inline: \'span\', styles: {color: \'#ff0000\'}},
		        {title: \'Red header\', block: \'h1\', styles: {color: \'#ff0000\'}},
		        {title: \'Example 1\', inline: \'span\', classes: \'example1\'},
		        {title: \'Example 2\', inline: \'span\', classes: \'example2\'},
		        {title: \'Table styles\'},
		        {title: \'Table row 1\', selector: \'tr\', classes: \'tablerow1\'}
		    ]
		 });       
        </script>
        <script>
			$(function() {
			$( "#datepicker" ).datepicker();
			});
		</script>
        ';
                echo '<form class="form-signin" method="post" style="text-align:left;" action="index.php?f=savecd">
					<div class="head">';               
                echo '
                <label>Nazwa CD:</label> <input type="text" class="input email" name="nazwa" placeholder="nazwa cd" /><br>
                <label>Wykonawca:</label> <input type="text" class="input email" name="wykonawca" placeholder="wykonawca" /><br>
                <label>Data wydania:</label><input type="text" name="data" id="datepicker" class="input email" placeholder="data wydania"><br>
					<label>Opis:</label>
					<textarea name="opis" style="resize: none; " name="opis" cols="67" rows="15"></textarea><br>';
                echo '<br>';                             
                echo '<input type="hidden" name="typ" value="insert">';
                echo '<button class="button" style="margin:0 auto;" name="zapisz_post" type="submit">
                <img src="./image/save_ico.png">Zapisz</button>';
                echo '</div></form>';
    }
    public function save_cd(){
    	if($_POST){
    		if (!empty($_POST['wykonawca']) && !empty($_POST['opis']) && !empty($_POST['nazwa']) && !empty($_POST['data'])) {
                $title = htmlspecialchars($_POST['nazwa']);
                $title = trim($title);
                $name = htmlspecialchars($_POST['wykonawca']);
                $name = trim($name);
                $opis = trim($_POST['opis']);
                $data = date('Y-m-d', strtotime($_POST['data']));
    		switch ($_POST['typ']) {
    			case 'insert':
    			$sql = 'INSERT INTO cdinfo (`idcdinfo`, `nazwacd`, `wykonawca`, `data_dodania`, `data_wydania`, `opis`)
                                VALUES (:id, :nazwa, :wyk, :data_d, :data_wyd,  :opis)';
                           $stmt = $this->connection->prepare($sql);
                           $stmt->bindValue(':id', '', PDO::PARAM_STR);                                                        
                           $stmt->bindValue(':nazwa', $title, PDO::PARAM_STR);
                           $stmt->bindValue(':wyk', $name, PDO::PARAM_STR);
                           $stmt->bindValue(':data_d', date('Y-m-d H:i:s', strtotime("now")), PDO::PARAM_STR);
                           $stmt->bindValue(':data_wyd', $data, PDO::PARAM_STR);
                           $stmt->bindValue(':opis', $opis, PDO::PARAM_STR);                          
                           $stmt->execute();
                           error('index.php?f=view',2,'Zapisano w bazie danych');
    				break;    			
    			case 'update':
    			$sql = 'update `cdinfo` set `nazwacd`=:nazwa, `wykonawca`=:wyk, `data_wydania`=:data_wyd,
    			`opis`=:opis where idcdinfo = ' . $_POST['id'];
                           $stmt = $this->connection->prepare($sql);
                           $stmt->bindValue(':nazwa', $title, PDO::PARAM_STR);
                           $stmt->bindValue(':wyk', $name, PDO::PARAM_STR);
                           $stmt->bindValue(':data_wyd', $data, PDO::PARAM_STR);
                           $stmt->bindValue(':opis', $opis, PDO::PARAM_STR);
                           $stmt->execute();
                           error('index.php?f=view',2,'Zapisano w bazie danych');   				
    				break;
    			}
    		}
    		else { error('index.php?f=addcd',2,'Nie wpisano wymaganych danych!.');}
    	}
    	else die();
    }

    public function edit_cd($idcd){
    	echo '<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>';
                echo '<script type="text/javascript">
          tinymce.init({
            selector: "textarea",
          language : "pl",
  theme: "modern",  
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor"
   ],
   content_css: "css/content.css",
   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
   style_formats: [
        {title: \'Bold text\', inline: \'b\'},
        {title: \'Red text\', inline: \'span\', styles: {color: \'#ff0000\'}},
        {title: \'Red header\', block: \'h1\', styles: {color: \'#ff0000\'}},
        {title: \'Example 1\', inline: \'span\', classes: \'example1\'},
        {title: \'Example 2\', inline: \'span\', classes: \'example2\'},
        {title: \'Table styles\'},
        {title: \'Table row 1\', selector: \'tr\', classes: \'tablerow1\'}
    ]
 });       
        </script>
         <script>
		$(function() {
		$( "#datepicker" ).datepicker();
		});
		</script>
        ';
        $sql = 'SELECT * FROM cdinfo WHERE idcdinfo=:id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $idcd, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetchAll(); // fetching rows
        $count = $stmt->rowCount();
        if ($count) {
            $count = count($data);
            foreach ($data as $row) {
                echo '<form class="form-signin" method="post" style="text-align:left;" action="index.php?f=savecd">
				<div class="head">';             
                echo '
                <label>Nazwa CD:</label> 
                <input type="text" class="input email" name="nazwa" placeholder="nazwa cd" value="'.$row['nazwacd'] .'"/><br>
                <label>Wykonawca:</label> 
                <input type="text" class="input email" name="wykonawca" placeholder="wykonawca" value="'.$row['wykonawca'] .'"/><br>
                <label>Data wydania:</label>
                <input type="text" name="data" id="datepicker" class="input email" placeholder="data wydania" value="'.$row['data_wydania'] .'"><br>
		<label>Opis:</label><textarea name="opis" style="resize: none; " name="opis" cols="67" rows="15">' . $row['opis'] . '</textarea><br>';
                echo '<br>';               
                echo '<input type="hidden" name="id" value="' . $row['idcdinfo'] . '">';
                echo '<input type="hidden" name="typ" value="update">';
                echo '<button class="button" style="margin:0 auto;" name="zapisz_post" type="submit">
                <img src="./image/save_ico.png">Zapisz</button>';
                echo '</div></form>';
            }
        }

    }

    public function del_cd($idcd){
        $stmt = $this->connection->prepare("DELETE FROM cdinfo WHERE idcdinfo=:id");
        $stmt->bindValue(':id', $idcd, PDO::PARAM_INT);
        $stmt->execute();
        error("index.php?f=view", 2, "Usunieto dane CD");
    }

    public function view_single($idcd){
    	$sql = 'SELECT * FROM cdinfo WHERE idcdinfo=:id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $idcd, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetchAll(); // fetching rows
        $count = $stmt->rowCount();
        if ($count) {
            $count = count($data);
            foreach ($data as $row) {
                echo '<form class="form-signin"><div class="head">';                
                echo '
                <label>Nazwa CD: '.$row['nazwacd'] .'</label> <br>                
                <label>Wykonawca: '.$row['wykonawca'] .'</label> <br>             
                <label>Data wydania: '.$row['data_wydania'] .'</label><br>               
		<label>Opis:</label><br>' . $row['opis'] . '<br>';
                echo '<br>';
                echo 'data dodania: '. $row['data_dodania'];
                echo '</div></form>';
            }
        }
    }

}


?>