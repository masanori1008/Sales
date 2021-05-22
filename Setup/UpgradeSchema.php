<?php

namespace AHT\Sales\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{

  public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
  {

      $installer = $setup;
      $installer->startSetup();

      if (version_compare($context->getVersion(), '1.0.1', '<')) {
        $installer->getConnection()->addColumn(
              $installer->getTable('customer_entity'),
              'is_sales_agent',
              [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
                'nullable' => false,
                'default' => false,
                'comment' => 'Sales Agent'
              ]
          );
      }
      $installer->endSetup();
  }
}
