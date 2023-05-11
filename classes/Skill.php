<?php
class Skill
{
    protected string $skill_name = '';
    protected int $statistic_id = 0;
    protected int $skill_level = 0;
    protected ?int $skill_id;
    protected ?int $player_id;
    
    public function __construct(?array $form = [])
    {
        if (isset($form['name'])) {
            $this->skill_name = trim($form['name']);
        }
        if (isset($form['stat'])) {
            $this->statistic_id = intval($form['stat']);
        }
        if (isset($form['level'])) {
            $this->skill_level = $form['level'];
        }
    }

    public function validate(): array
    {
        $errors = [];

        if (empty($this->skill_name)) {
            $errors['name'] = true;
        }
        if (empty($this->statistic_id)) {
            $errors['stat'] = true;
        }
        if ($this->skill_level < 0 || $this->skill_level > 5) {
            $errors['level'] = true;
        }
        return $errors;
    }

    // GET SET
    public function getName(): string
    {
        return $this->skill_name;
    }

    public function setName(string $name): self
    {
        $this->skill_name = $name;
        return $this;
    }

    public function getStatId(): int
    {
        return $this->statistic_id;
    }

    public function setStatId(int $statId): self
    {
        $this->statistic_id = $statId;
        return $this;
    }

    public function getLevel(): int
    {
        return $this->skill_level;
    }

    public function setLevel(int $level): self
    {
        $this->skill_level = $level;
        return $this;
    }
	public function getSkillId(): ?int {
		return $this->skill_id;
	}
	
	public function setSkillId(?int $skillId): self {
		$this->skill_id = $skillId;
		return $this;
	}

	public function getPlayerId(): ?int {
		return $this->player_id;
	}
	
	public function setPlayerId(?int $playerId): self {
		$this->player_id = $playerId;
		return $this;
	}
}