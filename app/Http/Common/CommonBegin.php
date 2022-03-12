<?php

namespace App\Http\Common;

class CommonBegin
{
    /**
     * DB取得した参照型配列を値型配列に変換する
     */
    public function changePostNameRowData($rowData) {
        if (empty($rowData)) return null;

        $row = array();
        foreach ($rowData as $key => $value) {
            $row[$key] = $value;
        }
        return $row;
    }

    /**
     * DB取得した２次元参照型配列を値型配列に変換する
     */
    public function changePostNameListData($listData) {
        if (empty($listData)) return null;

        $list = array();
        foreach ($listData as $key => $value) {
            $list[$key] = $this->changePostNameRowData($value);
        }
        return $list;
    }
}
