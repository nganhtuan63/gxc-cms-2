<?php

//Dashboard - Index page of the admin Module

class Index extends CAction {
 
    public function run() {
        $controller = $this->getController();
        $controller->render('cms.modules.admin.views.default.index');
           
    }
 
}