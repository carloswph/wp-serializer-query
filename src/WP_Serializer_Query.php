<?php

namespace WPH;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\YamlEncoder;

class WP_Serializer_Query extends \WP_Query {

	/**
	 * Serialize and encode WP_Query object output to json, xml or csv
	 * 
	 * @author 	WP Helpers | Carlos Matos
	 * 
	 * @return  $encoder or $serializer
	 */
	public function output() {

		if($this->query['response_format'] == 'xml') {

			$normalizer = new ObjectNormalizer();
			$encoder = new XmlEncoder();

			$serializer = new Serializer([$normalizer], [$encoder]);

			$rt = $this->posts;

			$ry = json_decode(json_encode($rt));

			$output = $encoder->encode($ry, 'xml');

			return htmlspecialchars($output);

		} elseif($this->query['response_format'] == 'json') {

			$normalizer = new ObjectNormalizer();
			$encoder = new JsonEncoder();

			$serializer = new Serializer([$normalizer], [$encoder]);

			$rt = $this->posts;

			$ry = json_decode(json_encode($rt));

			$output = $serializer->serialize($ry, 'json');

			return $output;

		} elseif($this->query['response_format'] == 'csv') {

			$normalizer = new ObjectNormalizer();
			$encoder = new CsvEncoder();

			$serializer = new Serializer([$normalizer], [$encoder]);

			$rt = $this->posts;

			$ry = json_decode(json_encode($rt));

			$output = $serializer->serialize($ry, 'csv');

			return htmlspecialchars($output);

		} elseif($this->query['response_format'] == 'yaml') {

			$normalizer = new ObjectNormalizer();
			$encoder = new YamlEncoder();

			$serializer = new Serializer([$normalizer], [$encoder]);

			$rt = $this->posts;

			$ry = json_decode(json_encode($rt));

			$output = $serializer->serialize($ry, 'yaml');

			return htmlspecialchars($output);
		}

	}
}