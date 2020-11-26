<?php
 /**
  * Created by PhpStorm.
  * User: hicham benkachoud
  * Date: 05/01/2020
  * Time: 22:07
  */

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class User implements UserInterface
{
 /**
  * @ORM\Column(type="integer")
  * @ORM\Id
  * @ORM\GeneratedValue(strategy="AUTO")
  */
 private $id;
 /**
  * @ORM\Column(type="string", length=255)
  */
 private $password;

 /**
  * @ORM\Column(type="string", length=45)
  */
 private $email;

 /**
  * User constructor.
  * @param $email
  */
 public function __construct($email)
 {
  $this->email = $email;
 }

 /**
  * @return string
  */
 public function getUsername()
 {
  return $this->email;
 }

 /**
  * @param mixed $email
  */
 public function setUsername($email): void
 {
  $this->email = $email;
 }

 /**
  * @return string|null
  */
 public function getSalt()
 {
  return null;
 }

 /**
  * @return string|null
  */
 public function getPassword()
 {
  return $this->password;
 }

 /**
  * @param $password
  */
 public function setPassword($password)
 {
  $this->password = $password;
 }
 /**
  * @return mixed
  */
 public function getEmail()
 {
  return $this->email;
 }

 /**
  * @param mixed $email
  */
 public function setEmail($email): void
 {
  $this->email = $email;
 }

 /**
  * @return array|string[]
  */
 public function getRoles()
 {
  return array('ROLE_USER');
 }

 public function eraseCredentials()
 {
 }
}