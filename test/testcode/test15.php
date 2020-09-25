<?php
class CentralColumns
{
    private $dbi;
    public $user;         //Kept it public to make it accessible 

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
//Returns an output
//db_central_columns.php
?>