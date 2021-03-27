<?php

use Alura\BuscadorDeCursos\Buscador;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

require_once 'vendor/autoload.php';

$client = new Client();
$crawler = new Crawler();

$buscador = new Buscador($client, $crawler);

$buscador->buscar('https://www.alura.com.br/cursos-online-programacao');

