<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\CoreBundle\Form\EventListener\Api;

use Sylius\Component\Pricing\Calculator\DelegatingCalculatorInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;

/**
 * Preset default price if not defined.
 *
 * @author Paweł Jędrzejewski <pawel@sylius.org>
 */
class DefaultUnitPriceListener implements EventSubscriberInterface
{
    /**
     * Price calculator.
     *
     * @var DelegatingCalculatorInterface
     */
    private $priceCalculator;

    /**
     * @var RepositoryInterface
     */
    private $variantRepository;

    /**
     * Constructor.
     *
     * @param DelegatingCalculatorInterface $priceCalculator
     */
    public function __construct(DelegatingCalculatorInterface $priceCalculator)
    {
        $this->priceCalculator = $priceCalculator;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT   => 'preSubmit',
        );
    }

    /**
     * Sets the price if not present.
     *
     * @param FormEvent $event
     */
    public function preSetData(FormEvent $event)
    {
        $item = $event->getData();
        $form = $event->getForm();

        if (null === $variant) {
            return;
        }
    }
}
