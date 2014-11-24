<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConvertNumberToWordsInThai
 *
 * @author krisada.thiangtham
 */
class ConvertNumberToWordsInThai {

//put your code here

    public function numtothaistring($num) {
        $return_str = "";
        $txtnum1 = array('', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า');
        $txtnum2 = array('', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน');
        $num_arr = str_split($num);
        $count = count($num_arr);
        foreach ($num_arr as $key => $val) {
            if ($count > 1 && $val == 1 && $key == ($count - 1))
                $return_str .= "เอ็ด";
            else
                $return_str .= $txtnum1[$val] . $txtnum2[$count - $key - 1];
        }
        return $return_str;
    }

    public function numtothai($num) {
        $return = "";
        $num = str_replace(",", "", $num);
        $number = explode(".", $num);
        if (sizeof($number) > 2) {
            return 'รูปแบบข้อมุลไม่ถูกต้อง';
            exit;
        }
        $return .= $this->numtothaistring($number[0]) . "บาท";
        $stang = intval($number[1]);
        if ($stang > 0)
            $return.= $this->numtothaistring($stang) . "สตางค์";
        else
            $return .= "ถ้วน";
        return $return;
    }

}
