<?php

// src/Entity/Comment.php
use DateTime;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="comment")
 */
class Comment 
{
     /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * 
     * @var int
     */
    private $Id;

   /**
     * @ORM\Column(type="text")
     * 
     * @var text
     */
    private $message;
   
    /**
     * @ORM\Column(type="datetime", name="created_at", inversedBy="comment)
     * 
     * @var DateTime
     */
     private $createdAt;

     /**
     * @ORM\Column(type="datetime", name="updated_at", inversedBy="comment")
     * 
     * @var DateTime
     */
     private $updatedAt;

     /**
      * @ORM\Id
      * @ORM\Column(type="integer")
     *  @ORM\ManyToOne(targetEntity="App\Entity\Post")
     *  @JoinColumn(name="post_id", referencedColumnName="id")
     * 
     *  @var integer
     */
     private $postId;


      /**
      * @ORM\Id
      * @ORM\Column(type="integer")
      * @ORM\ManyToOne(targetEntity="App\Entity\User")
      * @JoinColumn(name="user_id", referencedColumnName="id")
      * 
      *  @var integer
      */
     private $userId;

public function __construct()
{
  $this->createdAt = new \DateTime('now');
  $this->updatedAt = new \DateTime('now');
}

       // my getters
     public function getId(){           return $this->Id;}
     public function getPostId(){       return $this->postId;}
     public function getUserId(){       return $this->userId;}

     public function getMessage(){      return $this->message;}
     public function getCreateAt(){     return $this->createdAt;}
     public function getUpdateAt(){     return $this->updatedAt;}
     
     
     //setters 
     public function setMessage($message):self{
         $this->message=$message;
         return $this;
     }
      public function setCreatedAt(\DateTime $createdAt):self{
         $this->createdAt=$createdAt;
         return $this;
     }

     public function setupdatedAt(\DateTime $updatedAt):self{
         $this->updatedAt=$updatedAt;
         return $this;
     }


}