<?php
namespace Akshay\DiscountScheduler\Model\ResourceModel\DiscountScheduler;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'id';
	protected $_eventPrefix = 'product_discount_scheduler_collection';
	protected $_eventObject = 'product_discount_scheduler_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Akshay\DiscountScheduler\Model\DiscountScheduler', 'Akshay\DiscountScheduler\Model\ResourceModel\DiscountScheduler');
	}

}