<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddDataIntegrityConstraints extends Migration
{
    public function up()
    {
        $this->removeInvalidRows();

        if (DB::getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE post_user DROP PRIMARY KEY');
            DB::statement('ALTER TABLE post_user MODIFY post_id BIGINT UNSIGNED NOT NULL, MODIFY user_id BIGINT UNSIGNED NOT NULL');
            DB::statement('ALTER TABLE post_user ADD PRIMARY KEY (post_id, user_id)');
        }

        Schema::table('job_applications', function (Blueprint $table) {
            $table->unique(['user_id', 'post_id']);
        });

        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        Schema::table('companies', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('company_category_id')->references('id')->on('company_categories')->restrictOnDelete();
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('companies')->cascadeOnDelete();
        });

        Schema::table('post_user', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });

        Schema::table('job_applications', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('post_id')->references('id')->on('posts')->cascadeOnDelete();
        });
    }

    public function down()
    {
        if (DB::getDriverName() !== 'sqlite') {
            Schema::table('job_applications', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropForeign(['post_id']);
            });

            Schema::table('post_user', function (Blueprint $table) {
                $table->dropForeign(['post_id']);
                $table->dropForeign(['user_id']);
            });

            Schema::table('posts', function (Blueprint $table) {
                $table->dropForeign(['company_id']);
            });

            Schema::table('companies', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropForeign(['company_category_id']);
            });
        }

        Schema::table('job_applications', function (Blueprint $table) {
            $table->dropUnique(['user_id', 'post_id']);
        });
    }

    protected function removeInvalidRows(): void
    {
        DB::table('post_user')->whereNotExists(function ($query) {
            $query->selectRaw(1)
                ->from('posts')
                ->whereColumn('posts.id', 'post_user.post_id');
        })->delete();

        DB::table('post_user')->whereNotExists(function ($query) {
            $query->selectRaw(1)
                ->from('users')
                ->whereColumn('users.id', 'post_user.user_id');
        })->delete();

        DB::table('job_applications')->whereNotExists(function ($query) {
            $query->selectRaw(1)
                ->from('users')
                ->whereColumn('users.id', 'job_applications.user_id');
        })->delete();

        DB::table('job_applications')->whereNotExists(function ($query) {
            $query->selectRaw(1)
                ->from('posts')
                ->whereColumn('posts.id', 'job_applications.post_id');
        })->delete();

        DB::table('posts')->whereNotExists(function ($query) {
            $query->selectRaw(1)
                ->from('companies')
                ->whereColumn('companies.id', 'posts.company_id');
        })->delete();

        DB::table('companies')->whereNotExists(function ($query) {
            $query->selectRaw(1)
                ->from('users')
                ->whereColumn('users.id', 'companies.user_id');
        })->delete();

        DB::table('companies')->whereNotExists(function ($query) {
            $query->selectRaw(1)
                ->from('company_categories')
                ->whereColumn('company_categories.id', 'companies.company_category_id');
        })->delete();

        $duplicateApplicationIds = DB::table('job_applications')
            ->selectRaw('MIN(id) as id')
            ->groupBy('user_id', 'post_id')
            ->pluck('id')
            ->all();

        if ($duplicateApplicationIds) {
            DB::table('job_applications')
                ->whereNotIn('id', $duplicateApplicationIds)
                ->delete();
        }
    }
}
