<?php

declare(strict_types=1);

use Cake\Database\Driver\Mysql;
use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

final class OrdersMigration extends AbstractMigration
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

        $table = $this->table("orders");


        $table
            ->addColumn(
                "payment_method",
                MysqlAdapter::PHINX_TYPE_STRING,
                ["limit" => MysqlAdapter::TEXT_SMALL]
            )
            ->addColumn(
                "is_price",
                MysqlAdapter::PHINX_TYPE_BOOLEAN
            )
            ->addColumn(
                "is_paid",
                MysqlAdapter::PHINX_TYPE_BOOLEAN
            )
            ->addColumn(
                "is_delivered",
                MysqlAdapter::PHINX_TYPE_BOOLEAN
            )
            ->addColumn(
                "shipping_price",
                MysqlAdapter::PHINX_TYPE_INTEGER
            )
            ->addColumn(
                "total_price",
                MysqlAdapter::PHINX_TYPE_INTEGER
            )
            ->addColumn(
                "paid_at",
                MysqlAdapter::PHINX_TYPE_TIMESTAMP,
            )
            ->addColumn(
                "delivered_at",
                MysqlAdapter::PHINX_TYPE_TIMESTAMP,
            )
            ->addColumn(
                "user",
                MysqlAdapter::PHINX_TYPE_INTEGER,
            )
            ->addForeignKey(
                "user",
                "users",
                options: [
                    "delete" => "CASCADE",
                ]
            )
            ->addTimestamps()
            ->create();


        // TODO: REMEMBER  to but the code below at the shipping address table 
        // $table
        //     ->addColumn(
        //         "address",
        //         MysqlAdapter::PHINX_TYPE_STRING
        //     )
        //     ->addColumn(
        //         "city",
        //         MysqlAdapter::PHINX_TYPE_STRING
        //     )
        //     ->addColumn(
        //         "country",
        //         MysqlAdapter::PHINX_TYPE_STRING
        //     )
        //     ->addColumn(
        //         "postal_code",
        //         MysqlAdapter::PHINX_TYPE_STRING
        //     )
        //     ->addColumn(
        //         "shipping_price",
        //         MysqlAdapter::PHINX_TYPE_DECIMAL,
        //         ["precision" => 5, "scale" => 2]
        //     );
    }
}
