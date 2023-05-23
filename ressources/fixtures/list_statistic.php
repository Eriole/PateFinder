<?php
spl_autoload_register(function ($class) {
    require_once "../../classes/$class.php";
});

$statistics = [
    (new Statistic())
        ->setName('Initiative')
        ->setShortname('INIT')
        ->setQuantity(10)
        ->setInSum(false)
        ->setEditable(false),
    (new Statistic())
        ->setName('Points de vie max')
        ->setShortname('PVmax')
        ->setQuantity(250)
        ->setInSum(false)
        ->setEditable(false),
    (new Statistic())
        ->setName('Points de vie actuels')
        ->setShortname('PVact')
        ->setQuantity(250)
        ->setInSum(false)
        ->setEditable(true),
    (new Statistic())
        ->setName('Points de magie max')
        ->setShortname('PMmax')
        ->setQuantity(250)
        ->setInSum(false)
        ->setEditable(false),
    (new Statistic())
        ->setName('Points de magie actuels')
        ->setShortname('PMact')
        ->setQuantity(250)
        ->setInSum(false)
        ->setEditable(true),
    (new Statistic())
        ->setName('Force')
        ->setShortname('FOR')
        ->setQuantity(20)
        ->setInSum(true)
        ->setEditable(false),
    (new Statistic())
        ->setName('Dexterite')
        ->setShortname('DEX')
        ->setQuantity(20)
        ->setInSum(true)
        ->setEditable(false),
    (new Statistic())
        ->setName('Constitution')
        ->setShortname('CONST')
        ->setQuantity(20)
        ->setInSum(true)
        ->setEditable(false),
    (new Statistic())
        ->setName('Intelligence')
        ->setShortname('INT')
        ->setQuantity(20)
        ->setInSum(true)
        ->setEditable(false),
    (new Statistic())
        ->setName('Sagesse')
        ->setShortname('SAG')
        ->setQuantity(20)
        ->setInSum(true)
        ->setEditable(false),
    (new Statistic())
        ->setName('Chance')
        ->setShortname('CHA')
        ->setQuantity(20)
        ->setInSum(true)
        ->setEditable(false),
];