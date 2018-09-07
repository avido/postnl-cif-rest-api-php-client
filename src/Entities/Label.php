<?php
namespace Avido\PostNLCifClient\Entities;

/**
  @File: Label.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Label Entity
  @Dependencies:
        BaseModel
 */

use Avido\PostNLCifClient\BaseModel;

class Label extends BaseModel
{
    protected $Content = null;
    protected $Labeltype = null;
    
    public function __construct($data=[])
    {
        parent::__construct();
        parent::initFromArray($data);
    }
    
    /**
     * Set Content
     *
     * @access public
     * @param base64Binary $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->Content = $content;
        return $this;
    }
    
    /**
     * Get Content 
     *
     * @access public
     * @return string/base64bin
     */
    public function getContent()
    {
        return $this->Content;
    }
    
    /**
     * Set Labeltype
     *
     * @access public
     * @param string $labeltype
     * @return $this
     */
    public function setLabeltype($labeltype) 
    {
        $this->Labeltype = (string)$labeltype;
        return $this;
    }
    
    /**
     * Get Labeltype
     *
     * @access public
     * @return string
     */
    public function getLabeltype()
    {
        return (string)$this->Labeltype;
    }
}
