<?php

namespace Alura\Leilao\Teste\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    public function testAvaliadorDeveEncontrarOMaiorValorDeLancesEmOrdemCrescente()
    {

        // Arrange - Given - Arrumo a casa para o teste
        $leilao = new Leilao('Fiat 147 0KM');

        $maria = new Usuario('maria');
        $joao = new Usuario('joao');

        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($maria, 2500));

        $leiloeiro = new Avaliador();

        //Act - When - Executo o codigo a ser testado
        $leiloeiro->avalia($leilao);

        $maiorValor = $leiloeiro->getMaiorValor();

        //Assert - Then - Verifico se a saida e a esperada

        self::assertEquals(2500, $maiorValor);

    }

    public function testAvaliadorDeveEncontrarOMaiorValorDeLancesEmOrdemDecrescente()
    {

        // Arrange - Given - Arrumo a casa para o teste
        $leilao = new Leilao('Fiat 147 0KM');

        $maria = new Usuario('maria');
        $joao = new Usuario('joao');

        $leilao->recebeLance(new Lance($maria, 2500));

        $leilao->recebeLance(new Lance($joao, 2000));

        $leiloeiro = new Avaliador();

        //Act - When - Executo o codigo a ser testado
        $leiloeiro->avalia($leilao);

        $maiorValor = $leiloeiro->getMaiorValor();

        //Assert - Then - Verifico se a saida e a esperada

        self::assertEquals(2500, $maiorValor);

    }

    public function testAvaliadorDeveEncontrarOMenorValorDeLancesEmOrdemDecrescente()
    {

        // Arrange - Given - Arrumo a casa para o teste
        $leilao = new Leilao('Fiat 147 0KM');

        $maria = new Usuario('maria');
        $joao = new Usuario('joao');

        $leilao->recebeLance(new Lance($maria, 2500));

        $leilao->recebeLance(new Lance($joao, 2000));

        $leiloeiro = new Avaliador();

        //Act - When - Executo o codigo a ser testado
        $leiloeiro->avalia($leilao);

        $menorValor = $leiloeiro->getMenorValor();

        //Assert - Then - Verifico se a saida e a esperada

        self::assertEquals(2000, $menorValor);

    }

    public function testAvaliadorDeveEncontrarOMenorValorDeLancesEmOrdemCrescente()
    {

        // Arrange - Given - Arrumo a casa para o teste
        $leilao = new Leilao('Fiat 147 0KM');

        $maria = new Usuario('maria');
        $joao = new Usuario('joao');
        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($maria, 2500));


        $leiloeiro = new Avaliador();

        //Act - When - Executo o codigo a ser testado
        $leiloeiro->avalia($leilao);

        $menorValor = $leiloeiro->getMenorValor();

        //Assert - Then - Verifico se a saida e a esperada

        self::assertEquals(2000, $menorValor);

    }
}