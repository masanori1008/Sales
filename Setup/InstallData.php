<?php
namespace AHT\Sales\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Config;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;
    private $eavConfig;

    public function __construct(EavSetupFactory $eavSetupFactory, Config $eavConfig)
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
 
        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'sale_agent_id', [
            'group' => 'Product Details',
            'type' => 'int',
            'backend' => '',
            'frontend' => '',
            'sort_order' => 209,
            'label' => 'Customer ID',
            'input' => 'select',
            'class' => '',
            'source' => 'AHT\Sales\Model\Source\AgentDropdown',
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => false,
            'default' => '',
            'searchable' => false,
            'filterable' => false,
            'comparable' => false,
            'visible_on_front' => false,
            'used_in_product_listing' => true,
            'apply_to' => ''
        ]);
 
        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'commission_type', [
            'group' => 'Product Details',
            'type' => 'int',
            'backend' => '',
            'frontend' => '',
            'sort_order' => 210,
            'label' => 'Commission Type',
            'input' => 'select',
            'class' => '',
            'source' => 'AHT\Sales\Model\Source\SalesDropdown',
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => false,
            'default' => '',
            'searchable' => false,
            'filterable' => false,
            'comparable' => false,
            'visible_on_front' => false,
            'used_in_product_listing' => true,
            'apply_to' => ''
        ]);
 
        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'commission_value', [
            'group' => 'Product Details',
            'type' => 'varchar',
            'backend' => '',
            'frontend' => '',
            'sort_order' => 220,
            'label' => 'Commission Value',
            'input' => 'text',
            'class' => '',
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => false,
            'default' => '',
            'searchable' => false,
            'filterable' => false,
            'comparable' => false,
            'unique' => false,
            'visible_on_front' => false,
            'used_in_product_listing' => true,
            'apply_to' => ''
        ]);

        $eavSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, 'is_sales_agent', [
            'type' => 'int',
            'backend' => '',
            'frontend' => '',
            'label' => 'Is Sales Agent',
            'input' => 'boolean',
            'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
            'visible'      => true,
            'user_defined' => true,
            'position'     => 999,
            'system'       => 0
        ]);

        $customerAttr = $this->eavConfig->getAttribute(\Magento\Customer\Model\Customer::ENTITY, 'is_sales_agent');
        $customerAttr->setData(
            'used_in_forms',
            ['adminhtml_customer']

        );
        $customerAttr->save();

        $installer->endSetup();
    }
}