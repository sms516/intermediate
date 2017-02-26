<?php
class AjaxImage extends Page{

}
class AjaxImage_Controller extends Page_Controller{
    public function index(SS_HTTPRequest $request){

        if($search = $request->getVar('imgsrc')) {
        $image = DataObject::get_one("Image", "Title = '{$search}'");
        $data = array (
           'ModalImage' => $image
       );
        if($request->isAjax()) {
        return $this->customise($data)
                ->renderWith('AjaxImage');
       }

       }
       $this->redirect('techniques');
    }
}
