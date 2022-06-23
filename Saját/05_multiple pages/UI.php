<?php

class UI{
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function select(){
        echo <<<'HTML'
        <h2>Deatils of student:</h2>
        <form method="post" action={$_SERVER["PHP_SELF"]}?page=details>
        <select name ="select">
        HTML;
        
        foreach($this->db->getStudents() as $student) {
        echo "<option value=\"{$student->getNeptun()}\">{$student->getName()}</option>\n";
        }    
        echo<<<'HTML'
        </select>
        <input type="submit" value="Details" />
        </form>
        HTML;

    }

    public function details(){
        echo $this->db->getStudent($_POST['select']);
        echo <<< 'HTML'
        <p><a href={$_SERVER["PHP_SELF"]}>Back to the main page.</a></p>
        HTML;
    }
}
