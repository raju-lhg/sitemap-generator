<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Phois\Whois\Whois;

class DomainLookUp
{
    public static function get_dns_records($url)
    {
        $url = self::filter_url(trim($url));

        if (!$url || !self::is_valid_url($url)) {
            return null;
        }

        $cachedData = Cache::get($url);
        if ($cachedData !== null) {
            return $cachedData;
        }

        $data = self::fetch_dns_records($url);

        if ($data !== null) {
            Cache::put($url, $data, 60); // Cache the data for 60 minutes
            return json_encode($data);
        }

        return null;
    }

    private static function fetch_dns_records($url)
    {
        $domain = self::extract_domain($url);

        $recordTypes = [
            DNS_A,
            DNS_NS,
            DNS_MX,
            DNS_SOA,
            DNS_TXT,
            DNS_AAAA
        ];

        $data = [];

        foreach ($recordTypes as $recordType) {
            $dnsRecords = dns_get_record($domain, $recordType);
            if (!empty($dnsRecords)) {
                $recordTypeKey = self::get_record_type_key($recordType);
                $data[$recordTypeKey] = [
                    'data' => $dnsRecords,
                    'ttl' => $dnsRecords[0]['ttl'],
                    'class' => $dnsRecords[0]['class']
                ];
            }
        }

        if (empty($data)) {
            return null;
        }

        return $data;
    }

    private static function extract_domain($url)
    {
        $parsedUrl = parse_url($url);
        return $parsedUrl['host'] ?? $url;
    }

    private static function get_record_type_key($recordType)
    {
        $map = [
            DNS_A => 'a',
            DNS_NS => 'ns',
            DNS_MX => 'mx',
            DNS_SOA => 'soa',
            DNS_TXT => 'txt',
            DNS_AAAA => 'aaaa'
        ];

        return $map[$recordType] ?? '';
    }

    public static function is_valid_url($url)
    {
        if ($ret = parse_url($url)) {
            if (!isset($ret["scheme"])) {
                $url = "http://" . $url;
            }
        }

        return filter_var($url, FILTER_VALIDATE_URL);
    }

    public static function filter_url($input)
    {
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

    public static function get_who_is_data($tld)
    {
        $domain = new Whois(self::filter_url($tld));
        $result = $domain->info();

        return $result;
    }
}
