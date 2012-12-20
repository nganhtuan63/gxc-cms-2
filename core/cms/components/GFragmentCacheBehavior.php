<?php

/**
 * The behavior extends any of the CCache subclasses with begin() and end() methods,
 * allowing for quick, simple caching in widgets, views or actions.
 *
 * You are responsible for introducing variability, e.g. appending variables to the
 * cache $id for uniqueness.
 *
 * Example configuration:
 *
 * <code>
 *   'components'=>array(
 *     ...
 *     'widgetCache'=>array(
 *       'class'=>'CDummyCache',
 *       'behaviors'=>array('output'=>'GFragmentCacheBehavior'),
 *       'cachePath'=>APP_PATH.DIRECTORY_SEPARATOR.'runtime'.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR.'widgets',
 *     ),
 *   ),
 * </code>
 * 
 * Example Widget using the widgetCache configured in the example above:
 *
 * <code>
 *   class Menu extends CWidget
 *   {
 *     public $active=null;
 *     
 *     public function run()
 *     {
 *       if (Yii::app()->widgetCache->begin(__CLASS__.'.'.$this->active))
 *       {
 *         $this->render('menu', array(
 *           ...
 *         ));
 *         Yii::app()->widgetCache->end();
 *       }
 *     }
 *   }
 * <code>
 *
 */
class GFragmentCacheBehavior extends CBehavior
{
  /**
   * @var array Default properties for the output cache widget.
   */
  public $properties=array(
  );
  
  /**
   * @var int default expiration time (in seconds) - defaults to 3600 seconds (1 hour)
   * @see COutputCache::$duration
   */
  public $duration=3600;
  
  /**
   * Begins fragment caching.
   * This method will display cached content if it is availabe.
   * If not, it will start caching and would expect a {@link endCache()}
   * call to end the cache and save the content into cache.
   *
   * A typical usage of fragment caching is as follows,
   *
   * <pre>
   *   if(Yii::app()->myCache->begin($id))
   *   {
   *     // ...generate content here
   *     Yii::app()->myCache->end();
   *   }
   * </pre>
   * 
   * @param string a unique ID identifying the fragment to be cached.
   * @param array initial property values for {@link COutputCache}.
   * @return boolean whether we need to generate content for caching. False if cached version is available.
   * @see end()
   */
  public function begin($id, $duration=null, $properties=array())
  {
    $properties = $this->properties;
    
    $properties['id'] = $id;
    $properties['cache'] = $this->getOwner();
    
    $properties['duration'] = $duration===null ? $this->duration : $duration;
    
    $cache = Yii::app()->getController()->beginWidget('GOutputCache', $properties);
    
    if($cache->getIsContentCached())
    {
      $this->end();
      return false;
    }
    else
      return true;
  }

  /**
   * Ends fragment caching.
   * @see begin()
   */
  public function end()
  {
    Yii::app()->getController()->endWidget('GOutputCache');
  }
}

class GOutputCache extends COutputCache
{
  /**
   * @var CCache overrides the $cacheID with a custom CCache component reference
   */
  public $cache;
  
  /**
   * @return ICache the cache used for caching the content.
   */
  protected function getCache()
  {
    return isset($this->cache) ? $this->cache : Yii::app()->getComponent($this->cacheID);
  }
}