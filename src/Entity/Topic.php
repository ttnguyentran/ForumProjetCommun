<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TopicRepository")
 * @ORM\Table(name="topic")
 */
class Topic
{
	/**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="topic" type="string", length=250)
     */
    private $topic;
	
	
	public function getId(): ?int
    {
        return $this->id;
    }
	
	public function setTopic(string $topic): self
    {
        $this->topic = $topic;

        return $this;
    }

    public function getTopic(): ?string
    {
        return $this->topic;
    }
}