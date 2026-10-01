<?php

declare(strict_types=1);

class ControleurAccueil
{
    private $vue;

    public function __construct(Vue $vue)
    {
        $this->vue = $vue;
    }

    public function index(): void
    {
        $this->vue->afficher(
            'accueil',
            [
                'titrePage' => 'Collaboration de recettes et de menu',
                'auteur' => 'Alex Boyajian',
                'versionPhp' => PHP_VERSION
            ], 'Collaboration de recettes et de menu'
        );
    }
}