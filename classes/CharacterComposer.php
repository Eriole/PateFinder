<?php
class CharacterComposer
{
    public function compose(Character $character, array $characStat): Character
    {
        foreach ($characStat as $key => $stat) {
            switch ($stat['statistic_shortname']) {
                case 'INIT':
                    $character->setInitiative($stat['current_statistic']);
                    break;
                case 'PVmax':
                    $character->setPvmax($stat['current_statistic']);
                    break;
                case 'PVact':
                    $character->setPvcur($stat['current_statistic']);
                    break;
                case 'PMmax':
                    $character->setPmmax($stat['current_statistic']);
                    break;
                case 'PMact':
                    $character->setPmcur($stat['current_statistic']);
                    break;
                case 'FOR':
                    $character->setStrength($stat['current_statistic']);
                    break;
                case 'DEX':
                    $character->setDexterity($stat['current_statistic']);
                    break;
                case 'CONST':
                    $character->setConstitution($stat['current_statistic']);
                    break;
                case 'INT':
                    $character->setIntelligence($stat['current_statistic']);
                    break;
                case 'SAG':
                    $character->setWisdom($stat['current_statistic']);
                    break;
                case 'CHA':
                    $character->setLuck($stat['current_statistic']);
                    break;
            }
        }
        return $character;
    }

    public function decompose(Character $character, array $statistics): array
    {
        $characterStatistics = [];
        foreach ($statistics as $key => $statistic) {
            switch ($statistic->getShortname()) {
                case 'INIT':
                    $characterStatistics[$statistic->getId()] = $character->getInitiative();
                    break;
                case 'PVmax':
                    $characterStatistics[$statistic->getId()] = $character->getPvmax();
                    break;
                case 'PVact':
                    $characterStatistics[$statistic->getId()] = $character->getPvcur();
                    break;
                case 'PMmax':
                    $characterStatistics[$statistic->getId()] = $character->getPmmax();
                    break;
                case 'PMact':
                    $characterStatistics[$statistic->getId()] = $character->getPmcur();
                    break;
                case 'FOR':
                    $characterStatistics[$statistic->getId()] = $character->getStrength();
                    break;
                case 'DEX':
                    $characterStatistics[$statistic->getId()] = $character->getDexterity();
                    break;
                case 'CONST':
                    $characterStatistics[$statistic->getId()] = $character->getConstitution();
                    break;
                case 'INT':
                    $characterStatistics[$statistic->getId()] = $character->getIntelligence();
                    break;
                case 'SAG':
                    $characterStatistics[$statistic->getId()] = $character->getWisdom();
                    break;
                case 'CHA':
                    $characterStatistics[$statistic->getId()] = $character->getLuck();
                    break;
            }
        }
        return $characterStatistics;
    }
}