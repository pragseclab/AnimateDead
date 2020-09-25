<?php
class CentralColumns
{
    private $dbi;
    private $user;         

    public function __construct(DatabaseInterface $dbi) //Constructor
    {
        $this->dbi = $dbi;

        $this->user = $GLOBALS['cfg']['Server']['user'];

        $this->relation = new Relation();
    }
}
$centralColumns = new CentralColumns($GLOBALS['dbi']);
echo $centralColumns->user;  
//Testcase to Object creation and constructor calls.
//Throws an error as user is a private variable. Hence inaccessible.
//db_central_columns.php
?>