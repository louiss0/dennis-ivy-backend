<?php


/* Global Helper Functions */

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
/*
 * asset
 * redirect
 * collect
 * factory
 * env
 * base_path
 * types_path
 * config_path
 * resources_path
 * public_path
 * routes_path
 * storage_path
 * app_path
 * class_basename
 * data_get
 * data_set
 */



if (!function_exists("factory")) {
    # code...

    function factory(string $model, $count = 1)
    {
        # code...

        $factory = new Factory;

        return $factory(
            $model,
            $count
        );
    }
}


if (!function_exists('asset')) {
    function asset($path)
    {
        return env('APP_URL') . "/{$path}";
    }
}

if (!function_exists('collect')) {
    function collect($items)
    {
        return new Collection($items);
    }
}

if (!function_exists('env')) {

    function env($key, $default = false)
    {
        $value = getenv($key);


        throw_unless(
            !$value and !$default,
            RuntimeException::class,
            "{$key} is not a defined .env variable and has not default value"
        );

        return $value or $default;
    }
}


if (!function_exists('base_path')) {
    function base_path($path = '')
    {

        return  __DIR__ . "/../{$path}";
    }
}


if (!function_exists('database_path')) {
    function database_path($path = '')
    {
        return base_path("database/{$path}");
    }
}


if (!function_exists('config_path')) {

    function config_path($path = '')
    {

        return base_path("config/{$path}");
    }
}


if (!function_exists('storage_path')) {

    function storage_path($path = '')
    {
        return base_path("storage/{$path}");
    }
}

if (!function_exists('public_path')) {
    function public_path($path = '')
    {
        return base_path("public/{$path}");
    }
}


if (!function_exists('resources_path')) {
    function resources_path($path = '')
    {
        return base_path("resources/{$path}");
    }
}

if (!function_exists('routes_path')) {
    function routes_path($path = '')
    {
        return base_path("routes/{$path}");
    }
}

if (!function_exists('app_path')) {
    function app_path($path = '')
    {

        return base_path("app/{$path}");
    }
}


if (!function_exists("utils_path")) {


    function utils_path($path = "")
    {
        # code...

        return base_path("utils/{$path}");
    }
}

if (!function_exists("types_path")) {


    function types_path($path = "")
    {
        # code...

        return base_path("types/{$path}");
    }
}



if (!function_exists('clear_directory')) {
    function clear_directory(string $directory)
    {
        # code...

        $directory = new DirectoryIterator(
            $directory
        );

        foreach ($directory as $file) {

            if (!$file->isDot()) {
                # code...
                unlink($file->getPathname());
            }
        }
    } # code...
}


if (!function_exists('class_basename')) {
    function class_basename($class)
    {
        $class = is_object($class) ? get_class($class) : $class;

        return basename(str_replace('\\', '/', $class));
    }
}

if (!function_exists("types_path")) {
    # code...



    function types_path($path = "")
    {
        # code...

        return base_path("/types/{$path}");
    }
}


if (!function_exists('data_get')) {
    /**
     * Get an item from an array or object using "dot" notation.
     *
     * @param  mixed  $target
     * @param  string|array|int|null  $key
     * @param  mixed  $default
     * @return mixed
     */
    function data_get($target, $key, $default = null)
    {
        if (is_null($key)) {
            return $target;
        }

        $key = is_array($key) ? $key : explode('.', $key);

        while (!is_null($segment = array_shift($key))) {
            if ($segment === '*') {
                if ($target instanceof Collection) {
                    $target = $target->all();
                } elseif (!is_array($target)) {
                    return value($default);
                }

                $result = [];

                foreach ($target as $item) {
                    $result[] = data_get($item, $key);
                }

                return in_array('*', $key) ? Arr::collapse($result) : $result;
            }

            if (Arr::accessible($target) && Arr::exists($target, $segment)) {
                $target = $target[$segment];
            } elseif (is_object($target) && isset($target->{$segment})) {
                $target = $target->{$segment};
            } else {
                return value($default);
            }
        }

        return $target;
    }
}

if (!function_exists('data_set')) {
    /**
     * Set an item on an array or object using dot notation.
     *
     * @param  mixed  $target
     * @param  string|array  $key
     * @param  mixed  $value
     * @param  bool  $overwrite
     * @return mixed
     */
    function data_set(&$target, $key, $value, $overwrite = true)
    {
        $segments = is_array($key) ? $key : explode('.', $key);

        if (($segment = array_shift($segments)) === '*') {
            if (!Arr::accessible($target)) {
                $target = [];
            }

            if ($segments) {
                foreach ($target as &$inner) {
                    data_set($inner, $segments, $value, $overwrite);
                }
            } elseif ($overwrite) {
                foreach ($target as &$inner) {
                    $inner = $value;
                }
            }
        } elseif (Arr::accessible($target)) {
            if ($segments) {
                if (!Arr::exists($target, $segment)) {
                    $target[$segment] = [];
                }

                data_set($target[$segment], $segments, $value, $overwrite);
            } elseif ($overwrite || !Arr::exists($target, $segment)) {
                $target[$segment] = $value;
            }
        } elseif (is_object($target)) {
            if ($segments) {
                if (!isset($target->{$segment})) {
                    $target->{$segment} = [];
                }

                data_set($target->{$segment}, $segments, $value, $overwrite);
            } elseif ($overwrite || !isset($target->{$segment})) {
                $target->{$segment} = $value;
            }
        } else {
            $target = [];

            if ($segments) {
                data_set($target[$segment], $segments, $value, $overwrite);
            } elseif ($overwrite) {
                $target[$segment] = $value;
            }
        }

        return $target;
    }
}
