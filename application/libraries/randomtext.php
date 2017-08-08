<?php

class RandomText
{
    const RANDOM_ALL = 0;
    const RANDOM_ALPHA = 1;
    const RANDOM_ALPHA_EXTRA = 2;
    const RANDOM_ALPHA_LOWER = 3;
    const RANDOM_ALPHA_UPPER = 4;
    const RANDOM_ALPHA_NUMERIC = 5;
    const RANDOM_ALPHA_NUMERIC_LOWER = 6;
    const RANDOM_ALPHA_NUMERIC_UPPER = 7;
    const RANDOM_ALPHA_NUMERIC_LOWER_EXTRA = 8;
    const RANDOM_ALPHA_NUMERIC_UPPER_EXTRA = 9;
    const RANDOM_NUMERIC = 10;
    const RANDOM_NUMERIC_EXTRA = 11;

    public function random($random = 6, $type = self::RANDOM_ALL)
    {
        $string = '';
        $char = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxtz1234567890-_';
        switch ($type) {
            case self::RANDOM_ALL:
                $char = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxtz1234567890-_';
                break;
            case self::RANDOM_ALPHA;
                $char = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxtz';
                break;
            case self::RANDOM_ALPHA_EXTRA:
                $char = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxtz-_';
                break;
            case self::RANDOM_ALPHA_LOWER:
                $char = 'abcdefghijklmnopqrstuvwxtz';
                break;
            case self::RANDOM_ALPHA_UPPER:
                $char = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case self::RANDOM_ALPHA_NUMERIC:
                $char = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxtz1234567890';
                break;
            case self::RANDOM_ALPHA_NUMERIC_LOWER:
                $char = 'abcdefghijklmnopqrstuvwxtz1234567890';
                break;
            case self::RANDOM_ALPHA_NUMERIC_UPPER:
                $char = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                break;
            case self::RANDOM_ALPHA_NUMERIC_LOWER_EXTRA:
                $char = 'abcdefghijklmnopqrstuvwxtz1234567890-_';
                break;
            case self::RANDOM_ALPHA_NUMERIC_UPPER_EXTRA:
                $char = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890-_';
                break;
            case self::RANDOM_NUMERIC:
                $char = '1234567890';
                break;
            case self::RANDOM_NUMERIC_EXTRA:
                $char = '1234567890-_';
                break;
            default:
                $char = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxtz1234567890-_';
                break;
        }
        $length = strlen($char);
        for ($i = 0; $i < $random; ++$i) {
            $random_pick = mt_rand(1, $length);
            $random_char = $char[$random_pick - 1];
            $string .= $random_char;
        }

        return $string;
    }
}
