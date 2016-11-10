<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="jdc_slide")
 **/
class ClientSlider
{
    /**
     * @ORM\Column(type = "integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     **/
    private $id;

    /**
     * @ORM\Column(name="title_mn", type="string", length = 255)
     **/
    private $titleMN;

    /**
     * @ORM\Column(name="path", type="string", length = 255)
     **/
    private $path;

    /**
     * @ORM\Column(name="active", type="boolean")
     **/
    private $active;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitleMN()
    {
        return $this->titleMN;
    }

    /**
     * @param mixed $titleMN
     */
    public function setTitleMN($titleMN)
    {
        $this->titleMN = $titleMN;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }
}