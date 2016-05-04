<?php

namespace Orm\Proxies\__CG__\Orm\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Lock extends \Orm\Entity\Lock implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', '' . "\0" . 'Orm\\Entity\\Lock' . "\0" . 'websiteid', '' . "\0" . 'Orm\\Entity\\Lock' . "\0" . 'itemid', '' . "\0" . 'Orm\\Entity\\Lock' . "\0" . 'userid', '' . "\0" . 'Orm\\Entity\\Lock' . "\0" . 'runid', '' . "\0" . 'Orm\\Entity\\Lock' . "\0" . 'type', '' . "\0" . 'Orm\\Entity\\Lock' . "\0" . 'starttime', '' . "\0" . 'Orm\\Entity\\Lock' . "\0" . 'lastactivity');
        }

        return array('__isInitialized__', '' . "\0" . 'Orm\\Entity\\Lock' . "\0" . 'websiteid', '' . "\0" . 'Orm\\Entity\\Lock' . "\0" . 'itemid', '' . "\0" . 'Orm\\Entity\\Lock' . "\0" . 'userid', '' . "\0" . 'Orm\\Entity\\Lock' . "\0" . 'runid', '' . "\0" . 'Orm\\Entity\\Lock' . "\0" . 'type', '' . "\0" . 'Orm\\Entity\\Lock' . "\0" . 'starttime', '' . "\0" . 'Orm\\Entity\\Lock' . "\0" . 'lastactivity');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Lock $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function setWebsiteid($websiteid)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setWebsiteid', array($websiteid));

        return parent::setWebsiteid($websiteid);
    }

    /**
     * {@inheritDoc}
     */
    public function getWebsiteid()
    {
        if ($this->__isInitialized__ === false) {
            return  parent::getWebsiteid();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getWebsiteid', array());

        return parent::getWebsiteid();
    }

    /**
     * {@inheritDoc}
     */
    public function setUserid($userid)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUserid', array($userid));

        return parent::setUserid($userid);
    }

    /**
     * {@inheritDoc}
     */
    public function getUserid()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUserid', array());

        return parent::getUserid();
    }

    /**
     * {@inheritDoc}
     */
    public function setRunid($runid)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRunid', array($runid));

        return parent::setRunid($runid);
    }

    /**
     * {@inheritDoc}
     */
    public function getRunid()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRunid', array());

        return parent::getRunid();
    }

    /**
     * {@inheritDoc}
     */
    public function setItemid($itemid)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setItemid', array($itemid));

        return parent::setItemid($itemid);
    }

    /**
     * {@inheritDoc}
     */
    public function getItemid()
    {
        if ($this->__isInitialized__ === false) {
            return  parent::getItemid();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getItemid', array());

        return parent::getItemid();
    }

    /**
     * {@inheritDoc}
     */
    public function setType($type)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setType', array($type));

        return parent::setType($type);
    }

    /**
     * {@inheritDoc}
     */
    public function getType()
    {
        if ($this->__isInitialized__ === false) {
            return  parent::getType();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getType', array());

        return parent::getType();
    }

    /**
     * {@inheritDoc}
     */
    public function getStarttime()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStarttime', array());

        return parent::getStarttime();
    }

    /**
     * {@inheritDoc}
     */
    public function setStarttime($starttime)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setStarttime', array($starttime));

        return parent::setStarttime($starttime);
    }

    /**
     * {@inheritDoc}
     */
    public function getLastactivity()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLastactivity', array());

        return parent::getLastactivity();
    }

    /**
     * {@inheritDoc}
     */
    public function setLastactivity($lastactivity)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLastactivity', array($lastactivity));

        return parent::setLastactivity($lastactivity);
    }

    /**
     * {@inheritDoc}
     */
    public function toArray()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'toArray', array());

        return parent::toArray();
    }

    /**
     * {@inheritDoc}
     */
    public function toCmsData()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'toCmsData', array());

        return parent::toCmsData();
    }

}