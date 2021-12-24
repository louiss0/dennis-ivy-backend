<?php

declare(strict_types=1);


namespace Src\Utils\Classes;


use Illuminate\Database\Eloquent\Builder;


const OPEN_CLOSE_BRACKETS_PATTERN = "/(\[|\])/";
const REPLACE_BRACKETS_AND_COMMA_PATTERN = "/^\[(\D+)(,)(\S+|d+)\]$/";

const PAGE = "page";
const LIMIT = "limit";
const SORT = "sort";
const FIELDS = "fields";

const ONE = 1;

const ONE_HUNDRED = 100;

final  class ApiFeatures
{


    protected $operators = [
        '=',
        '<',
        '>',
        '<=',
        '>=',
        '<>',
        '!=',
        'like',
        'like binary',
        'not like',
        'between',
        'ilike',
        '&',
        '|',
        '^',
        '<<',
        '>>',
        'rlike',
        'regexp',
        'not regexp',
        '~',
        '~*',
        '!~',
        '!~*',
        'similar to',
        'not similar to',
    ];


    private  $excluded_fields = [PAGE, LIMIT, SORT, FIELDS];

    public function __construct(

        private Builder  $query,
        private array $query_associative_array,

    ) {
    }



    public function getQuery()
    {
        # code...

        return $this->query;
    }


    public function filter(): self
    {
        # code...

        $queryParameters = array_merge([], $this->query_associative_array);

        $unset_query_parameters = function ($value) use (&$queryParameters) {

            unset($queryParameters[$value]);
        };

        $query = $this->query;

        $manipulate_query = function ($value, $key) use ($query) {


            $array = null;

            $string_looks_like_a_two_index_array = preg_match(
                pattern: REPLACE_BRACKETS_AND_COMMA_PATTERN,
                subject: $value
            );

            if ($string_looks_like_a_two_index_array) {
                # code...
                $array = $this->turnBracketStringToArray($value);
            }


            list($operator, $data) = $array;

            $operators_are_valid = $this->checkForOperators($operator);


            if ($operators_are_valid) {
                # code...

                $query = $query->where($key, $operator, $data);
                return;
            }


            $query = $query->where($key, "=", $value);
        };



        array_walk(
            callback: $unset_query_parameters,
            array: $this->excluded_fields
        );


        array_walk(
            callback: $manipulate_query,
            array: $queryParameters
        );

        return $this;
    }


    private   function checkForOperators(?string $operator)
    {

        if (!$operator) {
            # code...

            return false;
        }

        $check_if_operator_is_in_operators = in_array(
            needle: $operator,
            haystack: $this->operators,
            strict: true
        );

        return $check_if_operator_is_in_operators;
    }


    private  function turnBracketStringToArray(string $value)
    {
        # code...

        $new_string = preg_replace(
            replacement: "",
            subject: $value,
            pattern: OPEN_CLOSE_BRACKETS_PATTERN,
        );



        $create_array_from_new_string = explode(
            ",",
            string: $new_string
        );

        return $create_array_from_new_string;
    }

    public function sort(): self
    {
        # code...

        $query = $this->query;



        if (!array_key_exists(SORT, $this->query_associative_array)) {
            # code...

            $query = $query->orderBy("created_at", "desc");

            return $this;
        }


        $create_sorting_values_from_comma_separated_strings =
            explode(",", $this->query_associative_array[SORT]);


        array_walk(
            callback: fn ($value) =>
            $query = $query->orderBy($value, "desc"),
            array: $create_sorting_values_from_comma_separated_strings,
        );



        return $this;
    }


    public function limit(): self
    {
        # code...

        $query = $this->query;




        if (array_key_exists(FIELDS, $this->query_associative_array)) {
            # code...

            $create_field_values_from_comma_separated_strings =

                explode(",", $this->query_associative_array[FIELDS]);


            $query = $query->select(...$create_field_values_from_comma_separated_strings);
        }



        return $this;
    }

    public function paginate(): self
    {
        # code...

        $query = $this->query;

        $query_array = $this->query_associative_array;

        $page_key_exists = array_key_exists(PAGE, $query_array);

        $limit_key_exists = array_key_exists(LIMIT, $query_array);


        $page = ONE;
        $limit = ONE_HUNDRED;

        if ($page_key_exists && $limit_key_exists) {

            list(PAGE => $page, LIMIT => $limit) = $query_array;
            # code...

            $page = intval($page);

            $limit = intval($limit);
        }

        $skip = ($page - 1) * $limit;



        $query = $query->skip($skip)->take($limit);


        return $this;
    }
}
