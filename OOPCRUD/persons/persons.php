<?php
    require_once("../php/database.php");
    require_once("../php/table.php");
    
    class Persons implements Table {
        // DATA MEMBERS
        private $id;
        private $fname;
        private $fnameErr;
		private $lname;
        private $lnameErr;
        private $email;
        private $emailErr;
        private $phone;
        private $phoneErr;
		private $address;
        private $addressErr;
		private $city;
        private $cityErr;
		private $password;
        private $passwordErr;
		private $state;
        private $stateErr;
		private $zip;
        private $zipErr;

        
        // CONSTRUCTOR
        function __construct($id, $fname, $lname, $email, $phone, $address, $city, $password, $state, $zip) {
            $this->id     = $id;
            $this->fname   = $fname;
			$this->lname   = $lname;
            $this->email  = $email;
            $this->phone = $phone;
			$this->address = $address;
			$this->city = $city;
			$this->password = $password;
			$this->state = $state;
			$this->zip = $zip;
        }
    
        // Display a table containing details about every record in the database.
        public function displayListScreen() {
            echo "
                <div class='container'>
                    <div class='span10 offset1'>
                        <div class='row'>
                            <h3>Persons</h3>
                        </div>
                        <div class='row'>
                            <a class='btn btn-primary' style='width:125px;' onclick='personsRequest(\"displayCreate\")'>Add Person</a>
                            <table class='table table-striped table-bordered' style='background-color: lightgrey !important'>
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>";                                    
            foreach (Database::prepare('SELECT * FROM `tt_persons`', array()) as $row) {
                echo "
                    <tr>
                        <td>{$row['fname'] } {$row['lname']}</td>
                        <td>{$row['email'] }</td>
                        <td>{$row['phone']}</td>
                        <td>
                            <button class='btn' onclick='personsRequest(\"displayRead\", {$row['id']})'>Read</button><br>
                            <button class='btn btn-success' onclick='personsRequest(\"displayUpdate\", {$row['id']})'>Update</button><br>
                            <button class='btn btn-danger' onclick='personsRequest(\"displayDelete\", {$row['id']})'>Delete</button>
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
                            <h3>Create Persons</h3>
                        </div>
                        <div class='form-horizontal'>
                            <div class='control-group'>
                                <label class='control-label". ((empty($this->fnameErr))?'':' error') ."'>First Name</label>
                                <div class='controls'>
                                    <input id='fname' type='text' required>
                                    <span class='help-inline'>{$this->fnameErr}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->lnameErr))?'':' error') ."'>Last Name</label>
                                <div class='controls'>
                                    <input id='lname' type='text' required>
                                    <span class='help-inline'>{$this->lnameErr}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->passwordErr))?'':' error') ."'>Password</label>
                                <div class='controls'>
                                    <input id='password' type='password' required>
                                    <span class='help-inline'>{$this->passwordErr}</span>
                                </div>
                            </div>
                            <div class='control-group'>
                                <label class='control-label". ((empty($this->emailErr))?'':' error') ."'>Email</label>
                                <div class='controls'>
                                    <input id='email' type='text' placeholder='name@svsu.edu' required>
                                    <span class='help-inline'>{$this->emailErr}</span>
                                </div>
                            </div>
                            <div class='control-group'>
                                <label class='control-label". ((empty($this->mobileErr))?'':' error') ."'>Phone</label>
                                <div class='controls'>
                                    <input id='phone' type='text' placeholder='555-555-5555' required>
                                    <span class='help-inline'>{$this->mobileErr}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->addressErr))?'':' error') ."'>Address</label>
                                <div class='controls'>
                                    <input id='address' type='text' placeholder='' required>
                                    <span class='help-inline'>{$this->addressErr}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->cityErr))?'':' error') ."'>City</label>
                                <div class='controls'>
                                    <input id='city' type='text' placeholder='Saginaw' required>
                                    <span class='help-inline'>{$this->cityErr}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->stateErr))?'':' error') ."'>State</label>
                                <div class='controls'>
                                    <input id='state' type='text' placeholder='Michigan' required>
                                    <span class='help-inline'>{$this->stateErr}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->zipErr))?'':' error') ."'>Zip</label>
                                <div class='controls'>
                                    <input id='zip' type='text' placeholder='48822' required>
                                    <span class='help-inline'>{$this->zipErr}</span>
                                </div>
                            </div>
                            <div class='form-actions'>
                                <button class='btn btn-success' onclick='personsRequest(\"createRecord\")'>Create</button>
                                <a class='btn' onclick='personsRequest(\"displayList\")'>Back</a>
                            </div>
                        </div>
                    </div>
                </div>";
        }
        
        // Adds a record to the database.
        public function createRecord() {
            if ($this->validate()) {
                Database::prepare(
                    "INSERT INTO tt_persons (fname, lname, password_hash, email, phone, address, city, state, zip) VALUES (?,?,?,?,?,?,?,?,?)",
                    array($this->fname, $this->lname, $this->password, $this->email, $this->phone, $this->address, $this->city, $this->state, $this->zip)
                );
                $this->displayListScreen();
            } else {
                $this->displayCreateScreen();
            }
        }
        
        // Display a form containing information about a specified record in the database.
        public function displayReadScreen() {
            $rec = Database::prepare(
                "SELECT * FROM tt_persons WHERE id = ?", 
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
                                <label class='control-label'>First Name:&nbsp;</label>
                                        {$rec['fname']}
                            </div>
							<div class='control-group'>
                                <label class='control-label'>Last Name:&nbsp;</label>
                                        {$rec['lname']}
                            </div>
                            <div class='control-group'>
                                <label class='control-label'>Email:&nbsp;</label>
                                        {$rec['email']}
                            </div>
                            <div class='control-group'>
                                <label class='control-label'>Phone:&nbsp;</label>
                                        {$rec['phone']}
                            </div>
							<div class='control-group'>
								<label class='control-label'>Phone:&nbsp;</label>
                                        {$rec['address']}
                            </div>
							<div class='control-group'>
                                <label class='control-label'>City:&nbsp;</label>
                                        {$rec['city']}
                            </div>
							<div class='control-group'>
                                <label class='control-label'>State:&nbsp;</label>
                                        {$rec['state']}
                            </div>
							<div class='control-group'>
                                <label class='control-label'>Zip:&nbsp;</label>
                                        {$rec['zip']}
                            </div>
                            <div class='form-actions'>
                                <a class='btn' onclick='personsRequest(\"displayList\")'>Back</a>
                            </div>
                        </div>
                    </div>
                </div>";
        }
        
        // Display a form for updating a record within the database.
        public function displayUpdateScreen() {
            $rec = Database::prepare(
                "SELECT * FROM tt_persons WHERE id = ?", 
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
                                <label class='control-label". ((empty($this->fnameErr))?'':' error') ."'>First Name</label>
                                <div class='controls'>
                                    <input id='fname' type='text' value='{$rec['fname']}' required>
                                    <span class='help-inline'>{$this->fnameErr}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->lnameErr))?'':' error') ."'>Last Name</label>
                                <div class='controls'>
                                    <input id='lname' type='text' value='{$rec['lname']}' required>
                                    <span class='help-inline'>{$this->lnameErr}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->passwordErr))?'':' error') ."'>Password</label>
                                <div class='controls'>
                                    <input id='password' type='password' value='{$rec['password']}' required>
                                    <span class='help-inline'>{$this->passwordErr}</span>
                                </div>
                            </div>
                            <div class='control-group'>
                                <label class='control-label". ((empty($this->emailErr))?'':' error') ."'>Email</label>
                                <div class='controls'>
                                    <input id='email' type='text' placeholder='name@svsu.edu' value='{$rec['email']}' required>
                                    <span class='help-inline'>{$this->emailErr}</span>
                                </div>
                            </div>
                            <div class='control-group'>
                                <label class='control-label". ((empty($this->mobileErr))?'':' error') ."'>Phone</label>
                                <div class='controls'>
                                    <input id='phone' type='text' placeholder='555-555-5555' value='{$rec['phone']}' required>
                                    <span class='help-inline'>{$this->mobileErr}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->addressErr))?'':' error') ."'>Address</label>
                                <div class='controls'>
                                    <input id='address' type='text' placeholder='' value='{$rec['address']}' required>
                                    <span class='help-inline'>{$this->addressErr}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->cityErr))?'':' error') ."'>City</label>
                                <div class='controls'>
                                    <input id='city' type='text' placeholder='Saginaw' value='{$rec['city']}' required>
                                    <span class='help-inline'>{$this->cityErr}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->stateErr))?'':' error') ."'>State</label>
                                <div class='controls'>
                                    <input id='state' type='text' placeholder='Michigan' value='{$rec['state']}' required>
                                    <span class='help-inline'>{$this->stateErr}</span>
                                </div>
                            </div>
							<div class='control-group'>
                                <label class='control-label". ((empty($this->zipErr))?'':' error') ."'>Zip</label>
                                <div class='controls'>
                                    <input id='zip' type='text' placeholder='48822' value='{$rec['zip']}' required>
                                    <span class='help-inline'>{$this->zipErr}</span>
                                </div>
                            </div>
                            <div class='form-actions'>
                                <button class='btn btn-success' onclick='personsRequest(\"updateRecord\", {$this->id})'>Update</button>
                                <a class='btn' onclick='personsRequest(\"displayList\")'>Back</a>
                            </div>
                        </div>
                    </div>
                </div>";
        }
        
        // Updates a record within the database.
        public function updateRecord() {
            if ($this->validate()) {
                Database::prepare(
                    "UPDATE tt_persons SET fname = ?, lname = ?, password_hash = ?, email = ?, phone = ?, address = ?, city = ?, state = ?, zip = ? WHERE id = ?",
                    array($this->fname, $this->lname, $this->password, $this->email, $this->phone, $this->address, $this->city, $this->state, $this->zip , $this->id)
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
                            <h3>Delete Person</h3>
                        </div>
                        <div class='form-horizontal'>
                            <p class='alert alert-error'>Are you sure you want to delete ?</p>
                            <div class='form-actions'>
                                <button id='submit' class='btn btn-danger' onClick='personsRequest(\"deleteRecord\", {$this->id});'>Yes</button>
                                <a class='btn' onclick='personsRequest(\"displayList\")'>Back</a>
                            </div>
                        </div>
                    </div>
                </div>";
        }
        
        // Removes a record from the database.
        public function deleteRecord() {
            Database::prepare(
                "DELETE FROM tt_persons WHERE id = ?",
                array($this->id)
            );
            $this->displayListScreen();
        }
        
        // Validates user input.
        private function validate() {
            $valid = true;
            // Validate Mobile
            if (!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $this->phone)) {
                $this->phoneErr = "Please enter a valid phone number.";
                $valid = false;
            }
            // Validate Email
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $this->emailErr = "Please enter a valid email address.";
                $valid = false;
            }
            // Check for empty input.
            if (empty($this->fname)) { 
                $this->fnameErr = "Please enter a first name.";
                $valid = false; 
            }
			if (empty($this->password)) { 
                $this->passwordErr = "Please enter a password.";
                $valid = false; 
            }
			if (empty($this->address)) { 
                $this->addressErr = "Please enter a address.";
                $valid = false; 
            }
			if (empty($this->city)) { 
                $this->cityErr = "Please enter a city.";
                $valid = false; 
            }
			if (empty($this->state)) { 
                $this->stateErr = "Please enter a state.";
                $valid = false; 
            }
			if (empty($this->zip)) { 
                $this->zipErr = "Please enter a zip.";
                $valid = false; 
            }
			if (empty($this->lname)) { 
                $this->lnameErr = "Please enter a last name.";
                $valid = false; 
            }
            if (empty($this->email)) { 
                $this->emailErr = "Please enter an email.";
                $valid = false; 
            }
            print_r($valid);
            return $valid;
        }
    }
?>
