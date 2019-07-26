<?php
/**
 * Created by Dh106
 * User: DH
 * Email: 206989662@qq.com
 * Date: 2019/7/26
 * Time: 8:53
 */

namespace ninenight\Json;


use ninenight\Json\Exceptions\InvalidArgumentException;

class Json
{
    protected $array;

    protected $josn = '';

    public function __construct($data)
    {
        if(is_string($data)) {
            $this->array = json_decode($data, true);
        } elseif(is_array($data)) {
            $this->array = $data;
        } else {
            throw new InvalidArgumentException('The input parameter is given an array or json string');
        }
    }

    private function _format_protect(&$val)
    {
        if ($val !== true && $val !== false && $val !== null) {
            $val = urlencode($val);
        }
    }

    private function _encode()
    {
        $this->josn = json_encode($this->array);
        return $this->josn;
    }

    private function _url_decode()
    {
        $this->josn = urldecode($this->josn);
        return  $this->josn;
    }

    public function jsonFormat()
    {
        array_walk_recursive($this->array, [$this, '_format_protect']);
        $this->_encode();
        $this->_url_decode();

        $ret = '';
        $pos = 0;
        $length = strlen($this->josn);
        $indent = isset($indent) ? $indent : '    ';
        $newline = "\n";
        $prevchar = '';
        $outofquotes = true;

        for ($i = 0; $i <= $length; $i++) {

            $char = substr($this->josn, $i, 1);

            if ($char == '"' && $prevchar != '\\') {
                $outofquotes = !$outofquotes;
            } elseif (($char == '}' || $char == ']') && $outofquotes) {
                $ret .= $newline;
                $pos--;
                for ($j = 0; $j < $pos; $j++) {
                    $ret .= $indent;
                }
            }

            $ret .= $char;

            if (($char == ',' || $char == '{' || $char == '[') && $outofquotes) {
                $ret .= $newline;
                if ($char == '{' || $char == '[') {
                    $pos++;
                }

                for ($j = 0; $j < $pos; $j++) {
                    $ret .= $indent;
                }
            }

            $prevchar = $char;
        }

        return $ret;
    }
}
