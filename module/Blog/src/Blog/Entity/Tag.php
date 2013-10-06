<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM,
    Zend\InputFilter\InputFilter,
    Zend\InputFilter\Factory as InputFactory,
    Zend\InputFilter\InputFilterAwareInterface,
    Zend\InputFilter\InputFilterInterface;

/**
 * Tag
 *
 * @ORM\Table(name="tag")
 * @ORM\Entity
 * @property int $tid
 * @property string $tag
 * @property int $pid
 * 
 */
class Tag implements InputFilterAwareInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="tid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $tid;

    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="string", length=255, nullable=false)
     */
    private $tag;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Blog\Entity\Post", mappedBy="tid")
     */
    private $pid;

    /**
     * getters and setters
     */
    public function getTid() {
        return $this->tid;
    }

    public function setTid($tid) {
        $this->tid = $tid;
    }

    public function getTag() {
        return $this->tag;
    }

    public function setTag($tag) {
        $this->tag = $tag;
    }
    
    public function getPid() {
        return $this->pid;
    }

    public function setPid($pid) {
        $this->pid = $pid;
    }

   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pid = new \Doctrine\Common\Collections\ArrayCollection();
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
        $this->tid        = $data['tid'];
        $this->tag        = $data['tag'];
        $this->pid        = $data['pid'];
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
                'name'       => 'tid',
                'required'   => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'       => 'tag',
                'required'   => true,
                'filters' => array(
                    array('name' => 'string'),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'       => 'pid',
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
