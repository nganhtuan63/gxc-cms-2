<?php

/**
 * Class defined all the Constant value of the CMS.
 * 
 * 
 * @author Tuan Nguyen
 * @version 1.0
 * @package common.components
 */

class ConstantDefine{        

    const AJAX_BLOCK_SEPERATOR='---';    

    public static function fileTypes(){
        return array(
            'image'=>array('jpg','gif','png','bmp','jpeg'),
            'audio'=>array('mp3','wma','wav'),
            'video'=>array('flv','wmv','avi','mp4','mov','3gp'),
            'flash'=>array('swf'),
            'file'=>array('*'),           
            );
    }
    
    public static function chooseFileTypes(){
        return array(
            'auto'=>t('cms','Auto detect'),
            'image'=>t('cms','Image'),
            'video'=>t('cms','Video'),
            'audio'=>t('cms','Audio'),
            'file'=>t('cms','File'),
        );
    }
    
    
    
    /**
     * Constant related to User
     */
    const USER_ERROR_NOT_ACTIVE=3;    
    const USER_STATUS_DISABLED=0;
    const USER_STATUS_ACTIVE=1;
    
    
    
    public static function getUserStatus(){
        return array(
            self::USER_STATUS_DISABLED=>t("cms","Disabled"),
            self::USER_STATUS_ACTIVE=>t("cms","Active"));
    }
                                    
    
    
    /**
     * Constant related to Object
     * 
     */
    
    const OBJECT_STATUS_PUBLISHED=1;
    const OBJECT_STATUS_DRAFT=2;
    const OBJECT_STATUS_PENDING=3;
    const OBJECT_STATUS_HIDDEN=4;
    
    public static function getObjectStatus(){
        return array(
                 self::OBJECT_STATUS_PUBLISHED=>t("cms","Published"),
                 self::OBJECT_STATUS_DRAFT=>t("cms","Draft"),
                 self::OBJECT_STATUS_PENDING=>t("cms","Pending"),
                 self::OBJECT_STATUS_HIDDEN=>t("cms","Hidden")
                );
    }
        
    const OBJECT_ALLOW_COMMENT=1;
    const OBJECT_DISABLE_COMMENT=2;
    
    public static function getObjectCommentStatus(){
        return array(
                 self::OBJECT_ALLOW_COMMENT=>t("cms","Allow"),
                 self::OBJECT_DISABLE_COMMENT=>t("cms","Disable"),                 
                );
    }
   
    /**
     * Constant related to Transfer
     *         
     */
    const TRANS_ROLE=1;
    const TRANS_PERSON=2;
    const TRANS_STATUS=3;
    
    
     /**
     * Constant related to Menu
     *         
     */
    const MENU_TYPE_PAGE=1;
    const MENU_TYPE_TERM=2;
    const MENU_TYPE_CONTENT=5;
    const MENU_TYPE_URL=3;  
    const MENU_TYPE_STRING=4;
    const MENU_TYPE_HOME=6;
    
    public static function getMenuType(){
        return array(
                 self::MENU_TYPE_HOME=>t("cms","Link to Homepage"),
                 self::MENU_TYPE_URL=>t("cms","Link to URL"),                 
                 self::MENU_TYPE_PAGE=>t("cms","Link to Page"),
                 self::MENU_TYPE_CONTENT=>t("cms","Link to a Content Object"),
                 self::MENU_TYPE_TERM=>t("cms","Link to a Term Page"),                                 
                 self::MENU_TYPE_STRING=>t("cms","String"),
                );
    }
    
    
    /**
     * Constant related to Content List
     *         
     */
    const CONTENT_LIST_TYPE_MANUAL=1;
    const CONTENT_LIST_TYPE_AUTO=2;
   
    
    public static function getContentListType(){
        return array(
                 self::CONTENT_LIST_TYPE_MANUAL=>t("cms","Manual"),                 
                 self::CONTENT_LIST_TYPE_AUTO=>t("cms","Auto"),
                 
                );
    }
    
    const CONTENT_LIST_CRITERIA_NEWEST=1;
    const CONTENT_LIST_CRITERIA_MOST_VIEWED_ALLTIME=2;
   
    
    public static function getContentListCriteria(){
        return array(
                 self::CONTENT_LIST_CRITERIA_NEWEST=>t("cms","Newsest"),                 
                 self::CONTENT_LIST_CRITERIA_MOST_VIEWED_ALLTIME=>t("cms","Most viewed all time"),                 
                );
    }
    
    const CONTENT_LIST_RETURN_DATA_PROVIDER=1;
    const CONTENT_LIST_RETURN_ACTIVE_RECORD=2;
    
    public static function getContentListReturnType(){
        return array(
                 self::CONTENT_LIST_RETURN_DATA_PROVIDER=>t("cms","Data Provider"),                 
                 self::CONTENT_LIST_RETURN_ACTIVE_RECORD=>t("cms","Active Record"),                 
                );
    }
    
    /**
     * Constant related to Page
     *         
     */
    const PAGE_ACTIVE=1;
    const PAGE_DISABLE=2;
    
    public static function getPageStatus(){
        return array(
                 self::PAGE_ACTIVE=>t("cms","Active"),
                 self::PAGE_DISABLE=>t("cms","Disable"),                 
                );
    }

    /**
     * Constant related to Page
     *         
     */
    const PAGE_DISPLAY_WEB='web';
    const PAGE_DISPLAY_MOBILE='mobile';
    
    public static function getPageDisplayDevice(){
        return array(
            self::PAGE_DISPLAY_WEB=>t("cms","Web"),
            self::PAGE_DISPLAY_MOBILE=>t("cms","Mobile"),                 
        );
    }
    
    const PAGE_ALLOW_INDEX=1;
    const PAGE_NOT_ALLOW_INDEX=2;
    
    public static function getPageIndexStatus(){
        return array(
                 self::PAGE_ALLOW_INDEX=>t("cms","Allow index"),
                 self::PAGE_NOT_ALLOW_INDEX=>t("cms","Not allow Index"),                 
                );
    }
    
    const PAGE_ALLOW_FOLLOW=1;
    const PAGE_NOT_ALLOW_FOLLOW=2;
    
    public static function getPageFollowStatus(){
        return array(
                 self::PAGE_ALLOW_FOLLOW=>t("cms","Allow follow"),
                 self::PAGE_NOT_ALLOW_FOLLOW=>t("cms","Not allow follow"),                 
                );
    }
    
    
    const PAGE_BLOCK_ACTIVE=1;
    const PAGE_BLOCK_DISABLE=2;
    
    public static function getPageBlockStatus(){
        return array(
                 self::PAGE_BLOCK_ACTIVE=>t("cms","Active"),
                 self::PAGE_BLOCK_DISABLE=>t("cms","Disable"),                 
                );
    }


    public static function authTypes(){
        return array(
            CAuthItem::TYPE_OPERATION=>t('cms','Operation'),
            CAuthItem::TYPE_TASK=>t('cms','Task'),
            CAuthItem::TYPE_ROLE=>t('cms','Role'),          
        );
    }
    
    
    /**
     * Constant related to Avatar Size
     */    
    
    const AVATAR_SIZE_96=96;
    const AVATAR_SIZE_23=23;
          
    public static function getAvatarSizes(){
        return array(
            self::AVATAR_SIZE_23=>t("cms","23"),
            self::AVATAR_SIZE_96=>t("cms","96"));
    }

    /**
     * Constant term order 
     */    
    
    const TERM_ORDER_NORMAL=0;
    const TERM_ORDER_PRIMARY=1;

    public static function getTermOrder(){
        return array(
            self::TERM_ORDER_NORMAL=>t('cms','normal'),
            self::TERM_ORDER_PRIMARY=>t('cms',"primary")
        );

    }
    
    
    
    
}