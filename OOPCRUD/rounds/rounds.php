<?php

    require_once("../php/database.php");
    require_once("../php/table.php");
    
    class Rounds implements Table {
        // DATA MEMBERS
        private $id;
        private $course_id;
        private $course_idErr;
		private $person_id;
        private $person_idErr;
		private $strokes01;
        private $strokes01Err;
		private $strokes02;
        private $strokes02Err;
		private $strokes03;
        private $strokes03Err;
		private $strokes04;
        private $strokes04Err;
		private $strokes05;
        private $strokes05Err;
		private $strokes06;
        private $strokes06Err;
		private $strokes07;
        private $strokes07Err;
		private $strokes08;
        private $strokes08Err;
		private $strokes09;
        private $strokes09Err;
		private $strokes10;
        private $strokes10Err;
		private $strokes11;
        private $strokes11Err;
		private $strokes12;
        private $strokes12Err;
		private $strokes13;
        private $strokes13Err;
		private $strokes14;
        private $strokes14Err;
		private $strokes15;
        private $strokes15Err;
		private $strokes16;
        private $strokes16Err;
		private $strokes17;
        private $strokes17Err;
		private $strokes18;
        private $strokes18Err;
		private $teedate;
        private $teedateErr;
		private $teetime;
        private $teetimeErr;

        // CONSTRUCTOR
        function __construct($id, $course_id, $person_id, $strokes01, $strokes02, $strokes03, $strokes04, $strokes05, $strokes06, $strokes07, $strokes08, $strokes09, $strokes10, $strokes11, $strokes12, $strokes13, $strokes14, $strokes15, $strokes16, $strokes17, $strokes18, $teedate, $teetime) {

			$this->id=$id;
			$this->course_id=$course_id; 
			$this->person_id=$person_id; 
			$this->strokes01=$strokes01;
			$this->strokes02=$strokes02;
			$this->strokes03=$strokes03; 
			$this->strokes04=$strokes04; 
			$this->strokes05=$strokes05; 
			$this->strokes06=$strokes06; 
			$this->strokes07=$strokes07; 
			$this->strokes08=$strokes08; 
			$this->strokes09=$strokes09; 
			$this->strokes10=$strokes10; 
			$this->strokes11=$strokes11; 
			$this->strokes12=$strokes12; 
			$this->strokes13=$strokes13; 
			$this->strokes14=$strokes14; 
			$this->strokes15=$strokes15; 
			$this->strokes16=$strokes16; 
			$this->strokes17=$strokes17; 
			$this->strokes18=$strokes18; 
			$this->teedate=$teedate; 
			$this->teetime=$teetime; 
        }
    
        // Display a table containing details about every record in the database.
        public function displayListScreen() {
            echo "
                <div class='container'>
                    <div class='span10 offset1'>
                        <div class='row'>
                            <h3>Rounds</h3>
                        </div>
                        <div class='row'>
                            <a class='btn btn-primary' style='width:125px;' onclick='roundsRequest(\"displayCreate\")'>Add Round</a>
                            <table class='table table-striped table-bordered' style='background-color: lightgrey !important'>
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
										<th>Score</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>";                                    
           foreach (Database::prepare('SELECT persons.fname as name, persons.email as email, persons.phone as phone, rounds.id as r_id, strokes01+strokes02+strokes03+strokes04+strokes05+strokes06+strokes07+strokes08+strokes09+strokes10+strokes11+strokes12+strokes13+strokes14+strokes15+strokes16+strokes17+strokes18 AS TotalSum FROM `tt_rounds` as rounds Inner Join tt_persons as persons where rounds.person_id = persons.id', array()) as $row) {
                echo "
                    <tr>
                        <td>{$row['name'] } </td>
                        <td>{$row['email'] }</td>
                        <td>{$row['phone']}</td>
						<td>{$row['TotalSum']}</td>
                        <td>
                            <button class='btn' onclick='roundsRequest(\"displayRead\", {$row['r_id']})'>Read</button><br>
                            <button class='btn btn-success' onclick='roundsRequest(\"displayUpdate\", {$row['r_id']})'>Update</button><br>
                            <button class='btn btn-danger' onclick='roundsRequest(\"displayDelete\", {$row['r_id']})'>Delete</button>
                        </td>
                    </tr>";
            }
            echo "</tbody></table></div></div></div>";
        } 
        
        // Display a form for adding a record to the database.
        public function displayCreateScreen() {
            echo "
                <div class='container'>
                    <div class='span10 offset1'>
                        <div class='row'>
                            <h3>Create Course</h3>
                        </div>
                        <div class='form-horizontal'>
                            <div class='control-group'>
                                <label class='control-label". ((empty($this->course_id))?'':' error') ."'>CourseID</label>
                                <div class='controls'>
                                    <input id='course_id' type='text' required>
                                    <span class='help-inline'>{$this->course_idErr}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->person_id))?'':' error') ."'>Person ID</label>
                                <div class='controls'>
                                    <input id='person_id' type='text' required>
                                    <span class='help-inline'>{$this->person_idErr}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes01))?'':' error') ."'>strokes Hole 1</label>
                                <div class='controls'>
                                    <input id='strokes01' type='text' required>
                                    <span class='help-inline'>{$this->strokes01Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes02))?'':' error') ."'>strokes Hole 2</label>
                                <div class='controls'>
                                    <input id='strokes02' type='text' required>
                                    <span class='help-inline'>{$this->strokes02Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes03))?'':' error') ."'>strokes Hole 3</label>
                                <div class='controls'>
                                    <input id='strokes03' type='text' required>
                                    <span class='help-inline'>{$this->strokes03Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes04))?'':' error') ."'>strokes Hole 4</label>
                                <div class='controls'>
                                    <input id='strokes04' type='text' required>
                                    <span class='help-inline'>{$this->strokes04Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes05))?'':' error') ."'>strokes Hole 5</label>
                                <div class='controls'>
                                    <input id='strokes05' type='text' required>
                                    <span class='help-inline'>{$this->strokes05Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes06))?'':' error') ."'>strokes Hole 6</label>
                                <div class='controls'>
                                    <input id='strokes06' type='text' required>
                                    <span class='help-inline'>{$this->strokes06Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes07))?'':' error') ."'>strokes Hole 7</label>
                                <div class='controls'>
                                    <input id='strokes07' type='text' required>
                                    <span class='help-inline'>{$this->strokes07Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes08))?'':' error') ."'>strokes Hole 8</label>
                                <div class='controls'>
                                    <input id='strokes08' type='text' required>
                                    <span class='help-inline'>{$this->strokes08Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes09))?'':' error') ."'>strokes Hole 9</label>
                                <div class='controls'>
                                    <input id='strokes09' type='text' required>
                                    <span class='help-inline'>{$this->strokes09Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes10))?'':' error') ."'>strokes Hole 10</label>
                                <div class='controls'>
                                    <input id='strokes10' type='text' required>
                                    <span class='help-inline'>{$this->strokes10Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes11))?'':' error') ."'>strokes Hole 11</label>
                                <div class='controls'>
                                    <input id='strokes11' type='text' required>
                                    <span class='help-inline'>{$this->strokes11Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes12))?'':' error') ."'>strokes Hole 12</label>
                                <div class='controls'>
                                    <input id='strokes12' type='text' required>
                                    <span class='help-inline'>{$this->strokes12Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes13))?'':' error') ."'>strokes Hole 13</label>
                                <div class='controls'>
                                    <input id='strokes13' type='text' required>
                                    <span class='help-inline'>{$this->strokes13Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes14))?'':' error') ."'>strokes Hole 14</label>
                                <div class='controls'>
                                    <input id='strokes14' type='text' required>
                                    <span class='help-inline'>{$this->strokes14Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes15))?'':' error') ."'>strokes Hole 15</label>
                                <div class='controls'>
                                    <input id='strokes15' type='text' required>
                                    <span class='help-inline'>{$this->strokes15Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes16))?'':' error') ."'>strokes Hole 16</label>
                                <div class='controls'>
                                    <input id='strokes16' type='text' required>
                                    <span class='help-inline'>{$this->strokes16Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes17))?'':' error') ."'>strokes Hole 17</label>
                                <div class='controls'>
                                    <input id='strokes17' type='text' required>
                                    <span class='help-inline'>{$this->strokes17Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes18))?'':' error') ."'>strokes Hole 18</label>
                                <div class='controls'>
                                    <input id='strokes18' type='text' required>
                                    <span class='help-inline'>{$this->strokes18Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->teedate))?'':' error') ."'>Tee Date</label>
                                <div class='controls'>
                                    <input id='teedate' type='text' required>
                                    <span class='help-inline'>{$this->teedateErr}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->teetime))?'':' error') ."'>Tee Time</label>
                                <div class='controls'>
                                    <input id='teetime' type='text' required>
                                    <span class='help-inline'>{$this->teetimeErr}</span>
                                </div>
                            </div>
                            <div class='form-actions'>
                                <button class='btn btn-success' onclick='roundsRequest(\"createRecord\")'>Create</button>
                                <a class='btn' onclick='roundsRequest(\"displayList\")'>Back</a>
                            </div>
                        </div>
                    </div>
                </div>";
        }
        
        // Adds a record to the database.
        public function createRecord() {
            if ($this->validate()) {
                Database::prepare(
                    "INSERT INTO tt_rounds (course_id, person_id, strokes01, strokes02, strokes03, strokes04, strokes05, strokes06, strokes07, strokes08, strokes09, strokes10, strokes11, strokes12, strokes13, strokes14, strokes15, strokes16, strokes17, strokes18, teedate, teetime) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
                    array($this->course_id, $this->person_id, $this->strokes01, $this->strokes02, $this->strokes03, $this->strokes04, $this->strokes05, $this->strokes06, $this->strokes07, $this->strokes08, $this->strokes09, $this->strokes10, $this->strokes11, $this->strokes12, $this->strokes13, $this->strokes14, $this->strokes15, $this->strokes16, $this->strokes17, $this->strokes18, $this->teedate, $this->teetime)
                );
                $this->displayListScreen();
            } else {
                $this->displayCreateScreen();
            }
        }
        
        // Display a form containing information about a specified record in the database.
        public function displayReadScreen() {
            $rec = Database::prepare(
                "SELECT * FROM tt_rounds WHERE id = ?", 
                array($this->id)
            )->fetch(PDO::FETCH_ASSOC);
            echo "
                <div class='container'>
                    <div class='span10 offset1'>
                        <div class='row'>
                            <h3>Person Details</h3>
                        </div>
                        <div class='form-horizontal'>
                            <div class='control-group'>
                                <label class='control-label'>Course ID:&nbsp;</label>
                                        {$rec['course_id']}
                            </div>
							<div class='control-group'>
                                <label class='control-label'>Person ID:&nbsp;</label>
                                        {$rec['person_id']}
                            </div>
							<div class='control-group'>
                                <label class='control-label'>Hole 1 strokes:&nbsp;</label>
                                        {$rec['strokes01']}
                            </div>
							<div class='control-group'>
                                <label class='control-label'>Hole 2 strokes:&nbsp;</label>
                                        {$rec['strokes02']}
                            </div>
							<div class='control-group'>
                                <label class='control-label'>Hole 3 strokes:&nbsp;</label>
                                        {$rec['strokes03']}
                            </div>
							<div class='control-group'>
                                <label class='control-label'>Hole 4 strokes:&nbsp;</label>
                                        {$rec['strokes04']}
                            </div>
							<div class='control-group'>
                                <label class='control-label'>Hole 5 strokes:&nbsp;</label>
                                        {$rec['strokes05']}
                            </div>
							<div class='control-group'>
                                <label class='control-label'>Hole 6 strokes:&nbsp;</label>
                                        {$rec['strokes06']}
                            </div>
							<div class='control-group'>
                                <label class='control-label'>Hole 7 strokes:&nbsp;</label>
                                        {$rec['strokes07']}
                            </div>
							<div class='control-group'>
                                <label class='control-label'>Hole 8 strokes:&nbsp;</label>
                                        {$rec['strokes08']}
                            </div>
							<div class='control-group'>
                                <label class='control-label'>Hole 9 strokes:&nbsp;</label>
                                        {$rec['strokes09']}
                            </div>
							<div class='control-group'>
                                <label class='control-label'>Hole 10 strokes:&nbsp;</label>
                                        {$rec['strokes10']}
                            </div>
							<div class='control-group'>
                                <label class='control-label'>Hole 11 strokes:&nbsp;</label>
                                        {$rec['strokes11']}
                            </div>
							<div class='control-group'>
                                <label class='control-label'>Hole 13 strokes:&nbsp;</label>
                                        {$rec['strokes13']}
                            </div>
							<div class='control-group'>
                                <label class='control-label'>Hole 14 strokes:&nbsp;</label>
                                        {$rec['strokes14']}
                            </div>
							<div class='control-group'>
                                <label class='control-label'>Hole 15 strokes:&nbsp;</label>
                                        {$rec['strokes15']}
                            </div>
							<div class='control-group'>
                                <label class='control-label'>Hole 16 strokes:&nbsp;</label>
                                        {$rec['strokes16']}
                            </div>
							<div class='control-group'>
                                <label class='control-label'>Hole 17 strokes:&nbsp;</label>
                                        {$rec['strokes17']}
                            </div>
							<div class='control-group'>
                                <label class='control-label'>Hole 18 strokes:&nbsp;</label>
                                        {$rec['strokes18']}
                            </div>
							<div class='control-group'>
                                <label class='control-label'>Tee Date:&nbsp;</label>
                                        {$rec['teedate']}
                            </div>
							<div class='control-group'>
                                <label class='control-label'>Tee Time:&nbsp;</label>
                                        {$rec['teetime']}
                            </div>
                            <div class='form-actions'>
                                <a class='btn' onclick='roundsRequest(\"displayList\")'>Back</a>
                            </div>
                        </div>
                    </div>
                </div>";
        }
        
        // Display a form for updating a record within the database.
        public function displayUpdateScreen() {
            $rec = Database::prepare(
                "SELECT * FROM tt_rounds WHERE id = ?", 
                array($this->id)
            )->fetch(PDO::FETCH_ASSOC);
            echo "
                <div class='container'>
                    <div class='span10 offset1'>
                        <div class='row'>
                            <h3>Update Person</h3>
                        </div>
                        <div class='form-horizontal'>

							<div class='control-group'>
                                <label class='control-label". ((empty($this->course_id))?'':' error') ."'>Course ID</label>
                                <div class='controls'>
                                    <input id='course_id' type='text' value='{$rec['course_id']}'  required>
                                    <span class='help-inline'>{$this->course_idErr}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->city))?'':' error') ."'>Person ID</label>
                                <div class='controls'>
                                    <input id='person_id' type='text' value='{$rec['person_id']}'  required>
                                    <span class='help-inline'>{$this->person_idErr}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes01))?'':' error') ."'>strokes Hole 1</label>
                                <div class='controls'>
                                    <input id='strokes01' type='text' value='{$rec['strokes01']}'  required>
                                    <span class='help-inline'>{$this->strokes01Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes02))?'':' error') ."'>strokes Hole 2</label>
                                <div class='controls'>
                                    <input id='strokes02' type='text' value='{$rec['strokes02']}'  required>
                                    <span class='help-inline'>{$this->strokes02Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes03))?'':' error') ."'>strokes Hole 3</label>
                                <div class='controls'>
                                    <input id='strokes03' type='text' value='{$rec['strokes03']}'  required>
                                    <span class='help-inline'>{$this->strokes03Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes04))?'':' error') ."'>strokes Hole 4</label>
                                <div class='controls'>
                                    <input id='strokes04' type='text' value='{$rec['strokes04']}'  required>
                                    <span class='help-inline'>{$this->strokes04Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes05))?'':' error') ."'>strokes Hole 5</label>
                                <div class='controls'>
                                    <input id='strokes05' type='text' value='{$rec['strokes05']}'  required>
                                    <span class='help-inline'>{$this->strokes05Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes06))?'':' error') ."'>strokes Hole 6</label>
                                <div class='controls'>
                                    <input id='strokes06' type='text' value='{$rec['strokes06']}'  required>
                                    <span class='help-inline'>{$this->strokes06Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes07))?'':' error') ."'>strokes Hole 7</label>
                                <div class='controls'>
                                    <input id='strokes07' type='text' value='{$rec['strokes07']}'  required>
                                    <span class='help-inline'>{$this->strokes07Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes08))?'':' error') ."'>strokes Hole 8</label>
                                <div class='controls'>
                                    <input id='strokes08' type='text' value='{$rec['strokes08']}'  required>
                                    <span class='help-inline'>{$this->strokes08Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes09))?'':' error') ."'>strokes Hole 9</label>
                                <div class='controls'>
                                    <input id='strokes09' type='text' value='{$rec['strokes09']}'  required>
                                    <span class='help-inline'>{$this->strokes09Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes10))?'':' error') ."'>strokes Hole 10</label>
                                <div class='controls'>
                                    <input id='strokes10' type='text' value='{$rec['strokes10']}'  required>
                                    <span class='help-inline'>{$this->strokes10Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes11))?'':' error') ."'>strokes Hole 11</label>
                                <div class='controls'>
                                    <input id='strokes11' type='text' value='{$rec['strokes11']}'  required>
                                    <span class='help-inline'>{$this->strokes11Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes12))?'':' error') ."'>strokes Hole 12</label>
                                <div class='controls'>
                                    <input id='strokes12' type='text' value='{$rec['strokes12']}'  required>
                                    <span class='help-inline'>{$this->strokes12Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes13))?'':' error') ."'>strokes Hole 13</label>
                                <div class='controls'>
                                    <input id='strokes13' type='text' value='{$rec['strokes13']}'  required>
                                    <span class='help-inline'>{$this->strokes13Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes14))?'':' error') ."'>strokes Hole 14</label>
                                <div class='controls'>
                                    <input id='strokes14' type='text' value='{$rec['strokes14']}'  required>
                                    <span class='help-inline'>{$this->strokes14Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes15))?'':' error') ."'>strokes Hole 15</label>
                                <div class='controls'>
                                    <input id='strokes15' type='text' value='{$rec['strokes15']}'  required>
                                    <span class='help-inline'>{$this->strokes15Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes16))?'':' error') ."'>strokes Hole 16</label>
                                <div class='controls'>
                                    <input id='strokes16' type='text' value='{$rec['strokes16']}'  required>
                                    <span class='help-inline'>{$this->strokes16Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes17))?'':' error') ."'>strokes Hole 17</label>
                                <div class='controls'>
                                    <input id='strokes17' type='text' value='{$rec['strokes17']}'  required>
                                    <span class='help-inline'>{$this->strokes17Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->strokes18))?'':' error') ."'>strokes Hole 18</label>
                                <div class='controls'>
                                    <input id='strokes18' type='text' value='{$rec['strokes18']}'  required>
                                    <span class='help-inline'>{$this->strokes18Err}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->teedate))?'':' error') ."'>Tee Date</label>
                                <div class='controls'>
                                    <input id='teedate' type='text' value='{$rec['teedate']}'  required>
                                    <span class='help-inline'>{$this->teedateErr}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->teetime))?'':' error') ."'>Tee Time</label>
                                <div class='controls'>
                                    <input id='teetime' type='text' value='{$rec['teetime']}'  required>
                                    <span class='help-inline'>{$this->teetimeErr}</span>
                                </div>
                            </div>
                            <div class='form-actions'>
                                <button class='btn btn-success' onclick='roundsRequest(\"updateRecord\", {$this->id})'>Update</button>
                                <a class='btn' onclick='roundsRequest(\"displayList\")'>Back</a>
                            </div>
                        </div>
                    </div>
                </div>";
        }
        
        // Updates a record within the database.
        public function updateRecord() {
            if ($this->validate()) {
                Database::prepare(
                    "UPDATE tt_rounds SET course_id = ?, person_id = ?, strokes01 = ?, strokes02 = ?, strokes03 = ?, strokes04 = ?, strokes05 = ?, strokes06 = ?, strokes07 = ?, strokes08 = ?, strokes09 = ?, strokes10 = ?, strokes11 = ?, strokes12 = ?, strokes13 = ?, strokes14 = ?, strokes15 = ?, strokes16 = ?, strokes17 = ?, strokes18 = ?, teedate = ?, teetime = ? WHERE id = ?",
                    array($this->course_id, $this->person_id, $this->strokes01, $this->strokes02, $this->strokes03, $this->strokes04 , $this->strokes05 , $this->strokes06 , $this->strokes07 , $this->strokes08 , $this->strokes09 , $this->strokes10 , $this->strokes11 , $this->strokes12 , $this->strokes13 , $this->strokes14 , $this->strokes15 , $this->strokes16 ,$this->strokes17 ,$this->strokes18, $this->teedate, $this->teetime, $this->id)
                );
                $this->displayListScreen();
            } else {
                $this->displayUpdateScreen();
            }
        }
        
        // Display a form for deleting a record from the database.
        public function displayDeleteScreen() {
            echo "
                <div class='container'>
                    <div class='span10 offset1'>
                        <div class='row'>
                            <h3>Delete Rounds</h3>
                        </div>
                        <div class='form-horizontal'>
                            <p class='alert alert-error'>Are you sure you want to delete ?</p>
                            <div class='form-actions'>
                                <button id='submit' class='btn btn-danger' onClick='roundsRequest(\"deleteRecord\", {$this->id});'>Yes</button>
                                <a class='btn' onclick='roundsRequest(\"displayList\")'>Back</a>
                            </div>
                        </div>
                    </div>
                </div>";
        }
        
        // Removes a record from the database.
        public function deleteRecord() {
            Database::prepare(
                "DELETE FROM tt_rounds WHERE id = ?",
                array($this->id)
            );
            $this->displayListScreen();
        }
        
        // Validates user input.
        private function validate() {
            $valid = true;
            // Check for empty input.
            if (empty($this->course_id)) { 
                $this->course_idErr = "Please enter a course id.";
                $valid = false; 
            }
			if (empty($this->person_id)) { 
                $this->person_idErr = "Please enter a person id.";
                $valid = false; 
            }
			if (empty($this->strokes01)) { 
                $this->strokes01Err = "Please enter an strokes.";
                $valid = false; 
            }
			if (empty($this->strokes02)) { 
                $this->strokes02Err = "Please enter an strokes.";
                $valid = false; 
            }
			if (empty($this->strokes03)) { 
                $this->strokes03Err = "Please enter an strokes.";
                $valid = false; 
            }
			if (empty($this->strokes04)) { 
                $this->strokes04Err = "Please enter an strokes.";
                $valid = false; 
            }
			if (empty($this->strokes05)) { 
                $this->strokes05Err = "Please enter an strokes.";
                $valid = false; 
            }
			if (empty($this->strokes06)) { 
                $this->strokes06Err = "Please enter an strokes.";
                $valid = false; 
            }
			if (empty($this->strokes07)) { 
                $this->strokes07Err = "Please enter an strokes.";
                $valid = false; 
            }
			if (empty($this->strokes08)) { 
                $this->strokes08Err = "Please enter an strokes.";
                $valid = false; 
            }
			if (empty($this->strokes09)) { 
                $this->strokes09Err = "Please enter an strokes.";
                $valid = false; 
            }
			if (empty($this->strokes10)) { 
                $this->strokes10Err = "Please enter an strokes.";
                $valid = false; 
            }
			if (empty($this->strokes11)) { 
                $this->strokes11Err = "Please enter an strokes.";
                $valid = false; 
            }
			if (empty($this->strokes12)) { 
                $this->strokes12Err = "Please enter an strokes.";
                $valid = false; 
            }
			if (empty($this->strokes13)) { 
                $this->strokes13Err = "Please enter an strokes.";
                $valid = false; 
            }
			if (empty($this->strokes14)) { 
                $this->strokes14Err = "Please enter an strokes.";
                $valid = false; 
            }
			if (empty($this->strokes15)) { 
                $this->strokes15Err = "Please enter an strokes.";
                $valid = false; 
            }
			if (empty($this->strokes16)) { 
                $this->strokes16Err = "Please enter an strokes.";
                $valid = false; 
            }
			if (empty($this->strokes17)) { 
                $this->strokes17Err = "Please enter an strokes.";
                $valid = false; 
            }
			if (empty($this->strokes18)) { 
                $this->strokes18Err = "Please enter an strokes.";
                $valid = false; 
            }
			if (empty($this->teedate)) { 
                $this->teedateErr = "Please enter an teedate.";
                $valid = false; 
            }
			if (empty($this->teetime)) { 
                $this->teetimeErr = "Please enter an teetime.";
                $valid = false; 
            }
            print_r($valid);
            return $valid;
        }
    }
?>
