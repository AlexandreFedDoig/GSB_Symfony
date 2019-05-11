<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="user", indexes={@ORM\Index(name="SEC_CODE", columns={"SEC_CODE"}), @ORM\Index(name="LAB_CODE", columns={"LAB_CODE"})})
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;
    
    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;
    
    /**
     * @var string
     *
     * @ORM\Column(name="VIS_MATRICULE", type="string", length=10, nullable=false)
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $visMatricule;
    
    /**
     * @var string|null
     *
     * @ORM\Column(name="VIS_NOM", type="string", length=25, nullable=true)
     */
    private $visNom;
    
    /**
     * @var string|null
     *
     * @ORM\Column(name="VIS_PRENOM", type="string", length=50, nullable=true)
     */
    private $visPrenom;
    
    /**
     * @var string|null
     *
     * @ORM\Column(name="VIS_ADRESSE", type="string", length=50, nullable=true)
     */
    private $visAdresse;
    
    /**
     * @var string|null
     *
     * @ORM\Column(name="VIS_CP", type="string", length=5, nullable=true)
     */
    private $visCp;
    
    /**
     * @var string|null
     *
     * @ORM\Column(name="VIS_VILLE", type="string", length=30, nullable=true)
     */
    private $visVille;
    
    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="VIS_DATEEMBAUCHE", type="datetime", nullable=true)
     */
    private $visDateembauche;
    
    /**
     * @var string|null
     *
     * @ORM\Column(name="SEC_CODE", type="string", length=1, nullable=true)
     */
    private $secCode;
    
    /**
     * @var string|null
     *
     * @ORM\Column(name="LAB_CODE", type="string", length=2, nullable=true)
     */
    private $labCode;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getUsername(): ?string
    {
        return $this->username;
    }
    
    public function setUsername(?string $username): self
    {
        $this->username = $username;
        
        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): ?string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
    
    public function getEmail(): ?string
    {
        return $this->email;
    }
    
    public function setEmail(string $email): self
    {
        $this->email = $email;
        
        return $this;
    }
    
    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
    
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password,
            $this->email,
            // see section on salt below
            // $this->salt,
        ]);
    }
    
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->email,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized, ['allowed_classes' => false]);
    }
}
