<?php
namespace Akshay\DiscountScheduler\Model;
class DiscountScheduler extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'product_discount_scheduler';

	protected $_cacheTag = 'product_discount_scheduler';

	protected $_eventPrefix = 'product_discount_scheduler';

	protected function _construct()
	{
		$this->_init('Akshay\DiscountScheduler\Model\ResourceModel\DiscountScheduler');
	}

	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}

     /**
     * Get EntityId.
     *
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::ENTITY_ID);
    }

     /**
     * Set EntityId.
     */
    public function setId($id)
    {
        return $this->setData(self::ENTITY_ID, $id);
    }

    /**
     * Get Special Price From.
     *
     * @return timestamp
     */
    public function getSpecialPriceFrom()
    {
        return $this->getData(self::SPECIAL_PRICE_FROM);
    }

    /**
     * Set Special Price From.
     */
    public function setSpecialPriceFrom($specialPriceFrom)
    {
        return $this->setData(self::SPECIAL_PRICE_FROM, $specialPriceFrom);
    }

    /**
     * Get Special Price To.
     *
     * @return timestamp
     */
    public function getSpecialPriceTo()
    {
        return $this->getData(self::SPECIAL_PRICE_TO);
    }

    /**
     * Set Special Price From.
     */
    public function setSpecialPriceTo($specialPriceTo)
    {
        return $this->setData(self::SPECIAL_PRICE_TO, $specialPriceTo);
    }

    /**
     * Get CSV FILE PATH.
     *
     * @return text
     */
    public function getCsvFilePath()
    {
        return $this->getData(self::CSV_FILE_PATH);
    }

    /**
     * Set Special Price From.
     */
    public function setCsvFilePath($csvFilePath)
    {
        return $this->setData(self::CSV_FILE_PATH, $csvFilePath);
    }

    /**
     * Get Discount Data.
     *
     * @return json
     */
    public function getDiscountData()
    {
        return $this->getData(self::DISCOUNT_DATA);
    }

    /**
     * Set Discount Data.
     */
    public function setDiscountData($discountData)
    {
        return $this->setData(self::DISCOUNT_DATA, $discountData);
    }

    /**
     * Get is applied
     * @return boolean
     */
    public function getIsApplied()
    {
        return $this->getData(self::IS_APPLIED);
    }

    /**
     * Set is applied
     * @return boolean
     */
    public function setIsApplied($isApplied)
    {
        return $this->setData(self::IS_APPLIED, $isApplied );
    }
}
