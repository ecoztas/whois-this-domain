<?php

require('./config.variables.php');

if (!function_exists('search')) {
    /**
     * Search more than one extension
     * @param  string $name       
     * @param  array  $extensions 
     * @return array
     * @example search('emrecanoztas', array('com', 'net'));
     */
    function search(string $name, array $extensions): array
    {
        $domain = '';
        $address = '';
        $output = '';
        $info = array();

        foreach ($extensions as $extension) {
            if (array_key_exists($extension, EXTENSION_LIST)) {
                $address = EXTENSION_LIST[$extension];
                $domain = $name . '.' . $extension;

                array_push($info, whois($domain, $address));
            }
        }

        return($info);
    }
}

if (!function_exists('whois')) {
    /**
     * Getting information about domain.
     * @param  string $domain
     * @param  string $address 
     * @return array
     *
     * @example  whois('emrecanoztas.com', 'whois.crsnic.net')
     */
    function whois(string $domain, string $address): array
    {
        $output = '';
        $info = array();
        $connection = fsockopen($address, PORT, $errno, $errmessage, TIMEOUT);

        if (!$connection) {
            echo('Connection failed! ' . 'Error no: ' . $errno . ' Error message: ' . $errmessage);
            exit();
        } else {
            ($connection) ? fputs($connection, $domain . "\r\n") : $connection = null;

            if (!is_null($connection)) {
                while (!feof($connection)) $output .= fgets($connection);

                $info['domain'] = $domain;
                !(strstr($output, 'No match for')) ? $info['status'] = 0 : $info['status'] = 1;
                !(strstr($output, 'No match for')) ? $info['description'] = 'Not available' : $info['description'] = 'Available';
                $info['whois'] = $output;

            } else {
                trigger_error('$connection variable is null!');
                exit();
            }
        }
        fclose($connection);

        return($info);
    }
}
