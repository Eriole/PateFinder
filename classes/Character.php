<?php
class Character
{
    protected string $name = '';
    protected int $initiative = 0;
    protected int $pvmax = 0;
    protected int $pmmax = 0;
    protected int $strength = 0;
    protected int $dexterity = 0;
    protected int $constitution = 0;
    protected int $intelligence = 0;
    protected int $wisdom = 0;
    protected int $luck = 0;
    protected int $stat = 0;


    // Constructor
    public function __construct(?array $form = [])
    {
        if (!empty($form)) {
            if (isset($form['name'])) {
                $this->name = trim($form['name']);
            }
            if (!empty($form['initiative'])) {
                $this->initiative = $form['initiative'];
            }
            if (!empty($form['pvmax'])) {
                $this->pvmax = $form['pvmax'];
            }
            if (!empty($form['pmmax'])) {
                $this->pmmax = $form['pmmax'];
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
    }

    public function validate(): array
    {
        $errors = [];
        if (empty($this->name)) {
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

        if ($this->stat < 60 || $this->stat > 80) {
            $errors['stat'] = true;
        }
        return $errors;
    }

    // GET SET
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
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
}