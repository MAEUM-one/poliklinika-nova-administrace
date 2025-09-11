<?php

namespace App\Database;

use Illuminate\Database\Connectors\MySqlConnector;

class OldMySqlConnector extends MySqlConnector {
    public function connect(array $config)
    {
        $connection = parent::connect($config);

        // 👇 Zkusíme donutit MySQL, aby použilo starý typ hesla
        $connection->exec("SET old_passwords=1");

        return $connection;
    }
}
