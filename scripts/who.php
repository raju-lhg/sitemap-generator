
<?php

    include './src/Phois/Whois/Whois.php';

    $tld = 'lhgraphics.com';
    $domain = new Phois\Whois\Whois($tld);
    $result = $domain->info();

    print_r($result);

?>

