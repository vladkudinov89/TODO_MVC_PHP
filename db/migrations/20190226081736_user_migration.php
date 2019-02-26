<?php


use Phinx\Migration\AbstractMigration;

class UserMigration extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('users');
        $table
            ->addColumn('username', 'string')
            ->addColumn('email', 'string')
            ->addColumn('password', 'string')
            ->addColumn('is_admin', 'boolean')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->addIndex(['username','email'], ['unique' => true])
            ->create();
    }
}
