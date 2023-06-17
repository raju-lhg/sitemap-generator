<?php

namespace App\Services;

class DomainLookUp
{

    public static function get_dns_records($url){
        $url = self::filter_url(trim($url));

        if ($url && self::is_valid_url($url)) {
            $data = array();
            $value = $url;
            // Parse url to extract host
            $posted_domain = $value;
            $parsed_url = parse_url($posted_domain);

            if (array_key_exists('host', $parsed_url)) {
                $domain = $parsed_url['host'];
            } else {
                $domain = $posted_domain;
            }

            // get records
            $dns_a = dns_get_record($domain, DNS_A);
            if(!empty($dns_a)) {
                $dns_a_ttl = $dns_a[0]['ttl'];
                $dns_a_class = $dns_a[0]['class'];
                $data['a'] = [
                    'data' => $dns_a,
                    'ttl'  => $dns_a_ttl,
                    'class' => $dns_a_class
                ];
                $error = false;
            }
            $dns_ns = dns_get_record($domain, DNS_NS);
            if(!empty($dns_ns)) {
                $dns_ns_ttl = $dns_ns[0]['ttl'];
                $dns_ns_class = $dns_ns[0]['class'];
                $data['ns'] = [
                    'data' => $dns_ns,
                    'ttl'  => $dns_ns_ttl,
                    'class' => $dns_ns_class
                ];
                $error = false;
            }
            $dns_mx = dns_get_record($domain, DNS_MX);
            if(!empty($dns_mx)) {
                $dns_mx_ttl = $dns_mx[0]['ttl'];
                $dns_mx_class = $dns_mx[0]['class'];
                $data['mx'] = [
                    'data' => $dns_mx,
                    'ttl'  => $dns_mx_ttl,
                    'class' => $dns_mx_class
                ];
                $error = false;
            }
            $dns_soa = dns_get_record($domain, DNS_SOA);
            if(!empty($dns_soa)) {
                $dns_soa_ttl = $dns_soa[0]['ttl'];
                $dns_soa_class = $dns_soa[0]['class'];
                $dns_soa_email = explode(".", $dns_soa[0]['rname']);
                $dns_soa_email = $dns_soa_email[0] . '@' . $dns_soa_email[1] . '.' . $dns_soa_email[2];
                $dns_soa_serial = $dns_soa[0]['serial'];
                $dns_soa_refresh = $dns_soa[0]['refresh'];
                $dns_soa_retry = $dns_soa[0]['retry'];
                $dns_soa_expire = $dns_soa[0]['expire'];
                $dns_soa_minimum_ttl = $dns_soa[0]['minimum-ttl'];
                $data['soa'] = [
                    'data' => [
                        'email' => $dns_soa_email,
                        'serial' => $dns_soa_serial,
                        'refresh' => $dns_soa_refresh,
                        'retry' => $dns_soa_retry,
                        'expire' => $dns_soa_expire,
                        'minimum_ttl' => $dns_soa_minimum_ttl
                    ],
                    'ttl'  => $dns_soa_ttl,
                    'class' => $dns_soa_class
                ];
                $error = false;
            }

            $dns_txt = dns_get_record($domain, DNS_TXT);
            if(!empty($dns_txt)) {
                $dns_txt_ttl = $dns_txt[0]['ttl'];
                $dns_txt_class = $dns_txt[0]['class'];
                $data['txt'] = [
                    'data' => $dns_txt,
                    'ttl'  => $dns_txt_ttl,
                    'class' => $dns_txt_class
                ];
                $error = false;
            }

            $dns_aaaa = dns_get_record($domain, DNS_AAAA);
            if(!empty($dns_aaaa)) {
                $dns_aaaa_ttl = $dns_aaaa[0]['ttl'];
                $dns_aaaa_class = $dns_aaaa[0]['class'];
                $data['aaaa'] = [
                    'data' => $dns_aaaa,
                    'ttl'  => $dns_aaaa_ttl,
                    'class' => $dns_aaaa_class
                ];
                $error = false;
            }

            if(!$error) {
                $response = [
                    'type'    => 'success',
                    'message' => $data
                ];
            }
            else{
                return null;
            }


        }

        return json_encode($response);
    }

    public static function is_valid_url($url){
        if ($ret = parse_url($url)) {
            if (!isset($ret["scheme"])) {
                $url = "http://" . $url;
            }
        }

        return filter_var($url, FILTER_VALIDATE_URL);
    }

    public static function filter_url($input) {
        // Remove the http://, www., and slash(/) from the URL

        // If URI is like, eg. www.way2tutorial.com/
        $input = trim($input, '/');

        // If not have http:// or https:// then prepend it
        if (!preg_match('#^http(s)?://#', $input)) {
            $input = 'http://' . $input;
        }

        $urlParts = parse_url($input);

        // Remove www.
        $domain_name = @preg_replace('/^www\./', '', $urlParts['host']);

        // Output way2tutorial.com
        return $domain_name;
    }

}
