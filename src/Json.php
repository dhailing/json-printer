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

    protected $rejosn = '';

    public function __construct($data)
    {
        if(!is_array($data)) {
            throw new InvalidArgumentException('The instantiated arguments should be arrays');
        }

        $this->array = $data;

        array_walk_recursive($this->array, '_format_protect');

        $this->array = $this->_encode();
        $this->array = $this->_url_encode();
    }

    public function _format_protect(&$val)
    {
        if ($val !== true && $val !== false && $val !== null) {
            $val = urlencode($val);
        }
    }

    public function _encode()
    {
        return json_encode($this->array);
    }

    public function _url_encode()
    {
        return urlencode($this->array);
    }

    public function jsonFormat()
    {
        $ret = '';
        $pos = 0;
        $length = strlen($this->array);
        $indent = isset($indent) ? $indent : '    ';
        $newline = "\n";
        $prevchar = '';
        $outofquotes = true;

        for ($i = 0; $i <= $length; $i++) {

            $char = substr($this->array, $i, 1);

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

        $this->rejosn = $ret;

        return $this->rejosn;
    }
}
