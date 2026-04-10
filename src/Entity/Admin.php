<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * L'entité Admin hérite de User.
 * Elle utilise la même table SQL 'user' grâce à la stratégie SINGLE_TABLE.
 */
#[ORM\Entity(repositoryClass: AdminRepository::class)]
class Admin extends User
{
    /**
     * Ici, on peut définir des constantes pour les rôles 
     * afin d'éviter les fautes de frappe dans le code.
     */
    public const ROLE_SUPER_ADMIN = 'SUPER_ADMIN';
    public const ROLE_GESTIONNAIRE = 'GESTIONNAIRE';

    /**
     * Tu peux ajouter ici des méthodes spécifiques aux Admins si besoin.
     * Par exemple, une méthode pour vérifier si c'est un super admin.
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === self::ROLE_SUPER_ADMIN;
    }
}