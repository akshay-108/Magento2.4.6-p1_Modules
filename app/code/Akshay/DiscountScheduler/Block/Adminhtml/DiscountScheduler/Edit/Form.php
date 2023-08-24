<?php

namespace Akshay\DiscountScheduler\Block\Adminhtml\DiscountScheduler\Edit;


/**
 * Adminhtml Add New Row Form.
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry             $registry
     * @param \Magento\Framework\Data\FormFactory     $formFactory
     * @param array                                   $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        array $data = []
    ) {
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form.
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('row_data');
        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id' => 'edit_form',
                    'enctype' => 'multipart/form-data',
                    'action' => $this->getData('action'),
                    'method' => 'post'
                ]
            ]
        );

        $form->setHtmlIdPrefix('akgrid_');
        if ($model->getId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Edit Row Data'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add Discount'), 'class' => 'fieldset-wide']
            );
        }

        $fieldset->addField(
            'special_Price_from',
            'date',
            [
                'name' => 'special_Price_from',
                'label' => __('Start Date'),
                'id' => 'special_Price_from',
                'title' => __('Start Date'),
                'class' => 'special_Price_from',
                'required' => true,
            ]
        );
        $fieldset->addField(
            'special_Price_to',
            'date',
            [
                'name' => 'special_Price_to',
                'label' => __('End Date'),
                'id' => 'special_Price_to',
                'title' => __('End Date'),
                'class' => 'special_Price_to',
                'required' => true,
            ]
        );
        $fieldset->addField(
            'discount_data',
            'file',
            [
                'name' => 'discount_data',
                'label' => __('Discount Data (csv file)'),
                'id' => 'discount_data',
                'title' => __('Discount Data (csv file)'),
                'class' => 'discount-csv',
                'required' => true,
            ]
        );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
