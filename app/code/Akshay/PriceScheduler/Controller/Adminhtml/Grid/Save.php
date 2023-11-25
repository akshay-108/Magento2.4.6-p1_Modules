<?php
namespace Akshay\PriceScheduler\Controller\Adminhtml\Grid;
use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends \Magento\Backend\App\Action
{
    var $gridFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Akshay\PriceScheduler\Model\GridFactory $gridFactory,
        \Magento\Framework\Filesystem\Driver\File $file,
        \Magento\Framework\File\Csv $csv,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Akshay\PriceScheduler\Helper\Data $helper
    ) {
        parent::__construct($context);
        $this->gridFactory = $gridFactory;
        $this->file = $file;
        $this->csv = $csv;
        $this->varDirectory = $filesystem->getDirectoryWrite(DirectoryList::VAR_DIR);
        $this->uploaderFactory = $uploaderFactory;
        $this->messageManager = $messageManager;
        $this->helper = $helper;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        $files = $this->getRequest()->getFiles()->toArray();
        $csvInfoFile = $files['product_data'];
        $uploader = $this->uploaderFactory->create(['fileId' => $csvInfoFile]);
        $workingDir = $this->varDirectory->getAbsolutePath('importexport/');
        $result = $uploader->save($workingDir);
        $path = $result['path'] . $result['file'];
        
        if (!$data && $uploader->getFileExtension($path) == 'csv') {
            $this->_redirect('grid/grid/addrow');
            return;
        }

        if($uploader->getFileExtension($path) == 'csv')
        {
            try {
                $rowData = $this->gridFactory->create();
                $data['product_data'] = $this->helper->csvToJson($path);
                $rowData->setData($data);
                if (isset($data['id'])) {
                    $rowData->setEntityId($data['id']);
                }
                $rowData->save();
                $this->messageManager->addSuccess(__('Row data has been successfully saved.'));
            } catch (\Exception $e) {
                $this->messageManager->addError(__($e->getMessage()));
            }
            $this->_redirect('grid/grid/index');
        }else{
            $this->messageManager->addError(__("check your file extension, only <strong>.csv</strong> extension is allowed"));
            $this->_redirect('grid/grid/addrow');
            return;
        }
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Akshay_PriceScheduler::save');
    }
}