<?php
class Character
{
    protected int $character_id;
    protected int $player_id;
    protected string $character_name = '';
    protected string $character_creation_date = '';

    /** stat = sum of stats only for creation*/
    protected int $stat = 0;

    /** @var array<Stuff> */
    protected array $stuffs = [];

    /** @var array<Skill> */
    protected array $skills = [];

    /** @var array<CharacterStatistic> */
    protected array $stats = [];

    // Constructor
    public function __construct(?array $form = [])
    {
        if (isset($form['name'])) {
            $this->character_name = trim($form['name']);
        }
        if (!empty($form['stats'])) {
            foreach ($form['stats'] as $statisticId => $currentStatistic) {
                $characterStatistic = new CharacterStatistic($statisticId, intval($currentStatistic));
                $this->addStat($characterStatistic);
            }
        }
    }

    //Validate function
    public function validate(array $statsById = [], bool $isCreate = false): array
    {
        $errors = [];
        if (empty($this->character_name)) {
            $errors['name'] = true;
        }

        $this->stat = 0;
        foreach ($this->getStats() as $charStat) {
            $statId = $charStat->getStatistic_id();
            $statFromDb = $statsById[$statId];

            if ($statFromDb->getInSum()) {
                $this->stat += $charStat->getCurrent_statistic();
            }
            if ($charStat->validate($statFromDb)) {
                $errors['stat_' . $statId] = true;
            }
        }

        if ($isCreate && ($this->stat < 60 || $this->stat > 80)) {
            $errors['stat'] = true;
        }

        return $errors;
    }

    // GET SET
    public function getName(): string
    {
        return $this->character_name;
    }

    public function setName(string $name): self
    {
        $this->character_name = $name;
        return $this;
    }


    public function getId(): int
    {
        return $this->character_id;
    }

    public function setId(int $id): self
    {
        $this->character_id = $id;
        return $this;
    }

    public function getCreationDate(): string
    {
        return $this->character_creation_date;
    }

    public function setCreationDate(string $creationDate): self
    {
        $this->character_creation_date = $creationDate;
        return $this;
    }

    public function getPlayer(): int
    {
        return $this->player_id;
    }

    public function setPlayer(int $player): self
    {
        $this->player_id = $player;
        return $this;
    }

    /**
     * 
     * @return 
     */
    public function getStuffs(): array
    {
        return $this->stuffs;
    }

    /**
     * 
     * @param  $stuffs 
     * @return self
     */
    public function setStuffs(array $stuffs): self
    {
        $this->stuffs = $stuffs;
        return $this;
    }

    /**
     * 
     * @return 
     */
    public function getSkills(): array
    {
        return $this->skills;
    }

    /**
     * 
     * @param  $skills 
     * @return self
     */
    public function setSkills(array $skills): self
    {
        $this->skills = $skills;
        return $this;
    }

    /**
     * 
     * @return array<CharacterStatistic>
     */
    public function getStats(): array
    {
        return $this->stats;
    }

    /**
     * 
     * @param  $stats 
     * @return self
     */
    public function setStats(array $stats): self
    {
        $this->stats = $stats;
        return $this;
    }

    public function addStat(CharacterStatistic $stat): self
    {
        $this->stats[$stat->getStatistic_id()] = $stat;

        return $this;
    }
    public function getStatById(int $idStat): ?CharacterStatistic
    {
        if (!isset($this->stats[$idStat])) {
            return null;
        }
        return $this->stats[$idStat];
    }
}