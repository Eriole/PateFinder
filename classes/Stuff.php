<?php
Class Stuff
{
    protected string $name = '';
    protected int $damage = 0;
    protected int $range = 0;
    
    public function __construct(?array $form = [])
    {
        if (isset($form['name'])) {
            $this->name = trim($form['name']);
        }
        if (isset($form['damage'])) {
            $this->damage = intVal($form['damage']);
        }
        if (isset($form['range'])) {
            $this->range =  intVal($form['range']);
        }
    }

    public function validate()
    {
        $errors = [];
        if (empty($this->name)){
            $errors['name'] = true;
        }
        if ($this->damage < 0) {
            $errors['damage'] = true;
        }
        if ($this->range < 0 || $this->range > 5) {
            $errors['range'] = true;
        }

        return $errors;
    }

	public function getName(): string {
		return $this->name;
	}
	
	public function setName(string $name): self {
		$this->name = $name;
		return $this;
	}

	public function getDamage(): int {
		return $this->damage;
	}
	
	public function setDamage(int $damage): self {
		$this->damage = $damage;
		return $this;
	}
	
	public function getRange(): int {
		return $this->range;
	}
	
	public function setRange(int $range): self {
		$this->range = $range;
		return $this;
	}
}