<?php

class EA_Cache extends CI_Output
{
    public function display_cache()
    {
        $CFG = $GLOBALS['CFG'];
        if (isset($_COOKIE)) {
            if (isset($_COOKIE['otoparcasan_session'])) { //session ı okuyo
                $session_location = '/var/cpanel/php/sessions/ea-php73' . '/' . 'otoparcasan_session' . $_COOKIE['otoparcasan_session'];
                $session_data = $this->sessionRead($session_location);
                if ($session_data) {
                    if ($session_data && strpos($session_data, 'userInfo') !== false) {
                        return false;
                    }
                }
            } elseif (isset($_COOKIE['selectedCar'])) { //bildiğin cookie okuma olayı
                $remember_me_encoded = $_COOKIE['selectedCar'];
                if ($remember_me_encoded) {
                    return false;
                }
            }
        }

        $URI = $GLOBALS['URI'];

        $cache_path = ($CFG->item('cache_path') === '') ? APPPATH . 'cache/' : $CFG->item('cache_path');

        // Build the file path. The file name is an MD5 hash of the full URI
        $uri = $CFG->item('base_url') . $CFG->item('index_page') . $URI->uri_string;

        if (($cache_query_string = $CFG->item('cache_query_string')) && !empty($_SERVER['QUERY_STRING'])) {
            if (is_array($cache_query_string)) {
                $uri .= '?' . http_build_query(array_intersect_key($_GET,
                        array_flip($cache_query_string)));
            } else {
                $uri .= '?' . $_SERVER['QUERY_STRING'];
            }
        }

        $filepath = $cache_path . md5($uri);

        if (!file_exists($filepath) OR !$fp = @fopen($filepath, 'rb')) {
            return false;
        }

        flock($fp, LOCK_SH);

        $cache = (filesize($filepath) > 0) ? fread($fp, filesize($filepath)) : '';

        flock($fp, LOCK_UN);
        fclose($fp);

        // Look for embedded serialized file info.
        if (!preg_match('/^(.*)ENDCI--->/', $cache, $match)) {
            return false;
        }

        $cache_info = unserialize($match[1]);
        $expire = $cache_info['expire'];

        $last_modified = filemtime($filepath);

        // Has the file expired?
        if ($_SERVER['REQUEST_TIME'] >= $expire && is_really_writable($cache_path)) {
            // If so we'll delete it.
            @unlink($filepath);
            log_message('debug', 'Cache file has expired. File deleted.');
            return false;
        }

        // Send the HTTP cache control headers
        $this->set_cache_header($last_modified, $expire);

        // Add headers from cache file.
        foreach ($cache_info['headers'] as $header) {
            $this->set_header($header[0], $header[1]);
        }

        // Display the cache
        $this->_display(self::substr($cache, self::strlen($match[0])));
        log_message('debug', 'Cache file is current. Sending it to browser.');

        die();
    }

    private function sessionRead($file_path)
    {
        if (!file_exists($file_path)) {
            return null;
        }
        $file_handle = fopen($file_path, 'rb');
        if (!$file_handle) {
            return null;
        } elseif ($file_handle === false) {
            return null;
        } else {
            rewind($file_handle);
        }

        $session_data = '';
        for ($read = 0, $length = filesize($file_path); $read < $length; $read += self::strlen($buffer)) {
            if (($buffer = fread($file_handle, $length - $read)) === false) {
                break;
            }

            $session_data .= $buffer;
        }

        return $session_data;
        
    }
}