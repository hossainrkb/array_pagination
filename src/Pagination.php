<?php

class Pagination
{
    public function __construct()
    {
    }

 
    public $ar = [
        0 => [
            "name" => "Rakib1",
            "id" => "C151045",
            "email" => "rakib@gmial.ocm",
        ],
        1 => [
            "name" => "Rakib2",
            "id" => "C151045",
            "email" => "rakib@gmial.ocm",
        ],
        2 => [
            "name" => "Rakib3",
            "id" => "C151045",
            "email" => "rakib@gmial.ocm",
        ],
        3 => [
            "name" => "Rakib4",
            "id" => "C151045",
            "email" => "rakib@gmial.ocm",
        ],
        4 => [
            "name" => "Rakib5",
            "id" => "C151045",
            "email" => "rakib@gmial.ocm",
        ],
        5 => [
            "name" => "Rakib6",
            "id" => "C151045",
            "email" => "rakib@gmial.ocm",
        ],
        6 => [
            "name" => "Rakib7",
            "id" => "C151045",
            "email" => "rakib@gmial.ocm",
        ],
        7=> [
            "name" => "Rakib8",
            "id" => "C151045",
            "email" => "rakib@gmial.ocm",
        ],
        8=> [
            "name" => "Rakib9",
            "id" => "C151045",
            "email" => "rakib@gmial.ocm",
        ],
        9=> [
            "name" => "Rakib10",
            "id" => "C151045",
            "email" => "rakib@gmial.ocm",
        ],
        10=> [
            "name" => "Rakib11",
            "id" => "C151045",
            "email" => "rakib@gmial.ocm",
        ],
    ];
    public function paginator($array_k = null, $per_page, $query_string_name = null)
    {
        $array_length = $this->array_length($this->ar);
        $total_page = $this->total_page($array_length, $per_page);
        $last_page_url =  $this->last_page_url($query_string_name, $total_page);

        if (isset($_SERVER['QUERY_STRING'])) {
            $query_string_check = $this->find_query_string();
            $final_query_string_key_page = explode("+XX+", $query_string_check)[0];
            $final_query_string_value_page_number = explode("+XX+", $query_string_check)[1];
            $from = (($final_query_string_value_page_number * $per_page) - $per_page) + 1;
            $to = ($from + $per_page) - 1;
            $data =  $this->create_pagination_array($this->ar, $from, $to);
              return json_encode($data);
            return   json_encode([
                'link' => [
                    "first_page_url" => $_SERVER['PHP_SELF'] . "?page=" . 1,
                    "from" => $from,
                    "last_page" => $total_page,
                    "last_page_url" => $last_page_url,
                    // "next_page_url" => $next_page > $total_page ? null : "http://localhost/complete_api_tutorial/public/api/product?page=$next_page",
                    "path" => $_SERVER['PHP_SELF'],
                    "per_page" => $per_page,
                    // "prev_page_url" => $request->get('page') == 1 ? null : "http://localhost/complete_api_tutorial/public/api/product?page=$prev_page",
                    "to" => $to,
                    "total" => $array_length,
                ],
            ]);
            // echo json_encode(explode("+XX+",$query_string_check)[1]);
        } else {
            echo "dd";
        }
    }

    public function create_pagination_array($arr, $from, $to)
    {
        $final_array = [];
        for ($arr_i = $from - 1; $arr_i < $to; $arr_i++) {
            if(isset($arr[$arr_i])){
                array_push($final_array, array_merge(['pagi'=>$arr_i+1],$arr[$arr_i]));
            }
        }
        return $final_array;
    }
    public function last_page_url($query_string_name, $query_string_value)
    {
        // return json_encode($_SERVER);
        return $_SERVER['PHP_SELF'] . "?page=" . $query_string_value;
    }

    public function array_length($in_array)
    {
        return count($in_array);
    }
    public function total_page($array_length, $per_page)
    {
        return ceil(abs($array_length / $per_page));
    }

    public function find_query_string($check_key = null)
    {
        $initial_data =  explode("&", $_SERVER['QUERY_STRING']);
        $check_array = [];
        for ($i = 0; $i < count($initial_data); $i++) {
            $each_qury_string = explode("=", $initial_data[$i]);
            if (isset($each_qury_string[1]) && isset($each_qury_string[1])) {
                array_push($check_array, [
                    $each_qury_string[0] => $each_qury_string[1],
                ]);
            }
        }
        for ($j = 0; $j < count($check_array); $j++) {
            foreach ($check_array[$j] as $key => $value) {
                if (($key) == "page") {
                    return $key . "+XX+" . $value;
                } else {
                    continue;
                }
            }

            // array_push($array_key_in,array_keys($check_array[$j]));
        }
        // return array_merge($array_key_in);
    }
}

$obj = new Pagination();
echo $obj->paginator("", 3);
