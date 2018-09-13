<?php
namespace Avido\PostNLCifClient\Entities;

/**
  @File: Signature.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Signature
  @Dependencies:
        BaseEntity
 */

use Avido\PostNLCifClient\Entities\BaseEntity;
use Avido\PostNLCifClient\Util\Date;

class Signature extends BaseEntity
{
    /**
     * Barcode
     * @var String
     */
    protected $Barcode = null;
    /**
     * SignatureDate
     * @var Util\Date
     */
    protected $SignatureDate = null;
    /**
     * SignatureImage
     * @var String
     */
    protected $SignatureImage = null;
    
    public function __construct($data = [])
    {
        parent::__construct($data);
        // update timestamp if set.
        if (isset($data['SignatureDate'])) {
            $this->setSignatureDate($data['SignatureDate']);
        }
    }
    
    /**
     * Set SignatureDate
     *
     * @access public
     * @param String
     * @return $this
     */
    public function setSignatureDate($timestamp)
    {
        if (!$timestamp instanceof Date) {
            $timestamp = new Date($timestamp);
        }
        $this->SignatureDate = $timestamp;
        return $this;
    }
    
    /**
     * Get SignatureDate
     *
     * @access public
     * @return String format: Y-m-d H:i:s
     */
    public function getSignatureDate()
    {
        return (string)$this->SignatureDate->format("Y-m-d H:i:s");
    }
    
    /**
     * Set Barcode
     *
     * @access public
     * @param string $barcode
     * @return $this
     */
    public function setBarcode($barcode)
    {
        $this->Barcode = (string)$barcode;
        return $this;
    }
    
    /**
     * Get Barcode
     *
     * @access public
     * @return string
     */
    public function getBarcode()
    {
        return (string)$this->Barcode;
    }
    
    /**
     * Set SignatureImage
     *
     * @access public
     * @param string $image
     * @return $this
     */
    public function setSignatureImage($image)
    {
        $this->SignatureImage = (string)$image;
        return $this;
    }
    
    /**
     * Get SignatureImage
     *
     * @access public
     * @return string
     */
    public function getSignatureImage()
    {
        return (string)$this->SignatureImage;
    }
}
