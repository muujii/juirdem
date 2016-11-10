<?php
namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="jdc_small_slide")
 **/
class SmallSlider
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
     * @ORM\Column(name="title_en", type="string", length = 255)
     **/
    private $titleEN;

    /**
     * @ORM\Column(name="path", type="string", length = 255)
     **/
    private $path;

    /**
     * @Assert\File(maxSize="6000000")
     *
     */
    private $file;

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
    public function getTitleEN()
    {
        return $this->titleEN;
    }

    /**
     * @param mixed $titleEN
     */
    public function setTitleEN($titleEN)
    {
        $this->titleEN = $titleEN;
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

    protected function getUploadRootDir()
    {
        return __DIR__ . '/../../../web/bundles/' . $this->getUploadDir();
    }

    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir() . '/' . $this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir() . '/' . $this->path;
    }


    protected function getUploadDir()
    {
        return 'images/small/slider';
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->getFile()->getClientOriginalName()
        );

        $this->path = $this->getFile()->getClientOriginalName();

        $this->file = null;
    }
}
