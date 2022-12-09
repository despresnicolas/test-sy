<?php

namespace App\Data;

use App\Entity\Campus;
use App\Entity\Sortie;
use DateTime;

class SearchData
{

    /**
     * @var string|null
     */
    public ?string $textQuery = null;

    /**
     * @var Campus|null
     */
    public ?Campus $campus = null;

    /**
     * @var DateTime|null
     */
    public ?DateTime $dateDebut = null;

    /**
     * @var DateTime|null
     */
    public ?DateTime $dateFin = null;

    /**
     * @var bool
     */
    public bool $organisateur = false;

    /**
     * @var bool
     */
    public bool $inscrit = false;

    /**
     * @var bool
     */
    public bool $pasInscrit = false;

    /**
     * @var bool
     */
    public bool $passees = false;
}