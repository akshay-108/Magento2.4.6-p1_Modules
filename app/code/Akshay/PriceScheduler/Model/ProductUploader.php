<?php

namespace Akshay\PriceScheduler\Model;

use Magento\Catalog\Api\SpecialPriceInterface;
use Magento\Catalog\Api\Data\SpecialPriceInterfaceFactory;

class ProductUploader
{
    /**
     * @var SpecialPriceInterface
     */
    protected $specialPrice;

    /**
     * @var SpecialPriceInterfaceFactory
     */
    protected $specialPriceFactory;
    /**
     * @var GridFactory
     */
    protected  $gridfactory;
    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;


    public function __construct(
        \Akshay\PriceScheduler\Model\GridFactory $gridfactory,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Framework\App\State $state,
        SpecialPriceInterface $specialPrice,
        SpecialPriceInterfaceFactory $specialPriceFactory
    ) {
        $this->gridfactory = $gridfactory;
        $this->productRepository = $productRepository;
        $this->state = $state;
        $this->specialPrice = $specialPrice;
        $this->specialPriceFactory = $specialPriceFactory;
    }
    public function ProductLoader()
    {
        $duration = 1;
        $customProduct = [];
        $customProduct = $this->gridfactory->create();
        $collection = $customProduct->getCollection();

        $now = new \DateTime();

        $collection->addFieldToFilter('is_applied', ['eq' => 0])
            ->addFieldToFilter('is_disabled', ['eq' => 0])
            ->addFieldToFilter(
                'start_time',
                [
                    'from' => $now->format('Y-m-d 00:00:00'),
                    'to' => $now->format('Y-m-d 23:59:59')
                ]
            );

        if (count($collection) >= 1) {
            foreach ($collection as $item) {
                $customProduct = $item->getData();
                try {
                    $this->setAreaCode('frontend');
                    $customProduct['product_data'] = json_decode($customProduct['product_data'], true);
                    
                    foreach ($customProduct['product_data'] as $product) {
                        $this->productUpdater($product['sku'], $product['special_price']);
                    }
                    $isApplied = $item->setIsApplied(1);
                    $isApplied->save();
                } catch (\Exception $e) {
                    echo $e->getMessage();
                }
            }
        } else {
            echo "Data Not Found" . "\n";
        }
    }

    public function productUpdater($productSku, $productSpecialPrice)
    {
        try {
            $productEntity = $this->productRepository->get($productSku);
            $data = $this->updateProductPrice($productEntity, $productSpecialPrice);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function updateProductPrice($product, $specialPrice, $store = 0)
    {
        try {
            $sku = $product->getSku();
            $basePrice = $product->getPrice();
            $productId = $product->getIdBySku($sku);

            if (!$basePrice) {
                echo 'No Base price set - SKU: ' . $sku;
                return false;
            }

            echo 'Base price set - SKU: ' . $sku . ' basePrice: ' . $basePrice . "\n";

            $priceFrom = '2020-12-01'; // future date to current date
            $priceTo = '2025-10-15'; // future date to price from

            $updateDatetime = new \DateTime();
            $priceFrom = $updateDatetime->modify($priceFrom)->format('Y-m-d H:i:s');
            $priceTo = $updateDatetime->modify($priceTo)->format('Y-m-d H:i:s');

            // special price
            if ($specialPrice && $specialPrice <= $basePrice) {
                $prices[] = $this->specialPriceFactory->create()
                ->setSku($sku)
                ->setStoreId($store)
                ->setPrice($specialPrice)
                ->setPriceFrom($priceFrom)
                ->setPriceTo($priceTo);

                $this->specialPrice->update($prices);
                echo 'Special price set - SKU: ' . $sku . ' specialPrice: ' . $specialPrice . "\n";
            }
            echo 'saved successfully' . "\n";
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function setAreaCode($areaCode)
    {
        try {
            $this->state->setAreaCode($areaCode);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function reindexProduct($productId)
    {
        $indexers = [
            'cataloginventory_stock',
            //'inventory',
            'catalogsearch_fulltext',
            'catalog_product_price',
        ];

        foreach ($indexers as $indexer) {
            $productIndexer = $this->indexerRegistry->get($indexer);

            if (!$productIndexer->isScheduled()) {
                try {
                    $productIndexer->reindexList([$productId]);
                    // $this->logIt('ProductId: ' . $productId . ' Reindexing: ' . $indexer);
                } catch (\Exception $e) {
                    echo $e->getMessage();
                    exit;
                }
            }
        }
    }
}
