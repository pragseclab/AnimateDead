<?php
class Template
{
    protected $name = null;
     public static function get($name)
    {
        return new Template($name);
    }
     public function render(array $data = array())
    {
    	return $data;
    }
}
Template::get('prefs_twofactor_configure')->render([
            'form' => $two_factor->setup(),
            'configure' => $_POST['2fa_configure'],
        ]);

//prefs_twofactor.php -> Checks for static function calls
//NOTE : Skipped Twig in this testcase
?>


