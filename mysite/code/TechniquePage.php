<?php
class TechniquePage extends Page{
  private static $can_be_root = false;
  private static $db = array (
        'Purpose' =>'HTMLText',
        'FirstPattern' => 'Text',
        'VideoID' => 'Varchar(11)'
        );
    private static $has_one = array (
        'TechniquePhoto' => 'Image',
        'CrossPositionPhoto'=>'Image',
        'CrossPage'=>'CrossPage'
    );
    private static $many_many = array (
        'CrossPhotos' => 'Image',
        'Categories' => 'TechniqueCategory'
    );
    public function getCMSFields(){
        $fields=parent::getCMSFields();
        $fields->addFieldToTab('Root.Media', $technique = UploadField::create('TechniquePhoto'));
        $fields->addFieldToTab('Root.Media', $crossPosition = UploadField::create('CrossPositionPhoto'));
        $fields->addFieldToTab('Root.Media', $crossPhotos = UploadField::create('CrossPhotos'));
        $fields->addFieldToTab('Root.Media', new YouTubeField('VideoID', 'YouTube Video'));
        $fields->addFieldToTab('Root.Main',TextField::create('FirstPattern'),'Content');
        $fields->addFieldToTab('Root.Main',DropdownField::create(
            'CrossPageID',
            'CrossPage',
            CrossPage::get()->map('ID','Title')
        )->setEmptyString('-- No Cross --'),'Content');
        $fields->addFieldToTab('Root.Main',HtmlEditorField::create('Purpose'),'Content');
        $fields->addFieldToTab('Root.Categories', CheckboxSetField::create(
            'Categories',
            'Selected categories',
            $this->Parent()->Categories()->map('ID','Title')
        ));
        $technique->getValidator()->setAllowedExtensions(array('png','jpg','jpeg','gif'));
        $technique->setFolderName('technique-photos');
        $crossPosition->getValidator()->setAllowedExtensions(array('png','jpg','jpeg','gif'));
        $crossPosition->setFolderName('technique-photos');
        $crossPhotos->getValidator()->setAllowedExtensions(array('png','jpg','jpeg','gif'));
        $crossPhotos->setFolderName('technique-photos');
        return $fields;
    }
}
class CrossPage_Controller extends Page_Controller{
}
