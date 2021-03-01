<?php

namespace WPH;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;

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

			return $encoder->encode($ry, 'xml');

		} elseif($this->query['response_format'] == 'json') {

			$normalizer = new ObjectNormalizer();
			$encoder = new JsonEncoder();

			$serializer = new Serializer([$normalizer], [$encoder]);

			$rt = $this->posts;

			$ry = json_decode(json_encode($rt));

			return $serializer->serialize($ry, 'json');

		} elseif($this->query['response_format'] == 'csv') {

			$normalizer = new ObjectNormalizer();
			$encoder = new CsvEncoder();

			$serializer = new Serializer([$normalizer], [$encoder]);

			$rt = $this->posts;

			$ry = json_decode(json_encode($rt));

			return $serializer->serialize($ry, 'csv');

		}

	}
}