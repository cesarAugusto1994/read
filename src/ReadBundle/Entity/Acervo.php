<?php

namespace ReadBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Acervo
 *
 * @ORM\Table(name="acervo")
 * @ORM\Entity(repositoryClass="ReadBundle\Repository\AcervoRepository")
 */
class Acervo
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
     *
     * @ORM\Column(name="titulo", type="string", length=80)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="text")
     */
    private $descricao;

    /**
     * @var Autor $autor
     * @ORM\ManyToOne(targetEntity="Autor")
     * @ORM\JoinColumn(name="autor_id", referencedColumnName="id")
     */
    private $autor;

    /**
     * @var Secao $secao
     * @ORM\ManyToOne(targetEntity="Secao")
     * @ORM\JoinColumn(name="secao_id", referencedColumnName="id")
     */
    private $secao;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="data_cadastro", type="datetime")
     */
    private $dataCadastro;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="text")
     */
    private $url;


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
     * Set titulo
     *
     * @param string $titulo
     *
     * @return Acervo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set autor
     *
     * @param string $autor
     *
     * @return Acervo
     */
    public function setAutor($autor)
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Get autor
     *
     * @return string
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @return Secao
     */
    public function getSecao()
    {
        return $this->secao;
    }

    /**
     * @param Secao $secao
     */
    public function setSecao($secao)
    {
        $this->secao = $secao;
    }

    /**
     * @return DateTime
     */
    public function getDataCadastro()
    {
        return $this->dataCadastro;
    }

    /**
     * @param DateTime $dataCadastro
     */
    public function setDataCadastro($dataCadastro)
    {
        $this->dataCadastro = $dataCadastro;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }


}

