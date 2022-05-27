<?php

namespace app\constants;
class SupplierConstant
{
    /**
     * 供应商状态
     */
    const T_STATUS_BLANK = '';
    const T_STATUS_OK = '1';
    const T_STATUS_HOLD = '2';
    static $tStatusArr = [
        0 => '',
        1 => 'OK',
        2 => 'HOLD'
    ];

    /**
     * 供应商ID 运算符
     */
    const ID_SYMBOL_EQ = 0;
    const ID_SYMBOL_GT = 1;
    const ID_SYMBOL_GTE = 2;
    const ID_SYMBOL_LT = 3;
    const ID_SYMBOL_LTE = 4;

    static $idSymbolArr = [
        0 => '=',
        1 => '>',
        2 => '>=',
        3 => '<',
        4 => '<=',
    ];
}