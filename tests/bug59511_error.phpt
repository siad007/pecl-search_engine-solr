--TEST--
Solr bug #59511 - SolrClient::query() Timeout shall throw a SolrClientException
--EXTENSIONS--
libxml
curl
--SKIPIF--
<?php require_once 'skip.if.server_not_configured.inc'; ?>
--FILE--
<?php

require_once "bootstrap.inc";
// force to timeout trying to resolve
$options = array
(
		'hostname' => 'some-bogus-host-that-does-not-exist'.time().'.com',
		'login'    => SOLR_SERVER_USERNAME,
		'password' => SOLR_SERVER_PASSWORD,
		'port'     => SOLR_SERVER_PORT,
		'path'	   => SOLR_SERVER_PATH
);

$client = new SolrClient($options);
$query = new SolrQuery("lucene");

$query_response = $client->query($query);
?>
--EXPECTF--
Fatal error: Uncaught exception 'SolrClientException' with message 'Solr HTTP Error %d: '%s' ' in %s:%d
Stack trace:
#0 %s(%d): SolrClient->query(Object(SolrQuery))
#1 {main}
  thrown in %s on line %d