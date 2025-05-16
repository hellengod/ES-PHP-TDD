<?php
namespace Alura\Leilao\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use DomainException;

class Avaliador
{
    private $maiorValor = -INF;
    private $menorValor = INF;
    private $maioresLances;


    public function avalia(Leilao $leilao): void
    {
        if ($leilao->isFinalizado()) {
            throw new DomainException("leilao ja finalizado");
        }

        if (empty($leilao->getLances())) {
            throw new DomainException('Nao e possivel avaliar leilao vazio');
        }

        foreach ($leilao->getLances() as $lance) {
            if ($lance->getValor() > $this->maiorValor) {
                $this->maiorValor = $lance->getValor();
            }
            if ($lance->getValor() < $this->menorValor) {
                $this->menorValor = $lance->getValor();

            }
        }
        $lances = $leilao->getLances();
        usort($lances, function (Lance $lance1, Lance $lance2) {
            return $lance2->getValor() - $lance1->getValor(); // do maior para o menor
        });
        $this->maioresLances = array_slice($lances, 0, 3);

    }

    public function getMaiorValor(): float
    {
        return $this->maiorValor;
    }
    public function getMenorValor(): float
    {
        return $this->menorValor;
    }

    public function getMaioresLances(): array
    {
        return $this->maioresLances;
    }



}