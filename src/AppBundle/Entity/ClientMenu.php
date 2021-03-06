<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="jdc_category")
 **/
class ClientMenu
{
    /**
     * @ORM\Column(type = "integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     **/
    private $id;

    /**
     * @ORM\Column(name="label_mn", type="string", length = 255)
     **/
    private $labelMN;

    /**
     * @ORM\Column(name="label_en", type="string", length = 255)
     **/
    private $labelEN;

    /**
     * @ORM\Column(name="parent_id", type="string", length = 255)
     **/
    private $parentID;

    /**
     * @ORM\Column(name="link", type="string", length = 255)
     **/
    private $link;

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
    public function getLabelMN()
    {
        return $this->labelMN;
    }

    /**
     * @param mixed $labelMN
     */
    public function setLabelMN($labelMN)
    {
        $this->labelMN = $labelMN;
    }

    /**
     * @return mixed
     */
    public function getLabelEN()
    {
        return $this->labelEN;
    }

    /**
     * @param mixed $labelEN
     */
    public function setLabelEN($labelEN)
    {
        $this->labelEN = $labelEN;
    }

    /**
     * @return mixed
     */
    public function getParentID()
    {
        return $this->parentID;
    }

    /**
     * @param mixed $parentID
     */
    public function setParentID($parentID)
    {
        $this->parentID = $parentID;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link)
    {
        $this->link = $link;
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
