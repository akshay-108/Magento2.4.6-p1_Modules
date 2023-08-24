<?php
namespace Akshay\DiscountScheduler\Api\DiscountScheduler;

interface DiscountSdhedulerInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    const ENTITY_ID = 'id';
    const SPECIAL_PRICE_FROM = 'special_Price_from';
    const SPECIAL_PRICE_TO = 'special_Price_to';
    const DISCOUNT_DATA = 'discount_data';
    const CSV_FILE_PATH = 'csv_file_path';
    const IS_APPLIED = 'is_applied';

    /**
     * Get EntityId.
     *
     * @return int
     */
    public function getId();

    /**
     * Set EntityId.
     */
    public function setId($id);

    /**
     * Get Special Price From.
     *
     * @return timestamp
     */
    public function getSpecialPriceFrom();

    /**
     * Set Special Price From.
     */
    public function setSpecialPriceFrom($specialPriceFrom);

    /**
     * Get Special Price To.
     *
     * @return timestamp
     */
    public function getSpecialPriceTo();

    /**
     * Set Special Price From.
     */
    public function setSpecialPriceTo($specialPriceTo);

    /**
     * Get CSV FILE PATH.
     *
     * @return text
     */
    public function getCsvFilePath();

    /**
     * Set Special Price From.
     */
    public function setCsvFilePath($csvFilePath);

    /**
     * Get Discount Data.
     *
     * @return json
     */
    public function getDiscountData();

    /**
     * Set Discount Data.
     */
    public function setDiscountData($discountData);

    /**
     * Get is applied
     * @return boolean
     */
    public function getIsApplied();

    /**
     * Set is applied
     * @return boolean
     */
    public function setIsApplied($isApplied);
}
