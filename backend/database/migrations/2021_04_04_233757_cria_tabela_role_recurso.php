<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriaTabelaRoleRecurso extends Migration {

    private $tabela = 'role_recurso';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {      
        if (!Schema::hasTable($this->tabela)) {
            $tableNames = config('permission.table_names');
            
            if (empty($tableNames)) {
                throw new Exception('Error: config/permission.php not loaded. Run [php artisan config:clear] and try again.');
            }

            Schema::create($this->tabela, function (Blueprint $table) use ($tableNames) {
                $table->id();
                $table->unsignedBigInteger('id_role');
                $table->unsignedBigInteger('id_recurso');
                $table->timestamps();

                $table->foreign('id_role')
                        ->references('id')
                        ->on($tableNames['roles'])
                        ->onDelete('cascade');
                
                $table->foreign('id_recurso')
                        ->references('id')
                        ->on('recurso')
                        ->onDelete('cascade');
                
                $table->unique(['id_role', 'id_recurso']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists($this->tabela);
    }

}
