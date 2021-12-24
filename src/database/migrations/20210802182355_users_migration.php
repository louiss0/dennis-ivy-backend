<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

final class UsersMigration extends AbstractMigration
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
     * 
     * Column Options [
     *    "limit"=> string set maximum length for strings, also hints column types in adapters (see note below)
     * 
     *    "default"=> string, set default value or action
     * 
     *    "null"=> boolean, allow NULL values, defaults to false (should not be used with primary keys!) (see note below)
     * 
     *     "comment"=> string, specify the column that a new column should be placed after, or use \Phinx\Db\Adapter\MysqlAdapter::FIRST to place the column at the start of the table (only applies to MySQL)
     * 
     *    "after" => string set a text comment on the column
     *                ]
     * 
     */
    public function change(): void
    {

        $table = $this->table("users");


        $table
            ->addColumn("name", "string", ["limit" => 255])
            ->addColumn("email", "string", ["limit" => 255])
            ->addColumn("password", "string",)
            ->addColumn("role", "enum", ["values" => "role,admin"])
            ->addColumn(
                "reset_token",
                "text",
                [
                    "limit" => MysqlAdapter::TEXT_MEDIUM,
                    "null" => true,
                    "default" => null
                ]
            )
            ->addColumn(
                "password_reset_expires",
                "datetime",
                ["null" => true, "default" => null,]
            )
            ->addColumn(
                "photo",
                "string",
                ["null" => true, "default" => null]
            )
            ->addTimestamps()
            ->addIndex("email", ["unique" => true])
            ->create();
    }
}
