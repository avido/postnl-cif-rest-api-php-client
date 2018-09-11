<?php
namespace Avido\PostNLCifClient\Entities;

/**
  @File: Group.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Group Entity (multi-collo)
  @Dependencies:
        BaseEntity
 */

use Avido\PostNLCifClient\Entities\BaseEntity;

class Group extends BaseEntity
{
    const GROUP_TYPE_COLLECTION_REQUEST = "01";
    const GROUP_TYPE_MULTI_COLLO = "03";
    const GROUP_TYPE_SINGLE = "04";
    
    /**
     * Group sort that determines the type of group that is indicated. This is a code.
     * Possible values:
     * 01 = Collection request
     * 03 = Multiple parcels in one shipment (multicolli)
     * 04 = Single parcel in one shipment (default)
     * @var String
     */
    protected $GroupType = null;
    /**
     * Sequence number of the collo within the complete shipment (e.g. collo 2 of 4)
     * Mandatory for multicollo shipments
     * @var Int
     */
    protected $GroupSequence = null;
    /**
     * Total number of colli in the shipment (in case of multicolli shipments)
     * Mandatory for multicollo shipments
     * @var Int
     */
    protected $GroupCount = null;
    /**
     * Main barcode for the shipment (in case of multicolli shipments) Mandatory for multicollo shipments
     * @var String
     */
    protected $MainBarcode = null;
    
    public function __construct($data = [])
    {
        parent::__construct($data);
    }
    
    /**
     * Set Group Type
     *
     * @access public
     * @param string $type
     * @return $this
     */
    public function setGroupType($type = '04')
    {
        $this->GroupType = (string)$type;
        return $this;
    }
    
    /**
     * Get Group Type
     *
     * @access public
     * @return string
     */
    public function getGroupType()
    {
        return (string)$this->GroupType;
    }
    
    /**
     * Set GroupSequence
     *
     * @access public
     * @param int $sequence
     * @return $this
     */
    public function setGroupSequence($sequence)
    {
        $this->GroupSequence = (int)$sequence;
        return $this;
    }
    
    /**
     * Get GroupSequence
     *
     * @access public
     * @return string
     */
    public function getGroupSequence()
    {
        return (int)$this->GroupSequence;
    }
    
    
    /**
     * Set GroupCount
     *
     * @access public
     * @param int $cnt
     * @return $this
     */
    public function setGroupCount($cnt)
    {
        $this->GroupCount = (int)$cnt;
        return $this;
    }
    
    /**
     * Get GroupCount
     *
     * @access public
     * @return int
     */
    public function getGroupCount()
    {
        return (int)$this->GroupCount;
    }
    
    /**
     * Set MainBarcode
     *
     * @access public
     * @param string $barcode
     * @return $this
     */
    public function setMainBarcode($barcode)
    {
        $this->MainBarcode = (string)$barcode;
        return $this;
    }
    
    /**
     * Get MainBarcode
     *
     * @access public
     * @return string
     */
    public function getMainBarcode()
    {
        return (string)$this->MainBarcode;
    }
}
