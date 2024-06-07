<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //parent menu table
        if (!Schema::hasTable('ms_parent_menus')) {
            Schema::create('ms_parent_menus', function (Blueprint $table) {
                $table->id();
                $table->string('label', 30)->nullable(false);
                $table->string('alias', 30)->nullable(false);
                $table->string('icon', 100)->nullable(true);
                $table->tinyInteger('order')->nullable(false)->default(0);
                $table->tinyInteger('is_active')->nullable(false)->default(1);
            });
        }

        //menu table
        if (!Schema::hasTable('ms_menus')) {
            Schema::create('ms_menus', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('parent_menu_id')->nullable(false);
                $table->string('label', 30)->nullable(false);
                $table->string('alias', 30)->nullable(false);
                $table->string('url', 100)->nullable(false);
                $table->tinyInteger('order')->nullable(false)->default(0);
                $table->tinyInteger('is_active')->nullable(false)->default(1);
            });
        }

        //privilege table
        if (!Schema::hasTable('ms_privileges')) {
            Schema::create('ms_privileges', function (Blueprint $table) {
                $table->id();
                $table->string('code', 4)->nullable(false);
                $table->bigInteger('menu_id')->nullable(false);
                $table->tinyInteger('modules')->nullable(false);
                $table->string('desc', 100)->nullable(false);
                $table->boolean('is_active')->nullable(false)->default(true);
            });
        }

        //user table
        if(!Schema::hasTable('ms_accounts')) {
            Schema::create('ms_accounts', function (Blueprint $table) {
                $table->id();
                $table->string('first_name', 50)->nullable(false);
                $table->string('last_name', 50)->nullable(true);
                $table->string('email', 50)->nullable(true);
                $table->string('username', 50)->nullable(false);
                $table->text('password')->nullable(false);
                $table->string('hash', 32)->nullable(false);
                $table->boolean('is_new')->nullable(false)->default(true);
                $table->boolean('is_active')->nullable(false)->default(true);
                $table->boolean('is_trash')->nullable(false)->default(false);
                $table->boolean('is_login')->nullable(false)->default(false);
                $table->boolean('is_locked')->nullable(false)->default(false);
                $table->boolean('is_author')->nullable(false)->default(false);
                $table->tinyInteger('login_attempt')->nullable(false)->default(0);
                $table->string('password_request', 32)->nullable(true);
                $table->timestamp('last_password_request')->nullable(true);
                $table->timestamp('expire_password_request')->nullable(true);
                $table->timestamp('last_login')->nullable(true);
                $table->bigInteger('created_by')->nullable(false);
                $table->bigInteger('updated_by')->nullable(false);
                $table->bigInteger('privilege_group_id')->nullable(false);
                $table->rememberToken();
                $table->timestamps();
            });
        }
        
        //privilege group table
        if (!Schema::hasTable('ms_privilege_groups')) {
            Schema::create('ms_privilege_groups', function (Blueprint $table) {
                $table->id();
                $table->string('name', 20)->nullable(false);
                $table->string('description', 100)->nullable(true);
                $table->bigInteger('created_by')->nullable(false);
                $table->bigInteger('updated_by')->nullable(false);
                $table->timestamps();
            });
        }
        
        //privilege map table
        if (!Schema::hasTable('map_privileges')) {
            Schema::create('map_privileges', function (Blueprint $table) {
                $table->bigInteger('privilege_group_id')->nullable(false);
                $table->bigInteger('privilege_id')->nullable(false);
            });
        }

        //user log table
        if (!Schema::hasTable('log_accounts')) {
            Schema::create('log_accounts', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('account_id')->nullable(false);
                $table->bigInteger('privilege_id')->nullable(false);
                $table->string('description', 100)->nullable(false);
                $table->string('ip_address', 30)->nullable(false);
                $table->string('log_request', 50)->nullable(false);
                $table->string('log_response', 50)->nullable(false);
                $table->string('agent')->nullable(false);
                $table->timestamps();
            });
        }

        //mail log table
        if (!Schema::hasTable('log_mails')) {
            Schema::create('log_mails', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('account_id')->nullable(false);
                $table->string('target', 100)->nullable(false);
                $table->string('subject', 100)->nullable(false);
                $table->string('log_response', 50)->nullable(false);
                $table->timestamps();
            });
        }

        //api log table
        if (!Schema::hasTable('log_api')) {
            Schema::create('log_api', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('privilege_id')->nullable(false);
                $table->string('description', 100)->nullable(false);
                $table->string('ip_address', 30)->nullable(false);
                $table->string('log_request', 50)->nullable(false);
                $table->string('log_response', 50)->nullable(false);
                $table->timestamps();
            });
        }

        //general setting table
        if (!Schema::hasTable('ms_general')) {
            Schema::create('ms_general', function (Blueprint $table) {
                $table->string('key_id', 40)->nullable(false);
                $table->longText('value')->nullable(false);
                $table->primary('key_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ms_parent_menus');
        Schema::dropIfExists('ms_menus');
        Schema::dropIfExists('ms_privileges');
        Schema::dropIfExists('ms_accounts');
        Schema::dropIfExists('ms_privilege_groups');
        Schema::dropIfExists('ms_general');
        Schema::dropIfExists('map_privileges');
        Schema::dropIfExists('log_accounts');
        Schema::dropIfExists('log_mails');
        Schema::dropIfExists('log_api');
    }
};
