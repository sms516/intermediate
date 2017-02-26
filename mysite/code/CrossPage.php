<?php
class CrossPage extends Page{
  private static $can_be_root = false;
  private static $db = array (
        'Summary' =>'Text'
        );
    private static $has_one = array (
        'PrimaryPhoto' => 'Image'
    );
    private static $has_many = array (
       'Techniques' => 'TechniquePage'
    );
    public function getCMSFields(){
        $fields=parent::getCMSFields();
        $fields->addFieldToTab('Root.Photos', $photo = UploadField::create('PrimaryPhoto'));
        $fields->addFieldToTab('Root.Main',TextareaField::create('Summary'),'Content');
        $photo->getValidator()->setAllowedExtensions(array('png','jpg','jpeg','gif'));
        $photo->setFolderName('cross-photos');
        return $fields;
    }
}
class TechniquePage_Controller extends Page_Controller{

}
