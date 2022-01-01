<?php

declare(strict_types=1);

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

final class ProductsMigration extends AbstractMigration
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

        $table = $this->table("products");

        $table
            ->addColumn(
                "name",
                MysqlAdapter::PHINX_TYPE_STRING,
                ["limit" => MysqlAdapter::TEXT_SMALL]

            )
            ->addColumn(
                "description",
                MysqlAdapter::PHINX_TYPE_TEXT,
                ["limit" => MysqlAdapter::TEXT_LONG]
            )
            ->addColumn(
                "brand",
                MysqlAdapter::PHINX_TYPE_STRING,
                ["limit" => MysqlAdapter::TEXT_SMALL]
            )
            ->addColumn(
                "category",
                MysqlAdapter::PHINX_TYPE_STRING,
                ["limit" => MysqlAdapter::TEXT_SMALL]
            )
            ->addColumn(
                "rating",
                MysqlAdapter::PHINX_TYPE_DECIMAL,
                ["precision" => 2, "scale" => 1]
            )
            ->addColumn(
                "count_in_stock",
                MysqlAdapter::PHINX_TYPE_INTEGER,
                ["limit" => MysqlAdapter::INT_MEDIUM]
            )
            ->addColumn(
                "price",
                MysqlAdapter::PHINX_TYPE_DECIMAL,
                ["precision" => 5, "scale" => 2]
            )
            ->addColumn(
                "image",
                MysqlAdapter::PHINX_TYPE_VARBINARY,

            )->addColumn("user", MysqlAdapter::PHINX_TYPE_INTEGER, ["null" => true])
            ->addForeignKey("user", "users", options: ["delete" => "SET_NULL"])
            ->addColumn(
                "num_reviews",
                MysqlAdapter::PHINX_TYPE_INTEGER,
                ["limit" => MysqlAdapter::INT_TINY]
            )
            ->addTimestamps()
            ->create();
    }
}
