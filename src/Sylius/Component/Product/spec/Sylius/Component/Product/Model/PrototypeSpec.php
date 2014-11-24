<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Component\Product\Model;

use Doctrine\Common\Collections\Collection;
use PhpSpec\ObjectBehavior;
use Sylius\Component\Product\Model\AttributeInterface;
use Sylius\Component\Product\Model\PrototypeInterface;


/**
 * @author Paweł Jędrzejewski <pawel@sylius.org>
 */
class PrototypeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Sylius\Component\Product\Model\Prototype');
    }

    function it_implements_Sylius_product_prototype_interface()
    {
        $this->shouldImplement('Sylius\Component\Product\Model\PrototypeInterface');
    }

    function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    function it_has_no_name_by_default()
    {
        $this->getName()->shouldReturn(null);
    }

    function its_name_is_mutable()
    {
        $this->setName('T-Shirt size');
        $this->getName()->shouldReturn('T-Shirt size');
    }

    function it_initializes_attribute_collection_by_default()
    {
        $this->getAttributes()->shouldHaveType('Doctrine\Common\Collections\Collection');
    }

    function its_attribute_collection_is_mutable(Collection $attributes)
    {
        $this->setAttributes($attributes);
        $this->getAttributes()->shouldReturn($attributes);
    }

    function it_adds_attribute(AttributeInterface $attribute)
    {
        $this->addAttribute($attribute);
        $this->hasAttribute($attribute)->shouldReturn(true);
    }

    function it_removes_attribute(AttributeInterface $attribute)
    {
        $this->addAttribute($attribute);
        $this->hasAttribute($attribute)->shouldReturn(true);

        $this->removeAttribute($attribute);
        $this->hasAttribute($attribute)->shouldReturn(false);
    }

    function it_initializes_creation_date_by_default()
    {
        $this->getCreatedAt()->shouldHaveType('DateTime');
    }

    function its_creation_date_is_mutable()
    {
        $date = new \DateTime();

        $this->setCreatedAt($date);
        $this->getCreatedAt()->shouldReturn($date);
    }

    function it_has_no_last_update_date_by_default()
    {
        $this->getUpdatedAt()->shouldReturn(null);
    }

    function its_last_update_date_is_mutable()
    {
        $date = new \DateTime();

        $this->setUpdatedAt($date);
        $this->getUpdatedAt()->shouldReturn($date);
    }

    function it_has_fluent_interface(Collection $attributes, AttributeInterface $attribute, PrototypeInterface $prototype)
    {
        $date = new \DateTime();

        $this->setName('T-Shirt')->shouldReturn($this);
        $this->setAttributes($attributes)->shouldReturn($this);
        $this->addAttribute($attribute)->shouldReturn($this);
        $this->removeAttribute($attribute)->shouldReturn($this);
        $this->setCreatedAt($date)->shouldReturn($this);
        $this->setUpdatedAt($date)->shouldReturn($this);
        $this->setParent($prototype)->shouldReturn($this);
        $this->addChild($prototype)->shouldReturn($this);
        $this->removeChild($prototype)->shouldReturn($this);
    }


    function it_has_no_parent_by_default()
    {
        $this->getParent()->shouldReturn(null);
    }

    function its_parent_is_mutable(PrototypeInterface $prototype)
    {
        $this->setParent($prototype);
        $this->getParent()->shouldReturn($prototype);
    }

    function it_is_root_by_default()
    {
        $this->shouldBeRoot();
    }

    function it_is_not_root_when_has_parent(PrototypeInterface $prototype)
    {
        $this->setParent($prototype);
        $this->shouldNotBeRoot();
    }

    function it_is_root_when_has_no_parent(PrototypeInterface $prototype)
    {
        $this->shouldBeRoot();

        $this->setParent($prototype);
        $this->shouldNotBeRoot();

        $this->setParent(null);
        $this->shouldBeRoot();
    }

    function it_allows_to_add_child(PrototypeInterface $prototype)
    {
        $this->hasChild($prototype)->shouldReturn(false);

        $prototype->setParent($this)->shouldBeCalled();
        $this->addChild($prototype);
        $this->hasChild($prototype)->shouldReturn(true);
    }

    function it_allows_to_remove_child(PrototypeInterface $prototype)
    {
        $this->hasChild($prototype)->shouldReturn(false);

        $prototype->setParent($this)->shouldBeCalled();
        $this->addChild($prototype);

        $this->hasChild($prototype)->shouldReturn(true);

        $prototype->setParent(null)->shouldBeCalled();
        $this->removeChild($prototype);

        $this->hasChild($prototype)->shouldReturn(false);
    }
}
