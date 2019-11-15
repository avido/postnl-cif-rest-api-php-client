<?php
namespace Avido\PostNLCifClient\Entities;

/**
  @File: Error.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Error Entity
  @Dependencies:
        BaseEntity
 */

use Avido\PostNLCifClient\Entities\BaseEntity;

class Error extends BaseEntity
{
    /**
     * Code
     * @var String
     */
    protected $Code;
    /**
     * Description
     * @var String
     */
    protected $Description;

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
    public function setCode(string $code): Error
    {
        $this->Code = $code;
        return $this;
    }

    /**
     * Get Code
     *
     * @access public
     * @return string
     */
    public function getCode(): string
    {
        return $this->Code ?? '';
    }

    /**
     * Set Description
     *
     * @access public
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): Error
    {
        $this->Description = $description;
        return $this;
    }

    /**
     * Get Description
     *
     * @access public
     * @return string
     */
    public function getDescription(): string
    {
        return $this->Description ?? '';
    }
}
