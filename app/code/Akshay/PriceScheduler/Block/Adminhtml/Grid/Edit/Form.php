<?php

namespace Akshay\PriceScheduler\Block\Adminhtml\Grid\Edit;

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
        \Akshay\PriceScheduler\Model\Status $options,
        array $data = []
    ) {
        $this->_options = $options;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form.
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        // $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
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

        $form->setHtmlIdPrefix('wkgrid_');
        if ($model->getEntityId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Edit Row Data'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add Schedule'), 'class' => 'fieldset-wide']
            );
        }
        $fieldset->addField(
            'name',
            'text',
            [
                'name' => 'name',
                'label' => __('Title'),
                'id' => 'name',
                'title' => __('Title'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );
        $fieldset->addField(
            'start_date',
            'date',
            [
                'name' => 'start_date',
                'label' => __('Start Date'),
                'id' => 'start_date',
                'title' => __('Start Date'),
                'class' => 'required-entry',
                'required' => true,
                'date_format' => 'yyyy-MM-dd',
                'time_format' => 'hh:mm:ss'
            ]
        );
        $fieldset->addField(
            'end_date',
            'date',
            [
                'name' => 'end_date',
                'label' => __('End Date'),
                'id' => 'end_date',
                'title' => __('End Date'),
                'class' => 'required-entry',
                'required' => true,
                'date_format' => 'yyyy-MM-dd',
                'time_format' => 'hh:mm:ss'
            ]
        );
        $fieldset->addField(
            'product_data',
            'file',
            [
                'name' => 'product_data',
                'label' => __('Product Data'),
                'id' => 'product_data',
                'title' => __('Product Data'),
                'note' => 'Allow File type: .csv',
                'required' => true,
            ]
        );

        // $fieldset->addField(
        //     'is_applied',
        //     'select',
        //     [
        //         'name' => 'is_applied',
        //         'label' => __('Is Applied'),
        //         'id' => 'is_applied',
        //         'title' => __('Is Applied'),
        //         'values' => $this->_options->getOptionArray(),
        //         'required' => true,
        //     ]
        // );
        // $fieldset->addField(
        //     'is_disabled',
        //     'select',
        //     [
        //         'name' => 'is_disabled',
        //         'label' => __('Is Disabled'),
        //         'id' => 'is_disabled',
        //         'title' => __('Is Disabled'),
        //         'values' => $this->_options->getOptionArray(),
        //         'required' => true,
        //     ]
        // );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
