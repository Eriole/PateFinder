<?php
class Stuff
{
    protected ?int $stuff_id;
    protected string $stuff_name = '';
    protected int $stuff_dmg = 0;
    protected int $stuff_range = 0;
    protected ?int $player_id;

    public function __construct(?array $form = [])
    {
        if (isset($form['name'])) {
            $this->stuff_name = trim($form['name']);
        }
        if (isset($form['damage'])) {
            $this->stuff_dmg = intVal($form['damage']);
        }
        if (isset($form['range'])) {
            $this->stuff_range = intVal($form['range']);
        }
    }

    public function validate(): array
    {
        $errors = [];
        if (empty($this->stuff_name)) {
            $errors['name'] = true;
        }
        if ($this->stuff_dmg < 0) {
            $errors['damage'] = true;
        }
        if ($this->stuff_range < 0 || $this->stuff_range > 5) {
            $errors['range'] = true;
        }

        return $errors;
    }

    public function getName(): string
    {
        return $this->stuff_name;
    }

    public function setName(string $name): self
    {
        $this->stuff_name = $name;
        return $this;
    }

    public function getDamage(): int
    {
        return $this->stuff_dmg;
    }

    public function setDamage(int $damage): self
    {
        $this->stuff_dmg = $damage;
        return $this;
    }

    public function getRange(): int
    {
        return $this->stuff_range;
    }

    public function setRange(int $range): self
    {
        $this->stuff_range = $range;
        return $this;
    }

    public function getStuff_id(): ?int
    {
        return $this->stuff_id;
    }

    public function setStuff_id(?int $stuff_id): self
    {
        $this->stuff_id = $stuff_id;
        return $this;
    }

    public function getPlayer_id(): ?int
    {
        return $this->player_id;
    }

    public function setPlayer_id(?int $player_id): self
    {
        $this->player_id = $player_id;
        return $this;
    }
}