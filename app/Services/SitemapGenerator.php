<?php

namespace App\Services;

use DOMDocument;
use SimpleXMLElement;
use Illuminate\Support\Str;

class SitemapGenerator
{
    public static function generate_sitemap($url)
    {
        // Initialize cURL session
        $curl = curl_init();

        // Set the cURL options
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // Execute the cURL request
        $html_content = curl_exec($curl);

        // Close the cURL session
        curl_close($curl);

        // Check if cURL request was successful
        if (!$html_content) {
            echo "Error: Failed to retrieve HTML content using cURL.";
            return;
        }

        // Create a new SimpleXMLElement
        $sitemap = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');

        // Parse the HTML
        $dom = new DOMDocument;
        libxml_use_internal_errors(true);  // Disable error reporting for HTML parsing
        $dom->loadHTML($html_content);
        libxml_clear_errors();

        // Find all anchor tags containing URLs
        $anchor_tags = $dom->getElementsByTagName('a');

        // Get the hostname of the provided URL
        $hostname = parse_url($url, PHP_URL_HOST);

        // Add the provided URL to the sitemap
        $url_element = $sitemap->addChild('url');
        $url_element->addChild('loc', $url);

        // Add matching internal URLs to the sitemap
        foreach ($anchor_tags as $anchor) {
            $href = $anchor->getAttribute('href');
            if ($href && !self::startsWith($href, '#') && !self::startsWith($href, 'mailto:')) {
                $abs_url = self::urljoin($url, $href);  // Resolve relative URLs

                // Check if the resolved URL has the same hostname as the provided URL
                if (parse_url($abs_url, PHP_URL_HOST) === $hostname) {
                    $url_element = $sitemap->addChild('url');
                    $url_element->addChild('loc', $abs_url);
                }
            }
        }

        // Generate the sitemap XML
        $sitemap_xml = $sitemap->asXML();

        // Save the XML to a file
        $sitemapFileName = Str::slug($hostname) . '.xml';
        file_put_contents($sitemapFileName, $sitemap_xml);
    }

    public static function urljoin($base, $relative)
    {
        if (strpos($relative, '://') !== false) {
            return $relative;  // Absolute URL
        }

        if ($relative == '' || $relative[0] == '/') {
            $base_parts = parse_url($base);
            $base = $base_parts['scheme'] . '://' . $base_parts['host'];
        }

        return rtrim($base, '/') . '/' . ltrim($relative, '/');
    }

    public static function startsWith($string, $prefix)
    {
        return substr($string, 0, strlen($prefix)) === $prefix;
    }
}
