<?php
// src/Entity/User.php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @UniqueEntity(fields="email", errorPath="email", message="cet email est déjà utilisé par un autre user!")
 * @UniqueEntity(fields="username", errorPath="username", message="cet utilisateur existe déjà!")
 * 
 * 
 */
class User
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
     * @ORM\Column(type="string", name="username", unique=true)
     * 
     * 
     * @var string
     */
    private $username;

    /**
     * @ORM\Column(type="string", name="email", unique=true)
     * 
     * @var string
     */
     private $email;

      /**
     * @ORM\Column(type="string")
     * 
     * @var string
     */
     private $password;

      /**
     * @ORM\Column(type="json")
     * @var array
     */
     private $roles;

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


     public function __construct()
     {
        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');
        $this->roles = array();
         
     }

    // my getters
     public function getId(): int
     {        
            return $this->Id;
        }
     public function getUsername(): string
        {     
            return $this->username;
        }
     public function getEmail(): string
        {
            return $this->email;
        }
     public function getPassword(): string
        {     
            return $this->password;
        }
     public function getRoles(): array
        {        
            return $this->roles;
        }
     public function getCreatedAt(): \DateTime
        {     
            return $this->createdAt;
        }
     public function getUpdatedAt(): \DateTime
        {     
            return $this->updatedAt;
        }
     
     // my settters
     public function setUsername(string $username):self
     {
         $this->username = $username;
         return $this;
     }
     public function setEmail(string $email):self
     {
         $this->email=$email;
         return $this;
     }

     public function setPassword(string $password):self
     {
         $this->password=$password;
         return $this;
     }



     public function setRoles(array $roles):self
     {
         foreach ($roles as $role) {
         if ($this->roles === $role) {
         }else{
            $this->roles=$role;
         }
     }

        
        return $this; 

     }
     
     $array1 = array("a" => "green", "red", "blue");
     $array2 = array("b" => "green", "yellow", "red");
     $result = array_intersect($array1, $array2);
     print_r($result);
     ?>
     L'exemple ci-dessus va afficher :
     
     Array
     (
         [a] => green
         [0] => red
     )


     public function setCreatedAt(\DateTime $createdAt):self
     {
         $this->createdAt=$createdAt;
         return $this;
     }
     public function setUpdatedAt(\DateTime $updatedAt):self
     {
         $this->updatedAt=$updatedAt;
         return $this;
     }


  

}