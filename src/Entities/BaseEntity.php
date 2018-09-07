<?php
namespace Avido\PostNLCifClient\Entities;

/**
  @File: BaseEntity.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Base Entitiy
  @Dependencies:
 */

use ReflectionClass;

abstract class BaseEntity
{
    public function __construct($data=[])
    {
        if (is_array($data)) {
            $this->initFromArray($data);
        }
    }
    
    /**
     * Create Entitiy from array data
     *
     * @access public
     * @param type $data
     * @return $this
     */
    public function initFromArray($data=[])
    {
        //Instantiate the reflection object
        $oReflector = new ReflectionClass(get_class($this));

        // get all the properties from class A in to $properties array
        $properties = [];
        foreach ($oReflector->getProperties() as $property) {
            $properties[$property->getName()] = $property;
        }
        foreach ($data as $key => $val) {
            if (!isset($properties[$key]) || ($properties[$key]->isPublic() || $properties[$key]->isProtected())) {
                $this->{$key} = $val;
            }
        }
        return $this;
    }
    
    /**
     * Create a class instance static without calling the constructor.
     *
     * @access public static
     * @return $this
     */
    public static function create()
    {
        $reflection = new ReflectionClass(get_called_class());
        return $reflection->newInstanceWithoutConstructor();
    }
    
    /**
     * Output entitiy as array
     *
     * @access public
     * @return array
     */
    public function toArray()
    {
        //Instantiate the reflection object
        $oReflector = new ReflectionClass(get_class($this));
        
        // return placeholder
        $data = [];
        
        foreach ($oReflector->getProperties() as $property) {
            if ($property->isPublic() || $property->isProtected()) {
                $data[$property->getName()] = $this->{$property->getName()};
            }
        }
        
        return $data;
    }
}
