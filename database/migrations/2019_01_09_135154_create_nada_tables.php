<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNadaTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('nada.database.connection') ?: config('database.default');

        /** 管理员列表 */
        Schema::connection($connection)->create(config('nada.database.users_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('avatar')->default('');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        /** 角色列表 */
        Schema::connection($connection)->create(config('nada.database.roles_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        /** 权限列表 */
        Schema::connection($connection)->create(config('nada.database.permissions_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('path');
            $table->unsignedTinyInteger('mod')->default(3);
            $table->timestamps();
        });

        /** 角色权限绑定表 */
        Schema::connection($connection)->create(config('nada.database.role_permissions_table'), function (Blueprint $table) {
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('permission_id');
            $table->index(['role_id', 'permission_id']);

            $table->foreign('role_id')
                ->references('id')
                ->on(config('nada.database.roles_table'))
                ->onDelete('cascade');

            $table->foreign('permission_id')
                ->references('id')
                ->on(config('nada.database.permissions_table'))
                ->onDelete('cascade');
        });

        /** 管理员角色绑定表 */
        Schema::connection($connection)->create(config('nada.database.user_roles_table'), function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('role_id');
            $table->index(['user_id', 'role_id']);

            $table->foreign('user_id')
                ->references('id')
                ->on(config('nada.database.users_table'))
                ->onDelete('cascade');

            $table->foreign('role_id')
                ->references('id')
                ->on(config('nada.database.roles_table'))
                ->onDelete('cascade');
        });

        /** 后台菜单表 */
        Schema::connection($connection)->create(config('nada.database.menus_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->string('path');
            $table->tinyInteger('sort')->default(0);
            $table->unsignedInteger('parent_id')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $connection = config('admin.database.connection') ?: config('database.default');
        Schema::connection($connection)->dropIfExists(config('admin.database.users_table'));
        Schema::connection($connection)->dropIfExists(config('admin.database.roles_table'));
        Schema::connection($connection)->dropIfExists(config('admin.database.permissions_table'));
        Schema::connection($connection)->dropIfExists(config('admin.database.role_permissions_table'));
        Schema::connection($connection)->dropIfExists(config('admin.database.user_roles_table'));
        Schema::connection($connection)->dropIfExists(config('admin.database.menus_table'));
        Schema::connection($connection)->dropIfExists(config('admin.database.role_menus_table'));
    }
}
