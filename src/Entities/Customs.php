<?php
namespace Avido\PostNLCifClient\Entities;

/**
  @File: Customs.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Customs Entity
  @Dependencies:
        BaseEntity
 */

use Avido\PostNLCifClient\Entities\BaseEntity;

class Customs extends BaseEntity
{
    const TYPE_GIFT = "Gift";
    const TYPE_DOCUMENTS = "Documents";
    const TYPE_COMMERICAL_GOODS = "Commerical Goods";
    const TYPE_COMMERICAL_SAMPLE = "Commerical Sample";
    const TYPE_RETURNED_GOODS = "Returned Goods";

    /**
     * At least one of the three types Certificate, Invoice or License is mandatory for Commercial Goods,
     * Commercial Sample and Returned Goods
     * @var Boolean
     */
    private $Certificate = null;
    /**
     * Mandatory when Certificate is true.
     * @var String
     */
    private $CertificateNr = null;
    /**
     * At least one of the three types Certificate, Invoice or License is mandatory for Commercial Goods,
     * Commercial Sample and Returned Goods
     * @var Boolean
     */
    private $License = null;
    /**
     * Mandatory when License is true.
     * @var String
     */
    private $LicenseNr = null;
    /**
     * At least one of the three types Certificate, Invoice or License is mandatory for Commercial Goods,
     * Commercial Sample and Returned Goods
     * @var Boolean
     */
    protected $Invoice = null;
    /**
     * Mandatory when Invoice is true
     * @var String
     */
    protected $InvoiceNr = null;
    /**
     * Determines what to do when the shipment cannot be delivered the first time (if this is set to true, the
     * shipment will be returned after the first failed attempt)
     * If false, package will be 'destroyed' if not deliverable
     * @var Boolean
     */
    protected $HandleAsNonDeliverable = null;
    /**
     * Currency code,only EUR and USS are allowed
     * @var String
     */
    protected $Currency = null;
    /**
     * Type of shipment,possible values:
     * Gift,
     * Documents,
     * Commercial Goods,
     * Commercial Sample,
     * Returned Goods
     * @var String
     */
    protected $ShipmentType = null;
    /**
     * contents of shipment
     * @var array (Entities/Content)
     */
    protected $Content = [];


    public function __construct($data = [])
    {
        parent::__construct($data);
    }

    /**
     * Set Certificate
     *
     * @access public
     * @param boolean $certificate
     * @return $this
     */
    public function setCertificate(bool $certificate): Customs
    {
        $this->Certificate = $certificate;
        return $this;
    }

    /**
     * Get Certificate
     *
     * @access public
     * @return boolean
     */
    public function getCertificate(): bool
    {
        return $this->Certificate;
    }

    /**
     * Set CertificateNr
     *
     * @access public
     * @param string $certificate_number
     * @return $this
     */
    public function setCertificateNumber(string $certificate_number): Customs
    {
        $this->CertificateNr = $certificate_number;
        return $this;
    }

    /**
     * Get CertificateNr
     *
     * @access public
     * @return string
     */
    public function getCertificateNumber(): string
    {
        return $this->CertificateNr ?? '';
    }


    /**
     * Set License
     *
     * @access public
     * @param boolean $license
     * @return $this
     */
    public function setLicense(bool $license): Customs
    {
        $this->License = $license;
        return $this;
    }

    /**
     * Get License
     *
     * @access public
     * @return boolean
     */
    public function getLicense(): bool
    {
        return $this->License;
    }

    /**
     * Set LicenseNr
     *
     * @access public
     * @param string $license_number
     * @return $this
     */
    public function setLicenseNumber(string $license_number): Customs
    {
        $this->LicenseNr = $license_number;
        return $this;
    }

    /**
     * Get LicenseNr
     *
     * @access public
     * @return string
     */
    public function getLicenseNumber(): string
    {
        return $this->LicenseNr ?? '';
    }

    /**
     * Set Invoice
     *
     * @access public
     * @param boolean $invoice
     * @return $this
     */
    public function setInvoice(bool $invoice): Customs
    {
        $this->Invoice = $invoice;
        return $this;
    }

    /**
     * Get Invoice
     *
     * @access public
     * @return boolean
     */
    public function getInvoice(): bool
    {
        return $this->Invoice;
    }

    /**
     * Set InvoiceNr
     *
     * @access public
     * @param string $invoice_number
     * @return $this
     */
    public function setInvoiceNumber(string $invoice_number): Customss
    {
        $this->InvoiceNr = $invoice_number;
        return $this;
    }

    /**
     * Get InvoiceNr
     *
     * @access public
     * @return string
     */
    public function getInvoiceNumber(): string
    {
        return $this->InvoiceNr ?? '';
    }

    /**
     * Handle Shipment as Non Deliverable
     *
     * @access public
     * @param boolean $handle_non_deliverable
     * @return $this
     */
    public function setHandleAsNonDeliverable(bool $handle_non_deliverable): Customs
    {
        $this->HandleAsNonDeliverable = $handle_non_deliverable;
        return $this;
    }

    /**
     * Get Handle Shipment as Non Deliverable
     *
     * @access public
     * @return boolean
     */
    public function getHandleAsNonDeliverable(): bool
    {
        return $this->HandleAsNonDeliverable;
    }

    /**
     * Set Currency
     *
     * @access public
     * @param string $currency
     * @return $this
     */
    public function setCurrency(string $currency): Customs
    {
        $this->Currency = $currency;
        return $this;
    }

    /**
     * Get Currency
     *
     * @access public
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->Currency ?? '';
    }

    /**
     * Set Shipment Type
     *
     * @access public
     * @param string $shipment_type
     * @return $this
     */
    public function setShipmentType(string $shipment_type): Customs
    {
        $this->ShipmentType = $shipment_type;
        return $this;
    }

    /**
     * Get Shipment Type
     *
     * @access public
     * @return string
     */
    public function getShipmentType(): string
    {
        return $this->ShipmentType ?? '';
    }

    /**
     * Set Array of Customs content (entities/CustomsContent)
     *
     * @access public
     * @param array $contents
     * @return $this
     */
    public function setContent(array $contents = []): Customs
    {
        $this->Content = $contents;
        return $this;
    }

    /**
     * Get Array of Customs content (entities/CustomsContent)
     *
     * @access public
     * @return array
     */
    public function getContent(): array
    {
        return $this->Content;
    }

    /**
     * Output Customs entity as array
     *
     * @access public
     * @return array
     */
    public function toArray(): array
    {
        $data = parent::toArray();
        $data['Content'] = $this->getContentsArray();
        return $data;
    }

    public function getContentsArray(): array
    {
        $return = [];
        foreach ($this->getContent() as $content) {
            $return[] = $content->toArray();
        }
        return $return;
    }
}
