<?php
declare(strict_types=1);

class UI{
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function basicQuery(){
       echo $this->db;
    }

    public function userTextfields(){
    echo <<<'HTML'
        <h2>Adding student:</h2>
        <form method="post" action={$_SERVER["PHP_SELF"]}">
            <label for="name">Name: </label>
            <input type="textfield" name="name" id="name" />
            <br>
            <label for="neptun">Neptun: </label>
            <input type="textfield" name="neptun" id="neptun" />
            <br>
            <label for="birthdate">Date of birth: </label>
            <input type="date" name="birthdate" id="birthdate" />
            <p><input type="submit" value="Add" /></p>
        </form>
        HTML;
    }

    //other kind of copy paste (Mintavizsga - StudentList) didn't work out for some reason
    public function deleteSelect(){
        echo <<<'HTML'
        <h2>Deleting student:</h2>
        <form method="post" action={$_SERVER["PHP_SELF"]}">
        <select name ="deleteneptun">
        HTML;
        
        foreach($this->db->getStudents() as $student) {
        echo "<option value=\"{$student->getNeptun()}\">{$student->getName()}</option>\n";
        }    
        echo<<<'HTML'
        </select>
        <input type="submit" value="Delete" />
        </form>
        HTML;

    }

    //ugly copy paste
    public function update(){
        echo <<<'HTML'
        <h2>Updating:</h2>
        <form method="post" action={$_SERVER["PHP_SELF"]}">
        <select name ="update">
        HTML;
        
        foreach($this->db->getStudents() as $student) {
        echo "<option value=\"{$student->getNeptun()}\">{$student->getName()}</option>\n";
        }  

        echo<<<'HTML'
        </select>
        <br>
        <label for="name">Name: </label>
        <input type="textfield" name="updatename" id="name" />
        <br>
        <label for="neptun">Neptun: </label>
        <input type="textfield" name="updateneptun" id="neptun" />
        <br>
        <label for="birthdate">Date of birth: </label>
        <input type="date" name="updatebirthdate" id="birthdate" />
        <input type="submit" value="Update" />
        </form>
        HTML;
    }

    //!empty ~ something reasonable
    //isset is another option to check
    public function processInput(){
        if(!empty($_POST["name"])&& !empty($_POST["neptun"])&& !empty($_POST["birthdate"])){
            $name=$_POST["name"];
            $neptun = filter_input(INPUT_POST, "neptun", FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => '/^[a-z0-9]{6}$/i']]);
            $date= $_POST["birthdate"];
            $this->db->insertStudent($name, $neptun, $date);
        }
        if(!empty($_POST["deleteneptun"])){
           $this->db->deleteStudent($_POST["deleteneptun"]);
        }
        if(!empty($_POST["update"]) &&!empty($_POST["updatename"])&& !empty($_POST["updateneptun"]) && !empty($_POST["updatebirthdate"])){
            $this->db->updateStudent($_POST["update"], $_POST["updatename"], $_POST["updateneptun"], $_POST["updatebirthdate"]);
        }
    }
}
