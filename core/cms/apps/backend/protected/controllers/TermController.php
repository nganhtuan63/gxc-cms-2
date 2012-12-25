<?php
/**
 * Backend Term Controller.
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package backend.controllers
 *
 */
class TermController extends BeController{
    
       
        public function __construct($id,$module=null)
	{
		 parent::__construct($id,$module);
                 $this->menu=array(
                        array('label'=>t('cms','Manage Terms'), 'url'=>array('admin'),'linkOptions'=>array('class'=>'button')),
                        array('label'=>t('cms','Add Term'), 'url'=>array('create'),'linkOptions'=>array('class'=>'button')),
                );
		 
	}
                 
        /**
	 * The function that do Create new Term
	 * 
	 */
	public function actionCreate()
	{                
                
		$this->render('term_create');
	}
        
        
       
        
        /**
	 * The function that do Manage Term
	 * 
	 */
	public function actionAdmin()
	{                
		$this->render('term_admin');
	}
        
        /**
	 * The function that view Term details
	 * 
	 */
	public function actionView()
	{         
              $id=isset($_GET['id']) ? (int) ($_GET['id']) : 0 ;
              $this->menu=array_merge($this->menu,                       
                        array(
                            array('label'=>t('cms','Update this Term'), 'url'=>array('update','id'=>$id),'linkOptions'=>array('class'=>'button')),
                            array('label'=>t('cms','View this Term'), 'url'=>array('view','id'=>$id),'linkOptions'=>array('class'=>'button'))
                        )
                    );
		$this->render('term_view');
	}
        
        /**
	 * The function that update Term
	 * 
	 */
	public function actionUpdate()
	{                
                $id=isset($_GET['id']) ? (int) ($_GET['id']) : 0 ;                
                $this->menu=array_merge($this->menu,                       
                        array(
                            array('label'=>t('cms','Update this Term'), 'url'=>array('update','id'=>$id),'linkOptions'=>array('class'=>'button')),
                            array('label'=>t('cms','View this Term'), 'url'=>array('view','id'=>$id),'linkOptions'=>array('class'=>'button'))
                        )
                    );
		$this->render('term_update',array());
	}
        
        
        /**
	 * The function is to Delete Term
	 * 
	 */
	public function actionDelete($id)
	{                              
             Term::ajaxDeleteModel($id);
	}
        
         /**
	 * The function is to Delete Term
	 * 
	 */
	public function actionChangeOrder()
	{                                     
             Term::ajaxChangeOrder();
	}
        
        /**
         * 
         * This function is generate Terms based on Taxonomy Id
         */
        public function actionDynamicParentTerms(){
            $taxonomy_id= (int) ($_POST['Term']['taxonomy_id']);
            Term::getTermFromTaxonomy($taxonomy_id);
        }
                    
}