<?php

namespace App\Data;

use App\Entity\Campus;
use App\Entity\Sortie;

class SearchData
{

    public ?string $search = null;

    public ?Campus $campus = null;

    public ?\DateTime $dateDebut = null;

    public ?\DateTime $dateFin = null;

    public bool $organisateur = false;

    public bool $inscrit = false;

    public bool $pasInscrit = false;

    public bool $passees = false;
}