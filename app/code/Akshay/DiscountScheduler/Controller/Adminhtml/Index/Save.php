<?php
namespace Akshay\DiscountScheduler\Controller\Adminhtml\DiscountScheduler;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Akshay\DiscountScheduler\Model\DiscountSchedulerFactory
     */

    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Akshay\DiscountScheduler\Model\DiscountSchedulerFactory $gridFactory
    ) {
        parent::__construct($context);
        $this->gridFactory = $gridFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            $this->_redirect('discountscheduler/index/addrow');
            return;
        }
        try {
            $rowData = $this->gridFactory->create();
            $rowData->setData($data);
            if (isset($data['id'])) {
                $rowData->setId($data['id']);
            }
            $rowData->save();
            $this->messageManager->addSuccess(__('Row data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('discountscheduler/index/index');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Akshay_DiscountScheduler::save');
    }
}