<?php
namespace Akshay\PriceScheduler\Api\Data;

interface GridInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    const ENTITY_ID = 'id';
    const StartTime = 'start_time';
    const ProductData = 'product_data';
    const IsApplied = 'is_applied';
    const IsDisabled = 'is_disabled';

    /**
     * Get EntityId.
     *
     * @return int
     */
    public function getEntityId();

    /**
     * Set EntityId.
     */
    public function setEntityId($id);
    /**
     * Get Start Time.
     *
     * @return timestamp
     */
    public function getStartTime();

    /**
     * Set Start Time.
     */
    public function setStartTime($start_time);

    /**
     * Get ProductData.
     *
     * @return file
     */
    public function getProductData();

    /**
     * Set ProductData.
     */
    public function setProductData($product_data);

    /**
     *
     * @return tinyint
     */
    public function getIsApplied();

    /**
     * get IsApplied
     */
    public function setIsApplied($is_applied);
    /**
     *
     * @return tinyint
     */
    public function getIsDisabled();

    /**
     * get IsDisabled
     */
    public function setIsDisabled($is_disabled);

    
}