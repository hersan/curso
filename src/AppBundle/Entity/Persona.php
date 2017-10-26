<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Persona
 *
 * @ORM\Table(name="persona")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersonaRepository")
 */
class Persona
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
     * @ORM\Column(name="nombre", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min="3")
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min="3")
     */
    private $apellido;

    /**
     * @var integer
     *
     * @ORM\Column(name="edad", type="integer")
     * @Assert\NotBlank()
     */
    private $edad;


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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Persona
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellido
     *
     * @param string $apellido
     *
     * @return Persona
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apeliido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    public function nombreCompleto()
    {
        return sprintf('%s %s', $this->getNombre(), $this->getApellido());
    }

    /**
     * Set edad
     *
     * @param integer $edad
     *
     * @return Persona
     */
    public function setEdad($edad)
    {
        $this->edad = $edad;

        return $this;
    }

    /**
     * Get edad
     *
     * @return integer
     */
    public function getEdad()
    {
        return $this->edad;
    }
}
