<?php
# namespace App\Database\Migrations;
namespace Amol\ReactiveCi4\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateActivity extends Migration
{
    protected $DBGroup = 'default';

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'          =>'INT',
                'constraint'    =>'11',
                'auto_increment'=>true        
            ],
            'label'=> [
                'type'          =>'VARCHAR',
                'constraint'    =>'255'
            ],
            'activity'=> [
                'type'          =>'TEXT'
            ],
            'subject'=> [
                'type'          =>'INT',
                'constraint'    =>'11'
            ],
            'subject_modal'=> [
                'type'          =>'VARCHAR',
                'constraint'    =>'255'
            ],
            'causer'=> [
                'type'          =>'INT',
                'constraint'    =>'11',
                'null'          =>true
            ],
            'causer_modal'=> [
                'type'          =>'VARCHAR',
                'constraint'    =>'255',
                'null'          =>true
            ],
            'properties'=> [
                'type'          =>'TEXT',
                'null'          =>true
            ],
            'created_at datetime default current_timestamp',
            'updated_at' => [
                'type'          =>'datetime',
                'null'          =>true
            ],
            'deleted_at' => [
                'type'          =>'datetime',
                'null'          =>true
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('activities', true);
    }
    
    public function down()
    {
        $reactiveConfig = config("Reactive");
        $this->forge->dropTable('activities');
    }
}
