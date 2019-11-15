<?php
namespace Avido\PostNLCifClient;

/**
    @File: BaseModel.php
    @version 0.1.0
    @Encoding:  UTF-8
    @Package: PostNL Cif Rest API PHP Client
    @copyright   Avido
*/

use ReflectionClass;

class BaseModel
{
    private $data = [];

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

    public function initFromArray(array $data = [])
    {
        //Instantiate the reflection object
        $oReflector = new \ReflectionClass(get_class($this));

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

    public function __construct()
    {
        $args = func_get_args();
        if (empty($args[0])) {
            $args[0] = [];
        }
        $this->setData($args[0]);
    }

    /**
     * Set/Get attribute wrapper
     *
     * @param   string $method
     * @param   array $args
     * @return  mixed
     */
    public function __call(string $method, array $args = [])
    {
        switch (substr($method, 0, 3)) {
            case 'get':
                $key = $this->underScore(substr($method, 3));
                return $this->getData($key, isset($args[0]) ? $args[0] : null);
            case 'set':
                $key = $this->underScore(substr($method, 3));
                return $this->setData($key, isset($args[0]) ? $args[0] : null);
            case 'has':
                $key = $this->underScore(strtolower(substr($method, 3)));
                return isset($this->data[$key]);
        }
    }
    /**
     * Get data from attribute, child entity or nested entity
     *
     * @param string $key
     * @return mixed
     */
    public function getData(string $key)
    {
        $data = $this->data;
        return isset($data[$key]) ? $data[$key] : null;
    }
    /**
     * Set object data
     *
     * @access public
     * @param mided string|array $key
     * @param mixed $value
     * @return $this
     */
    public function setData($key, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $dataKey => $dataValue) {
                $this->setData($dataKey, $dataValue);
            }
        } else {
            $key = lcfirst($this->underScore($key));
            $this->data[$key] = $value;
        }
        return $this;
    }

    /**
     * Convert object attributes to array
     *
     * @return array
     */
    public function __toArray(): array
    {
        return $this->data;
    }

    /**
     * Public wrapper for __toArray
     *
     * @return array
     */
    public function toArray(): array
    {
        $tmp = $this->__toArray();
        return $tmp;
    }

    /**
     * Camelcase string:
     * Example:
     *      Input: this_is_string
     *      Output: thisIsString
     * @param string $str
     * @return string
     */
    public static function camelCase(string $str): string
    {
        $str = strtolower($str);
        $str = str_replace(" ", "_", $str);
        return stristr($str, '_') ? str_replace(" ", "", ucwords(str_replace("_", " ", $str))) : $str;
    }

    /**
     * Underscore string
     * Example:
     *      Input: ThisIsString
     *      Output: this_is_string
     * @param string $str
     * @return string
     */
    public static function underScore(string $str): string
    {
        $result = strtolower(preg_replace('/(.)([A-Z])/', "$1_$2", $str));
        return $result;
    }
}
