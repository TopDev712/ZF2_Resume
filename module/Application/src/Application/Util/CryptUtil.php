<?php
namespace Application\Util;

class CryptUtil
{

    const CIPHER = MCRYPT_RIJNDAEL_256;
    const CIPHER_MODE = MCRYPT_MODE_CFB;

    const KEY = 'asAd2454551244dioi23OIOasnaspPwmcn';

    public static function encrypt($value, $key = self::KEY)
    {
        $value = base64_encode($value);
        $store = mcrypt_encrypt(self::CIPHER, $key, $value, self::CIPHER_MODE, $iv = self::getIV());
        return sprintf('%s|%s', base64_encode($iv), base64_encode($store));
    }

    private static function getIV()
    {
        $size = mcrypt_get_iv_size(self::CIPHER, self::CIPHER_MODE);
        return mcrypt_create_iv($size, MCRYPT_RAND);
    }

    public static function decrypt($value, $key = self::KEY)
    {
        if (!strpos($value, '|')) {
            return false;
        }

        list($iv, $data) = explode('|', $value);
        $iv = base64_decode($iv);
        $data = base64_decode($data);

        $b64 = mcrypt_decrypt(self::CIPHER, $key, $data, self::CIPHER_MODE, $iv);
        $plain = base64_decode($b64);
        return rtrim($plain);
    }

    public static function onewayEncrypt($value)
    {
        return crypt($value, '$6$' . self::KEY);
    }

    public static function generateToken($len = 10, $alphaOnly = false)
    {
        $R = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        if (!$alphaOnly) {
            $R = $R . "!@#$%^&*(){}[]<>?";
        }
        $np = "";
        for ($i = 0; $i < $len; $i++) {
            $x = mt_rand(0, strlen($R));
            $np = $np . substr($R, $x, 1);
        }
        return $np;
    }

    public static function generateNumericToken($len = 10)
    {
        $R = "0123456789";
        $np = "";
        for ($i = 0; $i < $len; $i++) {
            $x = mt_rand(0, strlen($R));
            $np = $np . substr($R, $x, 1);
        }
        return $np;
    }

}