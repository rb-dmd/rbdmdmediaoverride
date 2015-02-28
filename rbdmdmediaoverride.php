<?php


class plgSystemRBDMDMediaOverride extends JPlugin {
      public function __construct(&$subject, $config = array()) {
         parent::__construct($subject, $config);
     }

     public function onAfterRoute() {
         $app = JFactory::getApplication();
         if('com_media' == JRequest::getCMD('option') && $app->isAdmin()) {
             require_once(dirname(__FILE__) . '/code/com_media/views/imageslist/view.html.php');
         }
     } 
}
