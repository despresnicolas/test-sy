<?php

namespace App\Data;

use App\Entity\Sortie;

class SearchData
{
    /**
     * @var string
     */
    private $q = '';

    /**
     * @var Sortie[]
     */
    private $sorties = [];


    /**
     * @return string
     */
    public function getQ(): string
    {
        return $this->q;
    }

    /**
     * @param string $q
     */
    public function setQ(string $q): void
    {
        $this->q = $q;
    }

    /**
     * @return array
     */
    public function getSorties(): array
    {
        return $this->sorties;
    }

    /**
     * @param array $sorties
     */
    public function setSorties(array $sorties): void
    {
        $this->sorties = $sorties;
    }
}