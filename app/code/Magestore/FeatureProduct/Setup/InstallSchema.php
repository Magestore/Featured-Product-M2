<?php
namespace Magestore\FeatureProduct\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * Class InstallSchema
 * @package Magestore\FeatureProduct\Setup
 */
class InstallSchema implements InstallSchemaInterface{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function Install(SchemaSetupInterface $setup, ModuleContextInterface $context){
        $installer = $setup;
        $installer->startSetup();
        /*Drop table if it exists*/
        $installer->getConnection()->dropTable($installer->getTable('feature_product'));
        /*new table*/
        $table = $installer->getConnection()->newTable(
            $installer->getTable('feature_product')
        )->addColumn(
            'feature_id', Table::TYPE_INTEGER, null,
            ['identity'=>true,'primary'=>true,'nullable'=>false,'unsigned'=>true],
            'Feature Id'
        )->addColumn(
            'type_product', Table::TYPE_SMALLINT, null,
            ['nullable'=>false,'default'=>1],
            'Feature Product Type'
        )->addColumn(
            'product_ids', Table::TYPE_TEXT, null,
            ['nullable'=>true],
            'Product Ids'
        )->addColumn(
            'name', Table::TYPE_TEXT, null,
            ['nullable'=>false, 'default' => ''],
            'Name'
        )->addColumn(
            'visible_title', Table::TYPE_SMALLINT, null,
            ['nullable'=>true, 'default' => 1],
            'Visible Title'
        )->addColumn(
            'visible_product_name', Table::TYPE_SMALLINT, null,
            ['nullable'=>true, 'default' => 1],
            'Visible Product Name'
        )->addColumn(
            'visible_product_price', Table::TYPE_SMALLINT, null,
            ['nullable'=>true, 'default' => 1],
            'Visible Product Price'
        )->addColumn(
            'visible_product_review', Table::TYPE_SMALLINT, null,
            ['nullable'=>true, 'default' => 1],
            'Visible Product Review'
        )->addColumn(
            'visible_add_to_cart', Table::TYPE_SMALLINT, null,
            ['nullable'=>true, 'default' => 1],
            'Visible Add To Cart'
        )->addColumn(
            'type', Table::TYPE_TEXT, null,
            ['nullable'=>false],
            'Type'
        )->addColumn(
            'slide_auto_play', Table::TYPE_SMALLINT, null,
            ['nullable'=>true, 'default'=>1],
            'Slide Auto Play'
        )->addColumn(
            'slide_hover_pause', Table::TYPE_SMALLINT, null,
            ['nullable'=>true,'default'=>0],
            'Slide Hover Pause'
        )->addColumn(
            'slide_visible_nav', Table::TYPE_SMALLINT, null,
            ['nullable'=>true,'default'=>0],
            'Slide Visible Nav'
        )->addColumn(
            'slide_visible_dots', Table::TYPE_SMALLINT, null,
            ['nullable'=>true,'default'=>1],
            'Slide Visible Dots'
        )->addColumn(
            'time_slide', Table::TYPE_TEXT, null,
            ['nullable'=>false, 'default' => ''],
            'Time Slide'
        )->addColumn(
            'store_id', Table::TYPE_TEXT, null,
            ['nullable'=>false],
            'Store View'
        )->addColumn(
            'position', Table::TYPE_TEXT, null,
            ['nullable'=>false],
            'Position'
        )->addColumn(
            'category_ids', Table::TYPE_TEXT, null,
            ['nullable'=>true],
            'Feature Category Ids'
        )->addColumn(
            'time_start', Table::TYPE_DATETIME, null,
            ['nullable'=>true],
            'Time Start'
        )->addColumn(
            'time_end', Table::TYPE_DATETIME, null,
            ['nullable'=>true],
            'Time End'
        )->addColumn(
            'qty_product', Table::TYPE_INTEGER, null,
            ['nullable'=>true],
            'Qty Product'
        )->addColumn(
            'qty_product_in_row', Table::TYPE_INTEGER, null,
            ['nullable'=>false, 'default'=>5],
            'Qty Product In Row'
        )->addColumn(
            'status', Table::TYPE_SMALLINT, null,
            ['nullable'=>false, 'default' => 1],
            'Status'
        )->addColumn(
            'created_at', Table::TYPE_DATETIME, null,
            ['nullable' => true],
            'Created At'
        )->addColumn(
            'updated_at', Table::TYPE_DATETIME, null,
            ['nullable' => true],
            'Updated At'
        );
        $installer->getConnection()->createTable($table);
        $installer->endSetup();
    }
}
