<?php
declare(strict_types=1);

namespace YuryCompany\Hobby\Setup\Patch\Data;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Config;

class AddCustomerHobbyAttribute implements DataPatchInterface
{
    /**
     * ModuleDataSetupInterface
     *
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * EavSetupFactory
     *
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    private $eavConfig;

    /**
     * AddProductAttribute constructor.
     *
     * @param ModuleDataSetupInterface  $moduleDataSetup
     * @param EavSetupFactory           $eavSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory,
        Config $eavConfig
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
//        /** @var EavSetup $eavSetup */
//        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
//
//        $eavSetup->addAttribute('catalog_product', 'helloworld', [
//            'type' => 'int',
//            'label' => 'HelloWorld',
//            'input' => 'select',
//            'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
//            'default' => 0,
//            'global' => ScopedAttributeInterface::SCOPE_STORE,
//            'visible' => true,
//            'used_in_product_listing' => true,
//            'user_defined' => true,
//            'required' => false,
//            'group' => 'General',
//            'sort_order' => 80,
//        ]);

        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $eavSetup->addAttribute(
            Customer::ENTITY,
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

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
