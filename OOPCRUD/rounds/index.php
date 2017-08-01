<?php
	error_reporting(E_ALL);
    ini_set('display_errors', 'on');

    if(isset($_POST['table'])) {
        // Set Table
        if ($_POST['table'] == "rounds") {
            require("rounds.php");
            $table = new Rounds(
                $_POST['id'],
                $_POST['course_id'],
				$_POST['person_id'],
				$_POST['strokes01'],
				$_POST['strokes02'],
				$_POST['strokes03'],
				$_POST['strokes04'],
				$_POST['strokes05'],
				$_POST['strokes06'],
				$_POST['strokes07'],
				$_POST['strokes08'],
				$_POST['strokes09'],
				$_POST['strokes10'],
				$_POST['strokes11'],
				$_POST['strokes12'],
				$_POST['strokes13'],
				$_POST['strokes14'],
				$_POST['strokes15'],
				$_POST['strokes16'],
				$_POST['strokes17'],
				$_POST['strokes18'],
				$_POST['teedate'],
				$_POST['teetime']
            );
        }

        // Select Action
            if($_POST['action'] == "displayList"  ) $table->displayListScreen();
        elseif($_POST['action'] == "displayCreate") $table->displayCreateScreen();
        elseif($_POST['action'] == "createRecord" ) $table->createRecord();
        elseif($_POST['action'] == "displayRead"  ) $table->displayReadScreen();
        elseif($_POST['action'] == "displayUpdate") $table->displayUpdateScreen();
        elseif($_POST['action'] == "updateRecord" ) $table->updateRecord();
        elseif($_POST['action'] == "displayDelete") $table->displayDeleteScreen();
        elseif($_POST['action'] == "deleteRecord" ) $table->deleteRecord();
    }
?>