<?php

namespace App\Api;

use App\Api\Posh;

class main
{

    /**
     * 创建服务对象
     * @param String $serveioc 服务对象
     * @param String $floor 服务层
     * @param array $Classres 传递服务对象数据
     * @param array $Methodres 传递服务方法数据
     * @return null
     */
    public static function servioc(string $serveioc, string $floor, array $Classres, array $Methodres)
    {


        if ($serveioc == '') {
            Posh::Poshs(
                array(
                    's' => false,
                    'm' => 'No server'
                )
            );
        }

        // 解析服务对象
        $servs = explode('.', $serveioc);

        if (!isset($servs[0]) || !isset($servs[1])) {
            Posh::Poshs(
                array(
                    's' => false,
                    'm' => 'serveioc lack'
                )
            );
        }

        // 服务路径
        $servef = $_SERVER['DOCUMENT_ROOT'] . '/src/' . $floor . '/' . $servs[0] . '.php';

        if (!is_file($servef)) {
            Posh::Poshs(
                array(
                    's' => false,
                    'm' => '404 server ' . $floor . '\\' . $servs[0]
                )
            );
        }


        // 引入服务
        if (!isset($GLOBALS['SERVER_OBJECT'][$floor][$servs[0]])) {
            include $servef;
        }


        if (!method_exists("\App\Api\\" . $floor . "\\" . $servs[0], $servs[1])) {
            Posh::Poshs(
                array(
                    's' => false,
                    'm' => '404 servers ' . $floor . '\\' . $servs[0] . '\\' . $servs[1]
                )
            );
        }


        // Done
        $ClassresName = "\App\Api\\" . $floor . "\\" . $servs[0];
        if (!isset($GLOBALS['SERVER_OBJECT'][$floor][$servs[0]])) {
            $GLOBALS['SERVER_OBJECT'][$floor][$servs[0]] = new $ClassresName($Classres);
        }
        $MethodName = $servs[1];
        return $GLOBALS['SERVER_OBJECT'][$floor][$servs[0]]->$MethodName($Methodres);


    }


    /**
     * 操作数据库
     * @param String $sql
     * @return void
     */
    public static function databases(string $sql, $batch = false)
    {

        $callerInfo = debug_backtrace()[1];
        if(isset($callerInfo['class']) && isset($callerInfo['function'])) {
            $callerClass = $callerInfo['class'];
            $callerFunction = $callerInfo['function'];
        } else {
            $callerClass = 'null';
            $callerFunction = 'null';
        }

        if (!$GLOBALS['databases']) {
            Posh::Poshs(
                array(
                    's' => false,
                    'm' => 'databases No'
                )
            );
        }

        if (!isset($sql)) {
            Posh::Poshs(
                array(
                    's' => false,
                    'm' => 'databases sql null'
                )
            );
        }

        if ($batch) {
            $return = mysqli_multi_query($GLOBALS['databases'], $sql);
        } else {
            $return = $GLOBALS['databases']->query($sql);
        }

        if (!$return) {
            Posh::Poshs(
                array(
                    's' => false,
                    'm' => 'databases sql error: ' . $callerClass . '\\' . $callerFunction
                )
            );
        }


        return $return;


    }

    /**
     * 数据库操作 取数据
     * one（单数据）row（所有数据）
     */
    public static function basesdata_get($type, $return)
    {
        if ($type == 'one') {
            return mysqli_fetch_array($return);
        } elseif ($type == 'row') {
            $datas = mysqli_num_rows($return);
            for ($x = 0; $x < $datas; $x++) {
                $data[$x] = mysqli_fetch_array($return);
            }
            if (isset($data)) {
                return $data;
            } else {
                return null;
            }
        } else {
            Posh::Poshs(
                array(
                    's' => false,
                    'm' => 'basesdata get no'
                )
            );
        }

    }


    public static function error(int $vid)
    {

        if (!isset($GLOBALS['error_func'])) {

            include $_SERVER['DOCUMENT_ROOT'] . '/src/error.php';

            $GLOBALS['error_func'] = $error_func;

        }

        $error_sdm = $GLOBALS['error_func'][$vid] ?? array(
            's' => false,
            'm' => 'Errors FALSE'
        );

        Posh::Poshs(
            $error_sdm
        );

    }

    // 获取服务标识
    public static function get_serves(){

        return (Posh::Poshg(array('s')))['s'];

    }

}
