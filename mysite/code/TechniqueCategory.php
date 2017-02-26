<?php

class TechniqueCategory extends DataObject {

    private static $db = array (
        'Title' => 'Varchar',
    );

    private static $has_one = array (
        'TechniqueHolder' => 'TechniqueHolder'
    );

    private static $belongs_many_many = array (
       'Techniques' => 'TechniquePage'
   );

    public function getCMSFields() {
        return FieldList::create(
            TextField::create('Title')
        );
    }
    public function Link(){
        return $this->TechniqueHolder()->Link('category/'.$this->ID);
    }
}
