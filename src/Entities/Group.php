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
    public function setGroupType(string $type = '04'): Group
    {
        $this->GroupType = $type;
        return $this;
    }

    /**
     * Get Group Type
     *
     * @access public
     * @return string
     */
    public function getGroupType(): string
    {
        return $this->GroupType ?? '';
    }

    /**
     * Set GroupSequence
     *
     * @access public
     * @param int $sequence
     * @return $this
     */
    public function setGroupSequence(int $sequence): Group
    {
        $this->GroupSequence = $sequence;
        return $this;
    }

    /**
     * Get GroupSequence
     *
     * @access public
     * @return string
     */
    public function getGroupSequence(): int
    {
        return $this->GroupSequence;
    }


    /**
     * Set GroupCount
     *
     * @access public
     * @param int $cnt
     * @return $this
     */
    public function setGroupCount(int $cnt): Group
    {
        $this->GroupCount = $cnt;
        return $this;
    }

    /**
     * Get GroupCount
     *
     * @access public
     * @return int
     */
    public function getGroupCount(): int
    {
        return $this->GroupCount;
    }

    /**
     * Set MainBarcode
     *
     * @access public
     * @param string $barcode
     * @return $this
     */
    public function setMainBarcode(string $barcode): Group
    {
        $this->MainBarcode = $barcode;
        return $this;
    }

    /**
     * Get MainBarcode
     *
     * @access public
     * @return string
     */
    public function getMainBarcode(): string
    {
        return $this->MainBarcode ?? '';
    }
}
