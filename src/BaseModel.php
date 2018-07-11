<?php
namespace Avido\PostNLCifClient;
/**
    @File: BaseModel.php
    @version 0.1.0
    @Encoding:  UTF-8
    @Package: PostNL Cif Rest API PHP Client
    @copyright   Avido
*/

class BaseModel
{
    private $data = [];
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
    public function __call($method, $args)
    {
        switch (substr($method, 0, 3)) {
            case 'get' :
                $key = $this->underScore(substr($method,3));
                return $this->getData($key, isset($args[0]) ? $args[0] : null);
                break;
            case 'set':
                $key = $this->underScore(substr($method,3));
                return $this->setData($key, isset($args[0]) ? $args[0] : null);
                break;
            case 'has':
                $key = $this->underScore(strtolower(substr($method,3)));
                return isset($this->data[$key]);
                break;
        }
    }
    /**
     * Get data from attribute, child entity or nested entity
     *
     * @param string $key
     * @return null|string|array
     */
    public function getData($key=null)
    {
//        $data = self::toArray();
        $data = $this->data;
        return isset($data[$key]) ? $data[$key] : null;
    }
    
    public function setData($key, $value=null)
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
    public function __toArray()
    {
        return $this->data;
    }

    /**
     * Public wrapper for __toArray
     *
     * @return array
     */
    public function toArray()
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
    public static function camelCase($str)
    {
        $str = strtolower($str);
        $str = str_replace(" ", "_", $str);
        return stristr($str,'_') ? str_replace(" ", "", ucwords(str_replace("_", " ", $str))) : $str;
    }

    /**
     * Underscore string
     * Example:
     *      Input: ThisIsString
     *      Output: this_is_string
     * @param string $str
     * @return string
     */
    public static function underScore($str)
    {
        #Varien_Profiler::start('underscore');
        $result = strtolower(preg_replace('/(.)([A-Z])/', "$1_$2", $str));
        return $result;
    }
}
