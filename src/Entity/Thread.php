<?php


namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ThreadRepository")
 * @ORM\Table(name="thread")
 */
class Thread
{
	/**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="thread", type="string", length=1000)
     */
    private $thread;
	
	/**
     * @ORM\Column(name="user_id", type="integer")
     */
    private $user_id;
	
	/**
     * @ORM\Column(name="username", type="string", length=100)
     */
    private $username;
	
	/**
     * @ORM\Column(name="content", type="string", length=10000)
     */
    private $content;
	
	/**
     * @ORM\Column(name="publication", type="string")
     */
    private $publication;
	
	
	public function getId(): ?int
    {
        return $this->id;
    }
	
	public function setThread(string $thread): self
    {
        $this->thread = $thread;

        return $this;
    }

    public function getThread(): ?string
    {
        return $this->thread;
    }
	
	public function setUserID(int $id): self
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
	
	public function setContent(string $content): self
    {
        $this->content = $content;
		
		return $this;
    }
	
	public function getContent(): ?string
    {
        return $this->content;
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