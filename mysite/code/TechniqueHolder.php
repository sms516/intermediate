<?php
class TechniqueHolder extends Page{
    private static $allowed_children = array('TechniquePage');
    private static $has_many = array (
           'Categories' => 'TechniqueCategory'
       );
    public function getCMSFields() {
      $fields = parent::getCMSFields();
      $fields->addFieldToTab('Root.Categories', GridField::create(
          'Categories',
          'Technique categories',
          $this->Categories(),
          GridFieldConfig_RecordEditor::create()
      ));

      return $fields;
    }
}
class TechniqueHolder_Controller extends Page_Controller{
    private static $allowed_actions=array(
            'category'
        );
    protected $techniqueList;
    public function init(){
        parent::init();
        $this->techniqueList=TechniquePage::get()->filter(array(
            'ParentID' => $this->ID));

    }
    public function category(SS_HTTPRequest $r)
    {
        $category=TechniqueCategory::get()->byID(
            $r->param('ID')
        );
        if(!$category){
            return $this->httpError(404,'That category was not found');
        }

        $this->techniqueList = $this->techniqueList->filter(array('Categories.ID'=>$category->ID));
        return array('SelectedCategory'=>$category);
    }
    public function paginatedTechniques($num=8){
        return PaginatedList::create(
            $this->techniqueList,
            $this->getRequest()
            )->setPageLength($num);
    }
}
