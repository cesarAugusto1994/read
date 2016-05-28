<?php

namespace ReadBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Autor
 *
 * @ORM\Table(name="autor")
 * @ORM\Entity(repositoryClass="ReadBundle\Repository\AutorRepository")
 */
class Autor
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min=3, max=120)
     * @ORM\Column(name="nome", type="string", length=120)
     */
    private $nome;

    /**
     * @var int
     *
     * @ORM\Column(name="ativo", type="integer")
     */
    private $ativo;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return Autor
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set ativo
     *
     * @param integer $ativo
     *
     * @return Autor
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;

        return $this;
    }

    /**
     * Get ativo
     *
     * @return int
     */
    public function getAtivo()
    {
        return $this->ativo;
    }
}

