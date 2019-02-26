<?php


use Phinx\Migration\AbstractMigration;

class TaskListMigration extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('task_list');
        $table
            ->addColumn('task_name', 'string')
            ->addColumn('task_text', 'string')
            ->addColumn('task_img', 'string')
            ->addColumn('user_id', 'integer')
            ->addColumn('is_complete', 'boolean')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->create();
    }
}
