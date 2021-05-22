<?php

namespace AHT\Sales\Setup;

use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;


class InstallSchema implements InstallSchemaInterface 
{

	public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {

		$installer = $setup;
		$installer->startSetup();

		$table = $installer->getConnection()->newTable(
			$installer->getTable('aht_sales')
		)->addColumn(
			'entity_id',
			Table::TYPE_INTEGER,
			null,
			[
				'identity' => true,
				'nullable' => false,
				'primary'  => true,
				'unsigned' => true
			],
			'Entity ID'
		)->addColumn(
			'order_id',
			Table::TYPE_INTEGER,
			255,
			[
				'nullable' => false,
				'unsigned' => true,
				'default' => 0
			],
			'Order ID'
		)->addColumn(
			'order_item_id',
			Table::TYPE_INTEGER,
			255,
			[
				'nullable' => false,
				'unsigned' => true,
				'default' => 0
			],
			'Order Item ID'
		)->addColumn(
			'order_item_sku',
			Table::TYPE_TEXT,
			255,
			[
				'nullable' => false,
			],
			'Order Item SKU'
		)->addColumn(
			'order_item_price',
			Table::TYPE_INTEGER,
			255,
			[
				'nullable' => false,
			],
			'Order Item Price'
		)->addColumn(
			'commision_percent',
			Table::TYPE_INTEGER,
			255,
			[
				'nullable' => false,
			],
			'Commision Percent'
		)->addColumn(
			'commission_value',
			Table::TYPE_INTEGER,
			255,
			[
				'nullable' => false,
			],
			'Commision Value'
		)

		->addIndex(
            $installer->getIdxName('aht_sales', ['entity_id']),
            ['entity_id']
        )->addIndex(
            $installer->getIdxName('aht_sales', ['order_id']),
            ['order_id']
        )->addIndex(
            $installer->getIdxName('aht_sales', ['order_item_id']),
            ['order_item_id']
        );

		$installer->getConnection()->createTable($table);

        $installer->endSetup();
	}
}