<?php
    if(isset($_POST['table'])) {
        // Set Table
        if ($_POST['table'] == "persons") {
            require("persons.php");
            $table = new Persons(
                $_POST['id'],
                $_POST['fname'],
				$_POST['lname'],
                $_POST['email'],
                $_POST['phone'],
				$_POST['address'],
				$_POST['city'],
				$_POST['password'],
				$_POST['state'],
				$_POST['zip']
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