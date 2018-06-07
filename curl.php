<?php

/**
 * @author v3ch4j
 * @copyright 2013
 */

class curl
{
    private $options;
    public $errno;
    public $errmsg;
    public $content;
    public $headers;
    public $httpcode;

    public function __construct()
    {
        global $config;
        $this->options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_AUTOREFERER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_COOKIEFILE => COOKIE_FILE,
            CURLOPT_COOKIEJAR => COOKIE_FILE);
    }

    public function setopt($key, $val)
    {
        eval('$opt = CURLOPT_' . strtoupper($key) . ';');
        $this->options[$opt] = $val;
    }

    public function removeopt($key)
    {
        switch (strtolower($key))
        {
            case 'post':
                unset($this->options[CURLOPT_POST]);
                unset($this->options[CURLOPT_POSTFIELDS]);
                break;
            case 'sock5':
                unset($this->options[CURLOPT_HTTPPROXYTUNNEL]);
                unset($this->options[CURLOPT_PROXY]);
                unset($this->options[CURLOPT_PROXYTYPE]);
                break;
            default:
                eval('$opt = CURLOPT_' . strtoupper($key) . ';');
                unset($this->options[$opt]);
        }
    }

    public function sock5($sock)
    {
        $this->options[CURLOPT_HTTPPROXYTUNNEL] = true;
        $this->options[CURLOPT_PROXY] = $sock;
        $this->options[CURLOPT_PROXYTYPE] = CURLPROXY_SOCKS5;
    }

    public function ref($ref)
    {
        $this->options[CURLOPT_REFERER] = $ref;
    }

    public function httpheader($headers)
    {
        $this->options[CURLOPT_HTTPHEADER] = $headers;
    }

    public function cookies($cookies)
    {
        $this->options[CURLOPT_COOKIE] = $cookies;
        $this->removeopt('cookiefile');
        $this->removeopt('cookiejar');
    }

    public function header($val = false)
    {
        $this->options[CURLOPT_HEADER] = $val;
    }
    public function follow($b = true)
    {
        $this->options[CURLOPT_FOLLOWLOCATION] = $b;
    }

    public function nobody($val = false)
    {
        $this->options[CURLOPT_NOBODY] = $val;
    }

    public function ua($ua)
    {
        $this->options[CURLOPT_USERAGENT] = $ua;
    }

    public function postdata($postdata)
    {
        if (is_array($postdata))
        {
            $post_array = array();
            foreach ($postdata as $key => $value)
            {
                $post_array[] = urlencode($key) . '=' . urlencode($value);
            }
            $post_string = implode('&', $post_array);
        } else
        {
            $post_string = $postdata;
        }
        $this->options[CURLOPT_POST] = true;
        $this->options[CURLOPT_POSTFIELDS] = $post_string;
    }

    public function page($url)
    {
        $ch = curl_init($url);
        curl_setopt_array($ch, $this->options);
        $this->content = curl_exec($ch);
        $this->errno = curl_errno($ch);
        $this->errmsg = curl_error($ch);
        $this->headers = curl_getinfo($ch);
        $this->httpcode = $this->headers['http_code'];
        curl_close($ch);
        $this->removeopt('post');
    }

    public function removeCookies()
    {
        $f = fopen($this->options[CURLOPT_COOKIEFILE], 'w');
        fclose($f);
    }

    public function unlink()
    {
        if (file_exists($this->options[CURLOPT_COOKIEFILE]))
            unlink($this->options[CURLOPT_COOKIEFILE]);
    }

    public function validate()
    {
        if ($this->errno)
        {
            return false;
        }
        if ($this->httpcode && in_array($this->httpcode, array(
                403,
                400,
                401,
                500,
                501,
                502,
                503,
                504)))
            return false;
        return true;
    }

    public function getStr($find_start = '', $find_end = '')
    {
        if ($find_start == '')
        {
            return '';
        }
        $start = strpos($this->content, $find_start);
        if ($start === false)
        {
            return '';
        }
        $length = strlen($find_start);
        $substr = substr($this->content, $start + $length);
        if ($find_end == '')
        {
            return $substr;
        }
        $end = strpos($substr, $find_end);
        if ($end === false)
        {
            return $substr;
        }
        return substr($substr, 0, $end);
    }

    public function has($str, $type = 1)
    {
        $bool = $type == 1 ? stripos($this->content, $str) : strpos($this->content, $str);
        return $bool !== false;
    }

    public function json_decode($toArray = true)
    {
        return json_decode($this->content, $toArray);
    }

    public function count($str)
    {
        return substr_count($this->content, $str);
    }

    public function getPlainText($from, $to = '', $allowHTML = false)
    {
        $raw = $this->getStr($from, $to);
        if($allowHTML){
            return trim($raw);
        }
        return trim(strip_tags($raw));
    }

    public function display($d = 0)
    {
        echo $this->content;
        if ($d)
        {
            exit;
        }
    }
}
