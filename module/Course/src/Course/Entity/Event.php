<?php
namespace Course\Entity;

use Doctrine\ORM\Mapping as ORM,
    Zend\InputFilter\InputFilter,
    Zend\InputFilter\Factory as InputFactory,
    Zend\InputFilter\InputFilterAwareInterface,
    Zend\InputFilter\InputFilterInterface;

/**
 * A course list.
 *
 * @ORM\Entity
 * @ORM\Table(name="event")
 * @property int $id
 * @property string $eventName
 * @property datetime $start
 * @property datetime $end
 */

class Event implements InputFilterAwareInterface {

   protected $inputFilter;
 
    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $eventName;
 
    /**
     * @ORM\Column(type="datetime")
     */
    protected $start;
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $end;
 
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
        $this->id           = $data['id'];
        $this->eventName    = $data['eventName'];
        $this->start        = $data['start'];
        $this->end          = $data['end'];
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
                'name'       => 'id',
                'required'   => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'       => 'event name',
                'required'   => true,
                'filters' => array(
                    array('name' => 'string'),
                ),
            )));
 
            $inputFilter->add($factory->createInput(array(
                'name'     => 'start',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                
            )));
 
            $inputFilter->add($factory->createInput(array(
                'name'     => 'end',
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
 
            $this->inputFilter = $inputFilter;        
        }
 
        return $this->inputFilter;
    } 
}