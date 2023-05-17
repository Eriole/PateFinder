<?php
class CharacterStatistic
{
    protected int $character_id;
    protected int $statistic_id;
    protected int $current_statistic;

    public function __construct(array $data = [])
    {
        if (!empty($data['character_id'])) {
            $this->character_id = $data['character_id'];
        }
        if (!empty($data['statistic_id'])) {
            $this->statistic_id = $data['statistic_id'];
        }
        if (!empty($data['current_statistic'])) {
            $this->current_statistic = $data['current_statistic'];
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