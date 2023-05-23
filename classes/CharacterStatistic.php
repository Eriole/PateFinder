<?php
class CharacterStatistic
{
    protected int $character_id = 0;
    protected int $statistic_id = 0;
    protected int $current_statistic = 0;



    public function __construct(?int $characId = null, ?int $statId = null, ?int $statValue = null)
    {
        if ($characId != null) {
            $this->character_id = $characId;
        }
        if ($statId != null) {
            $this->statistic_id = $statId;
        }
        if ($statValue != null) {
            $this->current_statistic = intval($statValue);
        }
    }


    //Validate function
    public function validate(Statistic $statistic): bool
    {
        return $this->current_statistic >= 0
            && $this->current_statistic <= $statistic->getQuantity();
    }


    public function getCharacter_id(): int
    {
        return $this->character_id;
    }

    public function setCharacter_id(int $character_id): self
    {
        $this->character_id = $character_id;
        return $this;
    }

    public function getStatistic_id(): int
    {
        return $this->statistic_id;
    }

    public function setStatistic_id(int $statistic_id): self
    {
        $this->statistic_id = $statistic_id;
        return $this;
    }

    public function getCurrent_statistic(): int
    {
        return $this->current_statistic;
    }

    public function setCurrent_statistic(int $current_statistic): self
    {
        $this->current_statistic = $current_statistic;
        return $this;
    }
}