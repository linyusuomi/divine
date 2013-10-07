<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM,
    Zend\InputFilter\InputFilter,
    Zend\InputFilter\Factory as InputFactory,
    Zend\InputFilter\InputFilterAwareInterface,
    Zend\InputFilter\InputFilterInterface;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity
 * @property int $pid
 * @property string $post
 * @property string $author
 * @property string $image
 * @property datetime $updated
 * @property datetime $created
 * @property int $tid
 * 
 */
class Post implements InputFilterAwareInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="pid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pid;

    /**
     * @var string
     *
     * @ORM\Column(name="post", type="text", nullable=false)
     */
    private $post;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255, nullable=false)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     */
    private $image;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=false)
     */
    private $updated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Blog\Entity\Tag", inversedBy="pid")
     * @ORM\JoinTable(name="post_tag",
     *   joinColumns={
     *     @ORM\JoinColumn(name="pid", referencedColumnName="pid")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="tid", referencedColumnName="tid")
     *   }
     * )
     */
    private $tid;

    
    /**
     * getters and setters
     */
    public function getPid() {
        return $this->pid;
    }

    public function setPid($pid) {
        $this->pid = $pid;
    }

    public function getPost() {
        return $this->post;
    }

    public function setPost($post) {
        $this->post = $post;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getUpdated() {
        return $this->updated;
    }

    public function setUpdated($updated) {
        $this->updated = $updated;
    }

    public function getCreated() {
        return $this->created;
    }

    public function setCreated($created) {
        $this->created = $created;
    }

    public function getTid() {
        return $this->tid;
    }

    public function setTid($tid) {
        $this->tid = $tid;
    }

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tid = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Magic getter to expose protected properties.
     *
     * @param string $property
     * @return mixed
     */
    public function __get($property) 
    {
        return $this->$property;
    }
 
    /**
     * Magic setter to save protected properties.
     *
     * @param string $property
     * @param mixed $value
     */
    public function __set($property, $value) 
    {
        $this->$property = $value;
    }
 
    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() 
    {
        return get_object_vars($this);
    }
 
    /**
     * Populate from an array.
     *
     * @param array $data
     */
    public function populate($data = array()) 
    {
        $this->pid        = $data['pid'];
        $this->post       = $data['post'];
        $this->author     = $data['author'];
        $this->image      = $data['image'];
        $this->updated    = $data['updated'];
        $this->created    = $data['created'];
        $this->tid        = $data['tid'];
    }
 
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }
 
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
 
            $factory = new InputFactory();
 
            $inputFilter->add($factory->createInput(array(
                'name'       => 'pid',
                'required'   => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'       => 'post',
                'required'   => true,
                'filters' => array(
                    array('name' => 'string'),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'       => 'author',
                'required'   => true,
                'filters' => array(
                    array('name' => 'string'),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'       => 'image',
                'required'   => true,
                'filters' => array(
                    array('name' => 'string'),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'     => 'updated',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                /*
                'validators' => array(
                    array(
                        'name'    => 'DateRange',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => '2012-01-01',
                            'max'      => '2020-01-01',
                        ),
                    ),
                ),*/
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'     => 'created',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                /*
                'validators' => array(
                    array(
                        'name'    => 'DateRange',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => '2012-01-01',
                            'max'      => '2020-01-01',
                        ),
                    ),
                ),*/
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'       => 'tid',
                'required'   => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            )));
            
           
            $this->inputFilter = $inputFilter;        
        }
 
        return $this->inputFilter;
    } 
    
}
