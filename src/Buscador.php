<?php

namespace Alura\BuscadorDeCursos;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\DomCrawler\Crawler;

class Buscador
{

    /**
     * @var ClientInterface
     */
    private $httpClient;

    /**
     * Oioioi
     *
     * @var Crawler
     */
    private $crawler;


    public function __construct(ClientInterface $httpClient, Crawler $crawler)
    {
        $this->httpClient = $httpClient;
        $this->crawler    = $crawler;
    }


    public function buscar(string $url): void
    {
        try {
            $response = $this->httpClient->request('GET', $url);
            $html     = $response->getBody();
        } catch (GuzzleException $e) {
            echo 'Erro na Requisião :' . $e;
            return;
        }

        $this->crawler->addHtmlContent($html);
        $cursos = $this->crawler->filter('#php')->filter('.card-curso__nome');

        foreach ($cursos as $curso) {
            echo $curso->textContent . PHP_EOL;
        }
    }
}
