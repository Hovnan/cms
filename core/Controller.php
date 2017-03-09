<?php

class Controller {

    public function view($view, $data=[])
    {
       foreach($data as $key =>$value)
       {
           $$key = $value;
       }
        require_once ROOT.'/views/layouts/header.php';
        require_once ROOT.'/views/'.$view.'.php';
        require_once ROOT.'/views/layouts/footer.php';
    }
}