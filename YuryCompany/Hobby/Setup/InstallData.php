<?php
namespace YuryCompany\Hobby\Setup;

use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Config;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    private $customerSetupFactory;
    private $eavConfig;

    public function __construct(
        \Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory,
        Config $eavConfig
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
        $this->eavConfig = $eavConfig;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->customerSetupFactory->create(['setup' => $setup]);

        $eavSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            'hobby',
            [
                'label' => 'Hobby',
                'system' => false,
                'position' => 700,
                'sort_order' => 700,
                'visible' => true,
                'note' => '',
                'type' => 'int',
                'input' => 'select',
                'source' => 'YuryCompany\Hobby\Model\Source\Hobbydropdown',
            ]
        );

        $hobbyAttribute = $this->eavConfig->getAttribute(Customer::ENTITY, 'hobby');

        $hobbyAttribute
            ->setData('is_user_defined', 1)
            ->setData('is_required', 0)
            ->setData('default_value', '')
            ->setData('used_in_forms', ['adminhtml_customer'])
            ->save();
    }
}
