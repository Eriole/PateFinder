<?php
spl_autoload_register(function ($class) { 
    require_once "../classes/$class.php";
});

$statistics = [
    (new Statistic())
        ->setName('Initiative')
        ->setShortname('INIT')
        ->setQuantity(10),
    (new Statistic())
        ->setName('Points de vie max')
        ->setShortname('PVmax')
        ->setQuantity(99),
    (new Statistic())
        ->setName('Points de vie actuels')
        ->setShortname('PVact')
        ->setQuantity(99),
    (new Statistic())
        ->setName('Points de magie max')
        ->setShortname('PMmax')
        ->setQuantity(99),
    (new Statistic())
        ->setName('Points de magie actuels')
        ->setShortname('PMact')
        ->setQuantity(99),
    (new Statistic())
        ->setName('Force')
        ->setShortname('FOR')
        ->setQuantity(20),
    (new Statistic())
        ->setName('Dexterite')
        ->setShortname('DEX')
        ->setQuantity(20),
    (new Statistic())
        ->setName('Constitution')
        ->setShortname('CONST')
        ->setQuantity(20),
    (new Statistic())
        ->setName('Intelligence')
        ->setShortname('INT')
        ->setQuantity(20),
    (new Statistic())
        ->setName('Sagesse')
        ->setShortname('SAG')
        ->setQuantity(20),
    (new Statistic())
        ->setName('Chance')
        ->setShortname('CHA')
        ->setQuantity(20),
];