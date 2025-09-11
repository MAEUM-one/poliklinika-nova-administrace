<?php

namespace App\Providers;

use App\Database\OldMySqlConnector;
use Illuminate\Database\Connectors\ConnectionFactory;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\MySqlConnection;
use Illuminate\Support\ServiceProvider;

class DatabaseServiceProvider extends ServiceProvider {
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        /** @var DatabaseManager $db */
        $db = $this->app->make('db');

        $db->extend('mysql_old', function ($config, $name) {
            $connector = new OldMySqlConnector;
            $pdo = $connector->connect($config);

            return new MySqlConnection($pdo, $config['database'], $config['prefix'], $config);
        });
    }
}
