<?php


namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentaireRepository")
 * @ORM\Table(name="commentaire")
 */
class Commentaire
{
	/**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="commentaire", type="string", length=1000)
     */
    private $commentaire;
	
	/**
     * @ORM\Column(name="thread_id", type="integer")
     */
    private $thread_id;
	
	/**
     * @ORM\Column(name="user_id", type="integer")
     */
    private $user_id;
	
	/**
     * @ORM\Column(name="username", type="string", length=100)
     */
    private $username;
	
	/**
     * @ORM\Column(name="publication", type="string")
     */
    private $publication;
	
	
	public function getId(): ?int
    {
        return $this->id;
    }
	
	public function setCommentaire(string $comment): self
    {
        $this->commentaire = $comment;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }
	
	public function setThreadID(string $id): self
    {
        $this->thread_id = $id;

        return $this;
    }

    public function getThreadID(): ?int
    {
        return $this->thread_id;
    }
	
	public function setUserID(string $id): self
    {
        $this->user_id = $id;

        return $this;
    }

    public function getUserID(): ?int
    {
        return $this->user_id;
    }
	
	public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }
	
	public function getPublication(): ?string
    {
        return $this->publication;
    }

    public function setPublication(DateTime $publication_time): self
    {
		$publication_time = $publication_time->format('d/m/Y H:i:s');
        $this->publication = $publication_time;
		
		return $this;
    }
}