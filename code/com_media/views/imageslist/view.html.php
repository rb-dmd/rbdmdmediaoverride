<?php

defined('_JEXEC') or die;

/**
 * HTML View class for the Media component
 *
 * @package     Joomla.Administrator
 * @subpackage  com_media
 * @since 1.0
 */
class MediaViewImagesList extends JViewLegacy
{
    function display($tpl = null)
    {
        // Do not allow cache
        JResponse::allowCache(false);

        $app = JFactory::getApplication();

        $lang   = JFactory::getLanguage();

        JHtml::_('stylesheet', 'media/popup-imagelist.css', array(), true);
        if ($lang->isRTL()) :
            JHtml::_('stylesheet', 'media/popup-imagelist_rtl.css', array(), true);
        endif;

        $document = JFactory::getDocument();
        $document->addScriptDeclaration("var ImageManager = window.parent.ImageManager;");

        $list = $this->get('list');
        $images = array();
        foreach($list['docs'] as $d) {
            $d->thumb = JURI::root() . 'media/media/images' . substr($d->icon_32, strpos($d->icon_32, '/'));
            $d->width_60 = 32;
            $d->height_60 = 32;
            $images[] = $d;
        }
        foreach($list['images'] as $i) {
            $i->thumb = COM_MEDIA_BASEURL . '/' . $i->path_relative;
            $images[] = $i;
        }
        $folders = $this->get('folders');
        $state = $this->get('state');

        $this->baseURL = COM_MEDIA_BASEURL;
        $this->assignRef('images', $images);
        $this->assignRef('folders', $folders);
        $this->assignRef('state', $state);
        array_unshift($this->_path['template'], dirname(__FILE__) . '/tmpl');
        parent::display($tpl);
    }


    function setFolder($index = 0)
    {
        if (isset($this->folders[$index])) {
            $this->_tmp_folder = &$this->folders[$index];
        } else {
            $this->_tmp_folder = new JObject;
        }
    }

    function setImage($index = 0)
    {
        if (isset($this->images[$index])) {
            $this->_tmp_img = &$this->images[$index];
        } else {
            $this->_tmp_img = new JObject;
        }
    }
}
