<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\VarDumper\VarDumper;

function stdToArray($input): array
{
    return json_decode(json_encode($input), 1);
}

function tmr(?float $time = null, $precision = 2): string
{
    $time ??= $_SERVER['REQUEST_TIME_FLOAT'];

    return 'time = ' . number_format(microtime(true) - $time, $precision) . ' sec.';
}

function flatten(array $array, string $parentKey = null)
{
    $return = [];

    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $key = $parentKey ? "$parentKey|$key" : $key;
            $return += flatten($value, $key);
        } else {
            $return += ["$parentKey|$key" => $value];
        }
    }

    return $return;
}

if (!function_exists('df')) {
    #[NoReturn] function df(...$vars): void
    {
        $file = str_replace(base_path(), '', debug_backtrace()[0]['file']);
        $line = debug_backtrace()[0]['line'];

        VarDumper::dump("$file:$line");

        foreach ($vars as $v) {
            VarDumper::dump($v);
        }

        exit(1);
    }
}

if (!function_exists('array_group_by')) {
    /**
     * Groups an array by a given key.
     *
     * Groups an array into arrays by a given key, or set of keys, shared between all array members.
     *
     * Based on {@author Jake Zatecky}'s {@link https://github.com/jakezatecky/array_group_by array_group_by()} function.
     * This variant allows $key to be closures.
     *
     * @param array $array The array to have grouping performed on.
     * @param mixed $key,... The key to group or split by. Can be a _string_,
     *                       an _integer_, a _float_, or a _callable_.
     *
     *                       If the key is a callback, it must return
     *                       a valid key from the array.
     *
     *                       If the key is _NULL_, the iterated element is skipped.
     *
     *                       ```
     *                       string|int callback ( mixed $item )
     *                       ```
     *
     * @return array|null Returns a multidimensional array or `null` if `$key` is invalid.
     */
    function array_group_by(array $array, $key)
    {
        if (!is_string($key) && !is_int($key) && !is_float($key) && !is_callable($key)) {
            trigger_error('array_group_by(): The key should be a string, an integer, or a callback', E_USER_ERROR);

            return null;
        }

        $func = (!is_string($key) && is_callable($key) ? $key : null);
        $_key = $key;

        // Load the new array, splitting by the target key
        $grouped = [];
        foreach ($array as $value) {
            $key = null;

            if (is_callable($func)) {
                $key = call_user_func($func, $value);
            } elseif (is_object($value) && property_exists($value, $_key)) {
                $key = $value->{$_key};
            } elseif (isset($value[$_key])) {
                $key = $value[$_key];
            }

            if ($key === null) {
                continue;
            }

            $grouped[$key][] = $value;
        }

        // Recursively build a nested grouping if more parameters are supplied
        // Each grouped array value is grouped according to the next sequential key
        if (func_num_args() > 2) {
            $args = func_get_args();

            foreach ($grouped as $key => $value) {
                $params = array_merge([$value], array_slice($args, 2, func_num_args()));
                $grouped[$key] = call_user_func_array('array_group_by', $params);
            }
        }

        return $grouped;
    }
}

if (!function_exists('utf_ucfirst')) {
    function utf_ucfirst(string $str): string
    {
        return mb_strtoupper(substr($str, 0, 2), "utf-8") . substr($str, 2);
    }
}

if (!function_exists('truncate')) {
    function truncate($number, $precision = 0)
    {
        // warning: precision is limited by the size of the int type
        $shift = pow(10, $precision);

        return intval($number * $shift) / $shift;
    }
}

if (!function_exists('getNonExistedInDbValues')) {
    function getNonExistedInDbValues(array $values, string $table, string $column = 'id'): array
    {
        if (!$values) {
            return [];
        }

        $firstItem = array_shift($values);
        $unionValues = "$firstItem AS val"; //$union = "SELECT 1 AS i UNION SELECT 2 UNION SELECT 3 UNION SELECT 16 UNION SELECT 7";

        foreach ($values as $nextValue) {
            $unionValues .= " UNION SELECT $nextValue";
        }

        $nonExistedInDbTeamsIds = DB::select("SELECT val FROM
                                    (SELECT $unionValues) AS values_table
                                    LEFT JOIN $table
                                    ON $table.$column = val
                                    WHERE $table.$column IS NULL");

        $nonExistedInDbTeamsIds = stdToArray($nonExistedInDbTeamsIds);
        $nonExistedInDbTeamsIds = Arr::flatten($nonExistedInDbTeamsIds);
        $nonExistedInDbTeamsIds = array_unique($nonExistedInDbTeamsIds);

        return $nonExistedInDbTeamsIds;

    }
}

if (!function_exists('isJoined')) {
    function isJoined($query, $table): bool
    {
        $joins = collect($query->joins);

        return $joins->pluck('table')->contains($table);
    }
}

if (!function_exists('flat_parents')) {
    function flat_parents($model)
    {
        $result = [];
        if ($model->parent) {
            $result[] = $model->parent;
            $result = array_merge($result, flat_parents($model->parent));
        }
        return $result;
    }
}

if (!function_exists('flat_children')) {
    function flat_children($model)
    {
        $result = [];
        foreach ($model->children as $child) {
            $result[] = $child;
            if ($child->children) {
                $result = array_merge($result, flat_children($child));
            }
        }
        return $result;
    }
}


if (!function_exists('slug')) {
    function slug(string $str, $separator = '-'): string
    {
        return Str::slug($str, $separator, 'ru');
    }
}

if (!function_exists('isJson')) {
    function isJson($string)
    {
        if (!is_string($string)) {
            return false;
        }

        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
}

if (!function_exists('clearDbTable')) {
    function clearDbTable(string $tableName)
    {
        switch (DB::getDriverName()) {
            case 'mysql':
                DB::statement('SET FOREIGN_KEY_CHECKS=0');
                break;
            case 'sqlite':
                DB::statement('PRAGMA foreign_keys = OFF');
                break;
        }

        DB::table($tableName)->truncate();

        //Schema::disableForeignKeyConstraints();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        // Schema::enableForeignKeyConstraints();
    }

    if (!function_exists('getNextModelId')) {
        function getNextTableId(string $table)
        {
            $statement = DB::select("show table status like '$table'");

            return $statement[0]->Auto_increment;
        }
    }

}
