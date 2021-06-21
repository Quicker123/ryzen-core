<?php


namespace ryzen\ryzen\func;

use ryzen\ryzen\Application;

/**
 * @author razoo.choudhary@gmail.com
 * Class BaseFunctions
 * @package ryzen\ryzen\func
 */
class BaseFunctions
{
    /**
     * BaseFunctions constructor.
     */

    public function __construct(array $config)
    {
        $this->algorithm = $config['algorithm'];
        $this->iv        = $config['iv'];
        $this->asset     = $config['asset'];
    }

    public function Ry_Get_IP(){

        if (!empty($_SERVER['HTTP_X_FORWARDED']) && validate_ip($_SERVER['HTTP_X_FORWARDED'])) {
            return $_SERVER['HTTP_X_FORWARDED'];
        }

        if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
            return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        }

        if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && validate_ip($_SERVER['HTTP_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_FORWARDED_FOR'];
        }

        if (!empty($_SERVER['HTTP_FORWARDED']) && validate_ip($_SERVER['HTTP_FORWARDED'])) {
            return $_SERVER['HTTP_FORWARDED'];
        }

        return $_SERVER['REMOTE_ADDR'];
    }

    public function Ry_Get_Browaer(){

        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version = "";

        if (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        } elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        } elseif (preg_match('/iphone|IPhone/i', $u_agent)) {
            $platform = 'IPhone Web';
        } elseif (preg_match('/android|Android/i', $u_agent)) {
            $platform = 'Android Web';
        } else if (preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $u_agent)) {
            $platform = 'Mobile';
        } else if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        }

        if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        } elseif (preg_match('/Firefox/i', $u_agent)) {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        } elseif (preg_match('/Chrome/i', $u_agent)) {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        } elseif (preg_match('/Safari/i', $u_agent)) {
            $bname = 'Apple Safari';
            $ub = "Safari";
        } elseif (preg_match('/Opera/i', $u_agent)) {
            $bname = 'Opera';
            $ub = "Opera";
        } elseif (preg_match('/Netscape/i', $u_agent)) {
            $bname = 'Netscape';
            $ub = "Netscape";
        }
        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }
        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
                $version = $matches['version'][0];
            } else {
                $version = $matches['version'][1];
            }
        } else {
            $version = $matches['version'][0];
        }
        // check if we have a number
        if ($version == null || $version == "") {$version = "?";}
        return array(
            'userAgent' => $u_agent,
            'name' => $bname,
            'version' => $version,
            'platform' => $platform,
            'pattern' => $pattern,
            'ip_address' => $this->Ry_Get_IP(),
        );
    }

    public function Ry_Encrypt($ClearTextData = '')
    {
        $ENCRYPTION_ALGORITHM   = $this->algorithm;
        $ENCRYPTION_IVKEYAL     = $this->iv;
        $ENCRYPTION_KEYASSET    = $this->asset;
        return base64_encode(openssl_encrypt($ClearTextData, $ENCRYPTION_ALGORITHM, $ENCRYPTION_KEYASSET, 0, $ENCRYPTION_IVKEYAL));
    }

    public function Ry_Dcrypt($CipherData = '')
    {
        $ENCRYPTION_ALGORITHM   = $this->algorithm;
        $ENCRYPTION_IVKEYAL     = $this->iv;
        $ENCRYPTION_KEYASSET    = $this->asset;
        return openssl_decrypt(base64_decode($CipherData), $ENCRYPTION_ALGORITHM, $ENCRYPTION_KEYASSET, 0, $ENCRYPTION_IVKEYAL);
    }

}