<?php
namespace Avido\PostNLCifClient\Entities;

/**
  @File: Amount.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Amount entity
  @Dependencies:
        BaseEntity
 */

use Avido\PostNLCifClient\Entities\BaseEntity;

class Amount extends BaseEntity
{
    const TYPE_COD = "01";
    const TYPE_INSURED = "02";
    const TYPE_CHINA_ROUTE = "04";
    const TYPE_CHINA_INCO_DDP = "12";

    /**
     * List of 0 or more AmountType elements. An amount represents a value of the shipment.
     * Amount type 01 mandatory for COD-shipments,
     * Amount type 02 mandatory for domestic insured shipments.
     * Amount type 04 mandatory for Commercial route China (productcode 4992)
     * Amount type 12 mandatory for Inco terms DDP Commercial route China (productcode 4992)*
     * @see https://developer.postnl.nl/browse-apis/send-and-track/labelling-webservice/documentation/
     * @var string
     */
    protected $AmountType = null;
    /**
     * Name of bank account owner
     * @var string
     */
    protected $AccountName = null;
    /**
     * BIC number,optional for COD shipments (mandatory for bank account number other than originating in
     * The Netherlands
     * @var string
     */
    protected $BIC = null;
    /**
     * Currency code according ISO 4217. E.g. EUR
     * @var string
     */
    protected $Currency = null;
    /**
     * IBAN bank account number,mandatory for COD shipments. Dutch IBAN numbers are 18 characters
     * @var string
     */
    protected $IBAN = null;
    /**
     * Personal payment reference
     * @var string
     */
    protected $Reference = null;
    /**
     * Transaction number
     * @var string
     */
    protected $TransactionNumber = null;
    /**
     * Money value in EUR (unless value Currency is specified for another currency).
     * Value format (N6.2): #####0.00 (2 digits behind decimal dot)
        Mandatory for COD, Insured products and Commercial route China.
     * @var string
     */
    protected $Value = null;

    public function __construct($data = [])
    {
        parent::__construct($data);
    }

    /**
     * Set Amount Type
     *
     * @access public
     * @param string $type
     * @return $this
     */
    public function setAmountType(string $type): Amount
    {
        $this->AmountType = $type;
        return $this;
    }

    /**
     * Get Amount Type
     *
     * @access public
     * @return string
     */
    public function getAmountType(): string
    {
        return $this->AmountType ?? '';
    }

    /**
     * Set Account Name
     *
     * @access public
     * @param string $account_name
     * @return $this
     */
    public function setAccountName(string $account_name): Amount
    {
        $this->AccountName = $account_name;
        return $this;
    }

    /**
     * Get Account Name
     *
     * @access public
     * @return string
     */
    public function getAcountName(): string
    {
        return $this->AccountName ?? '';
    }

    /**
     * Set BIC
     *
     * @access public
     * @param string $bic
     * @return $this
     */
    public function setBIC(string $bic): Amount
    {
        $this->BIC = $bic;
        return $this;
    }

    /**
     * Get BIC
     *
     * @access public
     * @return string
     */
    public function getBIC(): string
    {
        return $this->BIC ?? '';
    }

    /**
     * Set Currency
     *
     * @access public
     * @param string $currency
     * @return $this
     */
    public function setCurrency(string $currency): Amount
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
     * Set IBAN
     *
     * @access public
     * @param string $iban
     * @return $this
     */
    public function setIBAN(string $iban): Amount
    {
        $this->IBAN = $iban;
        return $this;
    }

    /**
     * Get IBAN
     *
     * @access public
     * @return string
     */
    public function getIBAN(): string
    {
        return $this->IBAN ?? '';
    }

    /**
     * Set Reference
     *
     * @access public
     * @param string $reference
     * @return $this
     */
    public function setReference(string $reference): Amount
    {
        $this->Reference = $reference;
        return $this;
    }

    /**
     * Get Reference
     *
     * @access public
     * @return string
     */
    public function getReference(): string
    {
        return $this->Reference ?? '';
    }

    /**
     * Set TransactionNumber
     *
     * @access public
     * @param string $transaction_number
     * @return $this
     */
    public function setTransactionNumber(string $transaction_number): Amount
    {
        $this->TransactionNumber = $transaction_number;
        return $this;
    }

    /**
     * Get TransactionNumber
     *
     * @access public
     * @return string
     */
    public function getTransactionNumber(): string
    {
        return $this->TransactionNumber ?? '';
    }

    /**
     * Set Value
     *
     * @access public
     * @param string $value
     * @return $this
     */
    public function setValue(string $value): Amount
    {
        $this->Value = $value;
        return $this;
    }

    /**
     * Get Value
     *
     * @access public
     * @return string
     */
    public function getValue(): string
    {
        return $this->Value ?? '';
    }
}
