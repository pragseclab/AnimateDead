<?php

class ParentClass {
    public $name = "";
    public function __construct($name) {
        $this->name = $name;
    }
}

class ChildClass extends ParentClass {
    public function __construct($name) {
        parent::__construct($name);
    }
}

$cc = new ChildClass($_POST['test']);
if ($cc->name === 'test') {
    echo 'Success'.PHP_EOL;
}
else {
    echo 'Fail'.PHP_EOL;
}