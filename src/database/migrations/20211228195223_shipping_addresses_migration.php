<?php

declare(strict_types=1);

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

final class ShippingAddressesMigration extends AbstractMigration
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

        $table = $this->table("shipping-addresses");

        $table
            ->addColumn(
                "address",
                MysqlAdapter::PHINX_TYPE_STRING
            )
            ->addColumn(
                "city",
                MysqlAdapter::PHINX_TYPE_STRING
            )
            ->addColumn(
                "postal_code",
                MysqlAdapter::PHINX_TYPE_STRING
            )
            ->addColumn(
                "country",
                MysqlAdapter::PHINX_TYPE_STRING
            )
            ->addColumn(
                "shipping_price",
                MysqlAdapter::PHINX_TYPE_DECIMAL,
                ["precision" => 7, "scale" => 2]
            )
            ->addColumn(
                "order",
                MysqlAdapter::PHINX_TYPE_INTEGER
            )
            ->addForeignKey("order", "orders", options: ["delete" => "CASCADE"])
            ->addTimestamps()
            ->create();
    }
}
