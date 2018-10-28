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
        $curl = null;
        $output = '';
        $info = array();

        if (!function_exists('curl_version')) {
            trigger_error('cURL is not found!');
        } else {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $address);
            curl_setopt($curl, CURLOPT_PORT, PORT);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_TIMEOUT, TIMEOUT);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $domain . "\r\n");
            $output = curl_exec($curl);
            curl_close($curl);

            $info['domain'] = $domain;
            !(strstr($output, 'No match for')) ? $info['status'] = 0 : $info['status'] = 1;
            !(strstr($output, 'No match for')) ? $info['description'] = 'Not available' : $info['description'] = 'Available';
            $info['whois'] = $output;
        }

        return($info);
    }
}
