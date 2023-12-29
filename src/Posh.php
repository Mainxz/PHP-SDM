<?php

namespace App\Api;

class Posh
{

    /**
     * 推送客户端
     * json 数据
     */
    public static function Poshs(array $res)
    {

        if (!isset($res) || $res == null) {

            $res = array(
                's' => false,
                'msg' => 'null'
            );

        }


        $hres = array(

            'state' => $res['s'] ? 1 : 0,
            'data' => $res['d'] ?? '',
            'msg' => $res['m'] ?? ''

        );


        echo json_encode($hres);

        exit();


    }


    /**
     * 推送服务端
     * Post json array数据
     */
    public static function Posht(array $res): array
    {

        $receive = file_get_contents("php://input");

        $receive_data = json_decode($receive, true);

        if ($res == null) {
            Posh::Poshs(
                array(
                    's' => false,
                    'm' => 'error posht res null'
                )
            );
        }

        $ress = count($res);
        for ($i = 0; $i < $ress; $i++) {
            if (!isset($receive_data[$res[$i]])) {
                Posh::Poshs(
                    array(
                        's' => false,
                        'm' => 'lack ' . $res[$i]
                    )
                );
            } else {
                $res_data[$res[$i]] = $receive_data[$res[$i]];
            }

        }

        return $res_data;


    }


    /**
     * 推送服务端
     * Get array数据
     */
    public static function Poshg(array $res): array
    {

        $ress = count($res);
        $res_data = array();
        for ($i = 0; $i < $ress; $i++) {
            if (!isset($_GET[$res[$i]])) {
                Posh::Poshs(
                    array(
                        's' => false,
                        'm' => 'lacks ' . $res[$i]
                    )
                );
            } else {
                $res_data[$res[$i]] = $_GET[$res[$i]];
            }

        }

        return $res_data;

    }


}