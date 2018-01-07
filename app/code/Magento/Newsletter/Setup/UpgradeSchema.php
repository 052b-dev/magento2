<?php
namespace Magento\Newsletter\Setup;


use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;
/**
 * Upgrade the Newsletter module DB scheme
 */
class UpgradeSchema implements  UpgradeSchemaInterface
{

    /**
     * Upgrades DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '2.0.1', '<')) {
            $connection = $setup->getConnection();

            $connection->addIndex(
                $setup->getTable('newsletter_subscriber'),
                $setup->getIdxName('newsletter_subscriber', ['subscriber_email']),
                ['subscriber_email']
            );
        }

        $setup->endSetup();
    }
}