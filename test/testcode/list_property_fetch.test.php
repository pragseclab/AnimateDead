<?php

class test {

    public function test() {
        @list( $this->first, $this->second  ) = func_get_args();
        echo $this->first;
        echo $this->second;
    }
}


$obj = new test("this is a list - first property fetch\n", "this is a list - second property fetch\n");
?>
