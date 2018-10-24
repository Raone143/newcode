<?php
class AccessDataBaseClass {

    /**
     * Function to select the data from table
     *
     * Parameters are Table name, Array of fields, Where condition,
     *
     */

    function get_information($table_name, $fields = "", $where = "", $start = "", $rec_limit = "") {

        if($start == "") $start = 0;
        if($rec_limit == "") $rec_limit = 30;

        if($fields == "") $fields = array("*");
        if($where  == "") $where  = " WHERE 1 ";


        $limit = " LIMIT $start, $rec_limit";

        $sel_information = 'SELECT ' . implode(",", $fields) . ' FROM ' . $table_name . $where . $limit;
        $res_information = mysql_query($sel_information);

        while($rows = mysql_fetch_assoc($res_information)){
            $table_data[] = $rows;
        }

        return $table_data;
    }

    function get_table_information($table_name) {

        $sel_table_information = "SHOW COLUMNS FROM ".$table_name;
        $res_table_information = mysql_query($sel_table_information);

        while($rows = mysql_fetch_assoc($res_table_information)) {
            $table_information[] = $rows;
        }

        return $table_information;
    }

    function get_all_tables_in_database() {

        $get_all_tables = "SHOW TABLES";
        $res_all_tables = mysql_query($get_all_tables);

        while($rows = mysql_fetch_row($res_all_tables)) {
            $tables_list[] = $rows[0];
        }
        return $tables_list;
    }

    function pagination($start,$limit,$total,$filePath,$otherParams)
    {
        $totalPages = ceil($total/$limit);

        $currentPage = floor($start/$limit) + 1;

        $pagination = "";

        if ($totalPages>10)
        {
            $maxPages = ($totalPages>9) ? 9 : $totalPages;

            if ($currentPage >= 1 && $currentPage <= $totalPages) {
                $pagination .= ($currentPage>4) ? " ... " : " ";

                $minPages = ($currentPage>4) ? $currentPage : 5;
                $maxPages = ($currentPage<$totalPages-4) ? $currentPage : $totalPages - 4;


                for($i=$minPages-4; $i<$maxPages+5; $i++) {
                    $pagination .= ($i == $currentPage) ? "<a href=\"".$filePath."?start=".(($i-1)*$limit).$otherParams."\" class='sicpagenumber'>".$i."</a>" : "<a href=\"".$filePath."?start=".(($i-1)*$limit).$otherParams."\" class='sipagenumber'>".$i."</a>";
                }
                $pagination .= ($currentPage<$totalPages-4) ? " ... " : " ";
            }
            else {

                $pagination .= " ... ";
            }
        }
        else {
            for($i=1; $i<$totalPages+1; $i++) {
                $pagination .= ($i==$currentPage) ? "<a href=\"".$filePath."?start=".(($i-1)*$limit).$otherParams."\" class='sicpagenumber'>".$i."</a>" : "<a href=\"".$filePath."?start=".(($i-1)*$limit).$otherParams."\" class='sipagenumber'>".$i."</a> ";
            }
        }

        if ($currentPage > 1)
            $previous = "<a href=\"".$filePath."?start=".(($currentPage-2)*$limit).$otherParams."\" class='sipagenumber'>Previous</a>";

        if ($currentPage < $totalPages)
            $next = "<a href=\"".$filePath."?start=".($currentPage*$limit).$otherParams."\" class='sipagenumber'>Next</a>";


        echo $previous.$pagination.$next;
    }
}