<?php
class HomePage extends Page {

}

class HomePage_Controller extends Page_Controller {

    public function Techniques($count=5){
        return TechniquePage::get()
            ->sort('RAND()')
            ->limit($count);
    }
}
?>
