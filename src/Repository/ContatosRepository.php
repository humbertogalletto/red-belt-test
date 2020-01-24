<?php

namespace App\Repository;

use App\Entity\Contatos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Contatos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contatos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contatos[]    findAll()
 * @method Contatos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContatosRepository extends ServiceEntityRepository
{
    /**
     * ContatosRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contatos::class);
    }

    /**
     * @param Contatos $contato
     * @return array
     */
    public function transform(Contatos $contato)
    {
        return [
            'id'    => (int) $contato->getId(),
            'Nome' => (string) $contato->getNome(),
            'Telefone' => (string) $contato->getTelefone(),
            'Email' => (string) $contato->getEmail()
        ];
    }

    /**
     * @return array
     */
    public function transformAll()
    {
        $contatos = $this->findAll();
        $contatosArray = [];

        foreach ($contatos as $contato) {
            $contatosArray[] = $this->transform($contato);
        }

        return $contatosArray;
    }
}
