<?php
class Character
{
    protected int $character_id;
    protected int $player_id;
    protected string $character_name = '';
    protected string $character_creation_date = '';
    protected int $initiative = 0;
    protected int $pvmax = 0;
    protected int $pvcur = 0;
    protected int $pmmax = 0;
    protected int $pmcur = 0;
    protected int $strength = 0;
    protected int $dexterity = 0;
    protected int $constitution = 0;
    protected int $intelligence = 0;
    protected int $wisdom = 0;
    protected int $luck = 0;
    /** stat = sum of stats only for creation*/
    protected int $stat = 0;

    // Constructor
    public function __construct(?array $form = [])
    {
        $this->update($form);
    }

    public function update(array $form = []) :self
    {
        if (!empty($form)) {
            if (isset($form['name'])) {
                $this->character_name = trim($form['name']);
            }
            if (!empty($form['initiative'])) {
                $this->initiative = $form['initiative'];
            }
            if (!empty($form['pvmax'])) {
                $this->pvmax = $form['pvmax'];
                $this->pvcur = $this->pvmax;
            }
            if (!empty($form['pvcur'])) {
                $this->pvcur = $form['pvcur'];
            }
            if (!empty($form['pmmax'])) {
                $this->pmmax = $form['pmmax'];
                $this->pmcur = $this->pmmax;
            }
            if (!empty($form['pmcur'])) {
                $this->pmcur = $form['pmcur'];
            }
            if (!empty($form['strength'])) {
                $this->strength = $form['strength'];
            }
            if (!empty($form['dexterity'])) {
                $this->dexterity = $form['dexterity'];
            }
            if (!empty($form['constitution'])) {
                $this->constitution = $form['constitution'];
            }
            if (!empty($form['intelligence'])) {
                $this->intelligence = $form['intelligence'];
            }
            if (!empty($form['wisdom'])) {
                $this->wisdom = $form['wisdom'];
            }
            if (!empty($form['luck'])) {
                $this->luck = $form['luck'];
            }
        }
        return $this;
    }

    //Validate function
    public function validate(bool $isCreate = true): array
    {
        $errors = [];
        if (empty($this->character_name)) {
            $errors['name'] = true;
        }
        if (empty($this->initiative) || $this->initiative > 10) {
            $errors['initiative'] = true;
        }
        if (empty($this->pvmax)) {
            $errors['pvmax'] = true;
        }
        if (empty($this->pmmax)) {
            $errors['pmmax'] = true;
        }
        if (empty($this->strength) || $this->strength > 20) {
            $errors['strength'] = true;
        }
        if (empty($this->dexterity) || $this->dexterity > 20) {
            $errors['dexterity'] = true;
        }
        if (empty($this->constitution) || $this->constitution > 20) {
            $errors['constitution'] = true;
        }
        if (empty($this->intelligence) || $this->intelligence > 20) {
            $errors['intelligence'] = true;
        }
        if (empty($this->wisdom) || $this->wisdom > 20) {
            $errors['wisdom'] = true;
        }
        if (empty($this->luck) || $this->luck > 20) {
            $errors['luck'] = true;
        }

        $this->stat = intval($this->strength) + intval($this->dexterity) + intval($this->constitution) + intval($this->intelligence) + intval($this->wisdom) + intval($this->luck);

        //Check for sum of stats at Character Creation
        if ($isCreate && ($this->stat < 60 || $this->stat > 80)) {
            $errors['stat'] = true;
        }
        //Check for current Pv and PM at Character Update
        if (!$isCreate && (empty($this->pvcur) || $this->pvcur > $this->pvmax)) {
            $errors['pvcur'] = true;
        }
        if (!$isCreate && (empty($this->pmcur) || $this->pmcur > $this->pmmax)) {
            $errors['pmcur'] = true;
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

    public function getInitiative(): int
    {
        return $this->initiative;
    }

    public function setInitiative(int $initiative): self
    {
        $this->initiative = $initiative;
        return $this;
    }

    public function getPvmax(): int
    {
        return $this->pvmax;
    }

    public function setPvmax(int $pvmax): self
    {
        $this->pvmax = $pvmax;
        return $this;
    }

    public function getPmmax(): int
    {
        return $this->pmmax;
    }

    public function setPmmax(int $pmmax): self
    {
        $this->pmmax = $pmmax;
        return $this;
    }

    public function getStrength(): int
    {
        return $this->strength;
    }

    public function setStrength(int $strength): self
    {
        $this->strength = $strength;
        return $this;
    }

    public function getDexterity(): int
    {
        return $this->dexterity;
    }

    public function setDexterity(int $dexterity): self
    {
        $this->dexterity = $dexterity;
        return $this;
    }

    public function getConstitution(): int
    {
        return $this->constitution;
    }

    public function setConstitution(int $constitution): self
    {
        $this->constitution = $constitution;
        return $this;
    }

    public function getIntelligence(): int
    {
        return $this->intelligence;
    }

    public function setIntelligence(int $intelligence): self
    {
        $this->intelligence = $intelligence;
        return $this;
    }

    public function getWisdom(): int
    {
        return $this->wisdom;
    }

    public function setWisdom(int $wisdom): self
    {
        $this->wisdom = $wisdom;
        return $this;
    }

    public function getLuck(): int
    {
        return $this->luck;
    }

    public function setLuck(int $luck): self
    {
        $this->luck = $luck;
        return $this;
    }

    public function getPvcur(): int
    {
        return $this->pvcur;
    }

    public function setPvcur(int $pvcur): self
    {
        $this->pvcur = $pvcur;
        return $this;
    }

    public function getPmcur(): int
    {
        return $this->pmcur;
    }

    public function setPmcur(int $pmcur): self
    {
        $this->pmcur = $pmcur;
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
}