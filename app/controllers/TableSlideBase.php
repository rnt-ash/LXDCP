<?php
/**
* @copyright Copyright (c) ARONET GmbH (https://aronet.swiss)
* @license AGPL-3.0
*
* This code is free software: you can redistribute it and/or modify
* it under the terms of the GNU Affero General Public License, version 3,
* as published by the Free Software Foundation.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU Affero General Public License for more details.
*
* You should have received a copy of the GNU Affero General Public License, version 3,
* along with this program.  If not, see <http://www.gnu.org/licenses/>
*
*/

use Phalcon\Mvc\Controller;
use Phalcon\Paginator\Adapter\NativeArray as PaginatorArray;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

/**
* Basis Klasse für das TableData und SlideData Element
*/

class TableSlideBase extends ControllerBase
{
    protected $tableDataInfo; // Array mit Informationen zur Table-Anzeige
    protected $slideDataInfo; // Array mit Informationen zur Slide-Anzeige
    
    /**
    * helper method. get the modelname to this controller
    * 
    */
    protected function getModelName(){
        return substr(get_class($this),0,strpos(get_class($this),"Controller"));
    }
    
    /**
    * helper method. get the formname to this controller
    * 
    */
    protected function getFormName() {
        return $this->getModelName()."Form";
    }
    
    /**
    * helper action. forward to slideDataAction
    * 
    */
    public function indexAction(){
        $this->forwardToTableSlideDataAction();
    }
    
    /**
    * helper method. Redirect to tabledata Action
    * 
    */
    protected function redirecToTableSlideDataAction(){
        if($this->session->get('TableSlideDataAction')=='slidedata')
            $this->redirectTo($this->dispatcher->getControllerName().'/slidedata');
        else 
            $this->redirectTo($this->dispatcher->getControllerName().'/tabledata');
    }
    
    /**
    * helper method. Forward to tabledata Action
    * 
    */
    protected function forwardToTableSlideDataAction(){
        if($this->session->get('TableSlideDataAction')=='slidedata'){
            return $this->dispatcher->forward([
                'action' => 'slidedata'
            ]);
        }else{
            return $this->dispatcher->forward([
                'action' => 'tabledata'
            ]);
        }
    }

    /**
    * helper method. Forward to tableData Action
    * 
    */
    protected function forwardToEditAction($form){
        return $this->dispatcher->forward([
            'action' => 'edit',
            'params' => [$form],
        ]);
    }
    
    /**
    * Hilfsfunktion zum Sortieren von Arrays
    * 
    */
    private function sortArrayByFields($arr, $fields){
        $sortFields = array();
        $args       = array();

        foreach ($arr as $key => $row) {
            foreach ($fields as $field => $order) {
                $sortFields[$field][$key] = $row[$field];
            }
        }

        foreach ($fields as $field => $order) {
            $args[] = $sortFields[$field];

            if (is_array($order)) {
                foreach ($order as $pt) {
                    $args[$pt];
                }
            } else {
                $args[] = $order;
            }
        }

        $args[] = &$arr;
        call_user_func_array('array_multisort', $args);
        return $arr;
    }

    /**
    * stellt die TableData Ansicht dar
    * 
    */
    public function tabledataAction(){

        // save TableSlideDataAction for further redirects
        $this->session->set('TableSlideDataAction', 'tabledata');
        
        // TableData Info abholen
        $this->tableDataInfo = $this->persistent->tableDataInfo;
        if(!is_array($this->tableDataInfo)) $this->tableDataInfo = $this->getTableDataInfo();
        
        // Spalten Positionen sortieren
        $this->tableDataInfo['columns'] = $this->sortArrayByFields($this->tableDataInfo['columns'],array('pos'=>SORT_ASC));

        // Page Parameter abholen     
        $this->getPageParam($this->tableDataInfo);
           
        // Datensätze abholen
        $items = $this->getModelName()::find($this->tableDataInfo['scope']);
        $count = $items->count();
        if ($count <= 0) {
            $this->flash->notice("No Items found!");
            // go not return and work with empty resultset..
        }

        // Items Filtern
        $items = $this->filterTableItems($items);
        
        // Alle Resultate in Array umwandeln
        $itemsArray = array();
        foreach($items as $item){
            $aItem['id'] = $item->id;
            foreach($this->tableDataInfo['columns'] as $key => $column){
                if(!$column['show']) continue;
                $aItem[$key] = $item->printTableData($key);
            }
            $itemsArray[$item->id] = $aItem;
        }

        // array sortieren
        if (count($itemsArray) > 0) 
            $orderDir = ($this->tableDataInfo['orderdir']=="asc"?SORT_ASC:SORT_DESC);
            $itemsArray = $this->sortArrayByFields($itemsArray,array($this->tableDataInfo['order']=>$orderDir));
            
        // Default für Form Elemente setzen
        foreach($this->tableDataInfo['filters'] as $key => $filter)
            $this->tag->setDefault($key, $filter);
        
        // Paginator
        $this->paginate($itemsArray,$this->tableDataInfo);
        
        // dataInfo persistieren
        $this->persistent->tableDataInfo = $this->tableDataInfo;
    }
    
    /**
    * stellt die SlideData Ansicht dar
    * 
    */
    public function slidedataAction(){
        $content = "";

        // save TableSlideDataAction for further redirects
        $this->session->set('TableSlideDataAction', 'slidedata');
        
        // SlideData Info abholen
        $this->slideDataInfo = $this->persistent->slideDataInfo;
        if(!is_array($this->slideDataInfo)) $this->slideDataInfo = $this->getSlideDataInfo();

        // Page Parameter abholen     
        $this->getPageParam($this->slideDataInfo);
        
        // Datensätze abholen
        $params = array();
        $params['conditions'] = $this->slideDataInfo['scope'];
        $params['order'] = $this->slideDataInfo['order']." ".$this->slideDataInfo['orderdir'];
        $items = $this->getModelName()::find($params);        
        $count = $items->count();        
        if ($count <= 0) {
            $this->flash->notice("No Items found!");
            // go not return and work with empty resultset..
        }
        
        // Items zum benutzerdefinierten Filtern übergeben
        $items = $this->filterSlideItems($items,0);

        // Items zum benutzerdefierten Sortieren übergeben
        $items = $this->sortSlideItems($items,0);

        // Paginator
        $this->paginate($items,$this->slideDataInfo);

        // Default für Form Elemente setzen
        foreach($this->slideDataInfo['filters'] as $key => $filter)
            $this->tag->setDefault($key, $filter);
        
        // Einzelene Slides rendern
        $i = 0;
        foreach($this->view->page->items as $item){
            $content .= $this->renderSlide($item->id,0);
            $i++;
        }
        $this->view->slides = $content;        
        
        // slideDataInfo persistieren
        $this->persistent->slideDataInfo = $this->slideDataInfo;
    }

    protected function getPageParam(&$dataInfo){
        if ($this->request->isGet()) {
            // Seite
            if($this->request->has('page'))
                $dataInfo['page'] = $this->request->get("page", "int");
            // Limit
            if($this->request->has('limit')){
                $oldlimit = $dataInfo['limit'];
                $dataInfo['limit'] = $this->request->get("limit", "int");
                if($oldlimit != $dataInfo['limit']) $dataInfo['page'] = 1;
            }
            // Sortierung
            if($this->request->has('order')){
                $dataInfo['order'] = $this->request->get("order","string");
            }
            // Sortierrichtung
            if($this->request->has('orderdir')){
                $dataInfo['orderdir'] = ($this->request->get("orderdir","string")=='desc'?'desc':'asc');
            }
        }
    }
    
    protected function paginate($items,$dataInfo){
        // Paginator
        $this->view->dataInfo = $dataInfo;
        $params = array(
            'data' => $items,
            'limit'=> $dataInfo['limit'],
            'page' => $dataInfo['page'],
        );
        if(is_array($items))
            $paginator = new PaginatorArray($params);
        else
            $paginator = new PaginatorModel($params);

        $this->view->page = $paginator->getPaginate();

        // Default für Form Element
        $this->tag->setDefault("limit", $dataInfo['limit']);
        
        // From-To Anzeige berechnen
        $limit = $dataInfo['limit'];
        $this->view->page->from_items = $this->view->page->current*$limit-$limit+1;
        $this->view->page->to_items = $this->view->page->current*$limit;
        if($this->view->page->to_items > $this->view->page->total_items)
            $this->view->page->to_items = $this->view->page->total_items;
    }
    
    /**
    * rendert ein Slide inkl. Unterslides
    * wird rekursiv aufgerufen
    * 
    * @param mixed $id ID des zu rendernden Slides
    * @param mixed $level aktuelle Verschachtelungstiefe
    */
    final protected function renderSlide($id=0,$level=0){
        try{
            $levelids = explode('_',$id);
            $content = "";
            $slideInfo = $this->getRecursiveChildArray($level);
            $countLevel = count(explode('_',$id))-1;

            $params['scope'] = $this->slideDataInfo['scope'];
            $params['order'] = $slideInfo['order']." ".$slideInfo['orderdir'];
            
            // Conditions zusammensetzen
            if($countLevel == $level && (isset($slideInfo['childtable']) || $level <= $this->maxSlideChilds())) {
                $conditions = array('conditions' => "id='".$levelids[$level]."'");
            } else {
                $conditions = array('conditions' => $slideInfo['join']."='".$levelids[$level-1]."'");
            }
            
            // Items abholen
            $params = array_merge($params,$conditions);
            if($level > 0)
                $items = $slideInfo['classname']::find($params);
            else
                $items = $this->getModelName($level)::find($params);

            // Wenn keine Datensätze gefunden: zurück
            if($items->count() <= 0) return $content;

            // Items zum benutzerdefinierten Sortieren und Filtern übergeben
            $items = $this->sortSlideItems($items,1);
        
            // Einzelene Slides rendern
            foreach($items as $item){
                $aktid = $id;
                if($countLevel != $level) $aktid = $id."_".$item->id;

                // Session um Slide Identifier bei Erstdurchlauf erweitern
                if(!isset($this->slideDataInfo['slides'][$aktid])) 
                    $this->slideDataInfo['slides'][$aktid]['state'] = 'hide';        
                
                // Wenn Ansicht eingeschaltet, Detail bzw. Child rendern
                $state = $this->slideDataInfo['slides'][$aktid]['state'];
                if($state=='show'){
                    $slidedetail = $this->renderSlideDetail($item,$level);
                    if(isset($slideInfo['childtable'])){
                        $slidedetail .= $this->renderSlide($aktid,$level+1);
                    }
                    $this->simpleview->slidedetail = $slidedetail;
                } else {
                    $this->simpleview->slidedetail = $slidedetail;
                }
                
                $this->simpleview->slideid = $aktid;
                $this->simpleview->level = $level;
                $ajaxLink = "/".$this->slideDataInfo['controller']."/slideSlide/".$aktid;
                $this->simpleview->onclick = "$( '#slide_".$aktid."' ).load( '".$ajaxLink." #slide_".$aktid." > *' , function() { activateGadgets(); }); 
                    toggleIcon('#slide_detail_icon_".$aktid."'); ";
                $this->simpleview->state = $state;
                $this->simpleview->slideheader = $this->renderSlideHeader($item,$level);
                $content .= $this->simpleview->render("partials/slide_slide.volt");
            }

        }catch(\Exception $e){
            $content = "Generieren Slides fehlgeschlagen: ".$e->getMessage();
        }    
        return $content;
    }

    /**
    * Shows the form to create a new item
    */
    public function newAction()
    {
        $class = $this->getFormName();
        $this->forwardToEditAction(new $class);
    }
    
    /**
    * Edits a item
    * need an id of the item or a form-object
    *
    * @param mixed $item integer or Phalcon\Forms\Form
    */
    public function editAction($item)
    {
        if(is_a($item,$this->getFormName())){
            // Get item from form
            $this->view->form = $item;
        } else {
            // Get item from Database
            $item = $this->getModelName()::findFirstByid($item);
            if (!$item) {
                $this->flash->error("item was not found");
                return $this->forwardToTableSlideDataAction();
            }
            $class = $this->getFormName();
            $this->view->form = new $class($item);
        }
    }
    
    /**
    * Saves a item
    * 
    */
    public function saveAction()
    {
        // POST request?
        if (!$this->request->isPost()) 
            return $this->forwardToTableSlideDataAction();

        // Edit or new Record
        $id = $this->request->getPost("id", "int");
        if(empty($id)){
            $class = $this->getModelName();
            $item = new $class;
        }else{
            $item = $this->getModelName()::findFirstById($id);
            if (!$item) {
                $this->flashSession->error("Item does not exist");
                return $this->forwardToTableSlideDataAction();
            }
        }

        // validate FORM
        $class = $this->getFormName();
        $form = new $class;
        
        $data = $this->request->getPost();
        if (!$form->isValid($data, $item)) {
            return $this->forwardToEditAction($form);
        }

        // hook pre save
        if (!$this->preSave($item,$form))
            return $this->forwardToEditAction($form);
        
        // save data
        if ($item->save() === false) {
            // fetch all messages from model
            foreach ($item->getMessages() as $message) {
                $this->flashSession->error($message);
            }
            return $this->forwardToEditAction($form);
        }

        // hook post save
        if (!$this->postSave($item,$form))
            return $this->forwardToEditAction($form);
        
        // clean up
        $form->clear();
        $this->flashSession->success("Item was updated successfully");
        $this->redirecToTableSlideDataAction();
    }

    /**
    * Deletes an item
    *
    * @param string $id
    */
    public function deleteAction($id)
    {
        // find item
        $id = $this->filter->sanitize($id, "int");
        $item = $this->getModelName()::findFirstByid($id);
        if (!$item) {
            $this->flashSession->error("item was not found");
            return $this->forwardToTableSlideDataAction();
        }

        // hook pre delete
        if (!$this->preDelete($item))
            return $this->forwardToTableSlideDataAction();
        
        
        // try to delete
        if (!$item->delete()) {
            foreach ($item->getMessages() as $message) {
                $this->flashSession->error($message);
            }
            return $this->forwardToTableSlideDataAction();
        }

        // hook post delete
        if (!$this->postDelete($item))
            return $this->forwardToTableSlideDataAction();
        
        // sucess
        $this->flashSession->success("item was deleted successfully");
        return $this->forwardToTableSlideDataAction();
    }

    /**
    * Gibt die X-ten Verschachtelung des Tableinfo zurück
    * Hilfsfunktion zu renderSlide()
    * 
    * @param mixed $level 
    * @param mixed $array
    */
    final private function getRecursiveChildArray($level=0,$array=""){
        if(empty($array)) {
            $array= $this->slideDataInfo;
        }
        if($level>0){ 
            $level--;
            return $this->getRecursiveChildArray($level,$array['childtable']);
        }else{
            return $array;
        }
    }    
    
    public function slideSlideAction($divid){
        $content = "";
        
        // Slide Data Info abholen
        $this->slideDataInfo = $this->persistent->slideDataInfo;

        // Geht Slide auf oder zu?
        if($this->slideDataInfo['slides'][$divid]['state']=='show'){
            $this->slideDataInfo['slides'][$divid]['state'] = 'hide';
        }else{
            $this->slideDataInfo['slides'][$divid]['state'] = 'show';
        }
        
        // Slide rendern
        $content = $this->renderSlide($divid,count(explode('_',$divid))-1);
        
        // slideDataInfo persistieren
        $this->persistent->slideDataInfo = $this->slideDataInfo;
        
        return $content;
    }
    
    protected function maxSlideChilds(){
        // maximale mögliche Anzahl Verschachtelungen
        $maxSlideChilds = 0;
        $a = $this->slideDataInfo;
        while(isset($a['childtable'])){
            $a=$a['childtable'];
            $maxSlideChilds++;
        }
        return $maxSlideChilds;
    }
    
    // Prototypen
    protected function getdataInfo() { return array(); }
    protected function filterTableItems($items) { return $items; }
    protected function sortSlideItems($items,$level) { return $items; }
    protected function filterSlideItems($items,$level) { return $items; }
    protected function renderSlideHeader($item,$level){ return ""; }
    protected function renderSlideDetail($item,$level){ return ""; }
    protected function preSave($item,$form){ return true; }
    protected function postSave($item,$form){ return true; }
    protected function preDelete($item){ return true; }
    protected function postDelete($item){ return true; }
}
