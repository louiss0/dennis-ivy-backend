<?php

declare(strict_types=1);

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

final class OrderItemsMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {

        $table = $this->table("order-items");

        $table
            ->addColumn(
                "name",
                MysqlAdapter::PHINX_TYPE_STRING
            )->addColumn(
                "image",
                MysqlAdapter::PHINX_TYPE_VARBINARY
            )->addColumn(
                "price",
                MysqlAdapter::PHINX_TYPE_DECIMAL
            )->addColumn(
                "quantity",
                MysqlAdapter::PHINX_TYPE_INTEGER
            )->addColumn(
                "order",
                MysqlAdapter::PHINX_TYPE_INTEGER,
                ["null" => true]
            )->addForeignKey(
                "order",
                "orders",
                options: ["delete" => "CASCADE"]
            )->addColumn(
                "product",
                MysqlAdapter::PHINX_TYPE_INTEGER,
                ["null" => true]
            )
            ->addForeignKey(
                "product",
                "products",
                options: ["delete" => "CASCADE"]
            )
            ->addTimestamps()
            ->create();
    }
}
