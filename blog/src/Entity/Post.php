<?php
// src/Entity/Post.php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="post")
 */
class Post
{
     /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * 
     * @var int
     */
    private $id;

   /**
     * @ORM\Column(type="string")
     * 
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * 
     * @var string
     */
     private $content;

      /**
     * @ORM\Column(type="boolean", options={"default":0})
     * 
     * @var boolean
     */
     private $published;


   
    /**
     * @ORM\Column(type="datetime", name="created_at")
     * 
     * @var \DateTime
     */
     private $createdAt;

     /**
     * @ORM\Column(type="datetime", name="updated_at")
     * 
     * @var \DateTime
     */
     private $updatedAt;

     /**
      * @ORM\Column(type="integer")
      * @ORM\ManyToOne(targetEntity="App\Entity\User", name="user_id")
      * @JoinColumn(name="user_id", referencedColumnName="id")

      * @var int
      */
    private $userId;


     public function __construct()
     {
        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');
         
     }
    // my getters
     public function getId(): int
        {         
           return $this->Id;
        }
     public function getTitle(): string
        {       
           return $this->title;
        }
     public function getContent(): string
        {  
            return $this->content;
        }
     public function isPublished(): bool
        {  
            return $this->published;
        }
     public function getCreateAt(): \DateTime
        {    
             return $this->createdAt;
        }
     public function getUpdateAt(): \DateTime
        {     
            return $this->updatedAt;
        }

     // setters
     public function setTitle(string $title):self
     {
         $this->title=$title;
         return $this;
     }
    public function setContent(string $content):self
    {
         $this->content=$content;
         return $this;
    }
    public function setPublished(bool $published):self
    {
        $this->published=$published;
        return $this;
    }
    public function setCreatedAt(\DateTime $createdAt):self
    {
         $this->createdAt=$createdAt;
         return $this;
     }
     public function setupdatedAt(\DateTime $updatedAt):self
     {
         $this->updatedAt=$updatedAt;
         return $this;
     }


}