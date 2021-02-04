<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Usuario
 * 
 * @ORM\Table(name="usuario")
 * @ORM\Entity(repositoryClass="App\Repository\UsuarioRepository")
 */
class Usuario implements JWTUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @ORM\Column(name="apellido", type="string", length=255, nullable=false)
     */
    private $apellido;

    /**
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * 
     * @ORM\ManyToMany(targetEntity="Post", cascade={"persist", "remove"}, fetch="LAZY")
     * @ORM\JoinTable(name="usuarios_posteos",
     *      joinColumns={@ORM\JoinColumn(name="usuario_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="post_id", referencedColumnName="id", unique=true)}
     * )
     */
    private $posts;
    
    public function __construct($nombre=null, $apellido=null, $email=null, $password=null){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->password = $password;
        $this->posts = new ArrayCollection();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): self
    {
        $this->apellido = $apellido;

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|Post[]
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;            
        }
        return $this;
    }

    public function removePost(Post $post): self
    {
        $this->posts->removeElement($post);       
        return $this;
    }

}
