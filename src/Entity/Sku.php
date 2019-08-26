<?php
/**
    An Sku is an entity that accounts can opt in to consuming.

    PHP Version 7.1+

    @category  PHP
    @package   App_Entity
    @author    Jeroen van Meeuwen (Kolab Systems) <vanmeeuwen@kolabsys.com>
    @author    Christian Mollekopf (Kolab Systems) <mollekopf@kolabsys.com>
    @copyright 2019 Kolab Systems AG <contact@kolabsystems.com>
    @license   GPLv3 (https://www.gnu.org/licenses/gpl.txt)
    @link      https://pxts.ch
 */
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
    ORM definition of an SKU.

    @category  PHP
    @package   App_Entity
    @author    Jeroen van Meeuwen (Kolab Systems) <vanmeeuwen@kolabsys.com>
    @author    Christian Mollekopf (Kolab Systems) <mollekopf@kolabsys.com>
    @copyright 2019 Kolab Systems AG <contact@kolabsystems.com>
    @license   GPLv3 (https://www.gnu.org/licenses/gpl.txt)
    @link      https://pxts.ch

    @ORM\Entity(repositoryClass="App\Repository\SkuRepository")
 */
class Sku
{

    /**
        A unique ID.

        @ORM\Id()
        @ORM\GeneratedValue(strategy="CUSTOM")
        @ORM\Column(
            type="string",
            length=32
        )

        @ORM\CustomIdGenerator(class="App\Utils\UuidStrGenerator")
     */
    private $_UUID;

    /**
        A short title for this SKU.

        @ORM\Column(type="string", length=255)
     */
    private $_title;

    /**
        A fuller description for this SKU.

        @ORM\Column(type="text")
     */
    private $_description;

    /**
        Stores whether this SKU is currently enabled.

        @ORM\Column(type="boolean")
     */
    private $_enabled;

    /**
        The list price for this SKU.

        @ORM\Column(type="float")
     */
    private $_cost;

    public function __construct($attrs = [])
    {
        foreach ($attrs as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function getUUID()
    {
        return $this->UUID;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    public function getEnabled()
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getCost()
    {
        return $this->cost;
    }

    public function setCost(float $cost)
    {
        $this->cost = $cost;

        return $this;
    }
}
