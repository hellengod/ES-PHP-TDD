<?php

namespace Alura\Leilao\Teste\Model;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use PHPUnit\Framework\TestCase;

class LeilaoTest extends TestCase
{

    public function testLeilaoNaoDeveReceberLancesRepetidos()
    {
        $leilao = new Leilao('Variante');
        $ana = new Usuario('Ana');

        $leilao->recebeLance(new Lance($ana, 1000));
        $leilao->recebeLance(new Lance($ana, 1500));
        
        static::assertCount(1, $leilao->getLances());
        static::assertEquals(1000, $leilao->getLances()[0]->getValor());
    }

    /**
     * @dataProvider geraLances
     */
    public function testLeilaoDeveReceberLances(int $qntLances, Leilao $leilao, array $valores)
    {
        static::assertCount($qntLances, $leilao->getLances());
        foreach ($valores as $i => $valor) {
            static::assertEquals($valor, $leilao->getLances()[$i]->getValor());
        }
    }



    public static function geraLances()
    {
        $joao = new Usuario("Joao");
        $maria = new Usuario("Maria");

        $leilaoCom2lances = new Leilao('Fiat 147 0KM');
        $leilaoCom2lances->recebeLance(new Lance($joao, 1000));
        $leilaoCom2lances->recebeLance(new Lance($maria, 2000));

        $leilaoCom1lances = new Leilao('Fusca');
        $leilaoCom1lances->recebeLance(new Lance($maria, 5000));

        return [
            '2-lances' => [2, $leilaoCom2lances, [1000, 2000]],
            '2-lance' => [1, $leilaoCom1lances, [5000]]
        ];
    }
}