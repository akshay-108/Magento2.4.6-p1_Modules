<?php

namespace Akshay\PriceScheduler\Model;

use Akshay\PriceScheduler\Api\Data\GridInterface;

class Grid extends \Magento\Framework\Model\AbstractModel implements GridInterface
{
    /**
     * CMS page cache tag.
     */
    const CACHE_TAG = 'product_price_scheduler';

    /**
     * @var string
     */
    protected $_cacheTag = 'product_price_scheduler';

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    protected $_eventPrefix = 'product_price_scheduler';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('Akshay\PriceScheduler\Model\ResourceModel\Grid');
    }
    /**
     * Get EntityId.
     *
     * @return int
     */
    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * Set EntityId.
     */
    public function setEntityId($id)
    {
        return $this->setData(self::ENTITY_ID, $id);
    }

    /**
     * Get Timestamp.
     *
     * @return timestamp
     */
    public function getStartTime()
    {
        return $this->getData(self::StartTime);
    }

    /**
     * Set Timestamp.
     */
    public function setStartTime($start_time)
    {
        return $this->setData(self::StartTime, $start_time);
    }

    /**
     * Get ProductData
     *
     * @return file
     */
    public function getProductData()
    {
        return $this->getData(self::ProductData);
    }

    /**
     * Set ProductData.
     */
    public function setProductData($product_data)
    {
        return $this->setData(self::ProductData, $product_data);
    }

    /**
     * Get IsApplied
     *
     * @return tinyint
     */
    public function getIsApplied()
    {
        return $this->getData(self::IsApplied);
    }

    /**
     * Set IsApplied.
     */
    public function setIsApplied($is_applied)
    {
        return $this->setData(self::IsApplied, $is_applied);
    }

    /**
     * Get IsApplied
     *
     * @return tinyint
     */
    public function getIsDisabled()
    {
        return $this->getData(self::IsDisabled);
    }

    /**
     * set IsDisabled
     */
    public function setIsDisabled($is_disabled)
    {
        return $this->setData(self::IsDisabled, $is_disabled);
    }

    
    
}