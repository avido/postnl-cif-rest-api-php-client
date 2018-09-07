<?php
namespace Avido\PostNLCifClient\Entities;

/**
  @File: Warning.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Warning Entity
  @Dependencies:
        BaseEntity
 */

use Avido\PostNLCifClient\Entities\BaseEntity;

class Warning extends BaseEntity
{
    /**
     * Code
     * @var String
     */
    protected $Code = null;
    /**
     * Description
     * @var String
     */
    protected $Description = null;
    
    public function __construct($data = [])
    {
        parent::__construct($data);
    }
    
    /**
     * Set Code
     *
     * @access public
     * @param string $code
     * @return $this;
     */
    public function setCode($code)
    {
        $this->Code = (string)$code;
        return $this;
    }
    
    /**
     * Get Code
     *
     * @access public
     * @return string
     */
    public function getCode()
    {
        return (string)$this->Code;
    }
    
    /**
     * Set Description
     *
     * @access public
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->Description = (string)$description;
        return $this;
    }
    
    /**
     * Get Description
     *
     * @access public
     * @return string
     */
    public function getDescription()
    {
        return (string)$this->Description;
    }
}
