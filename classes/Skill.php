<?php
class Skill
{
    protected string $name;
    protected string $stat;
    protected int $level;

    public function __construct(?array $form = [])
    {
        if (isset($form['name'])) {
            $this->name = trim($form['name']);
        }
        if (isset($form['stat'])) {
            $this->stat = $form['stat'];
        }
        if (isset($form['level'])) {
            $this->level = $form['level'];
        }
    }

    public function validate()
    {
        $errors = [];

        if (empty($this->name)) {
            $errors['name'] = true;
        }
        if (empty($this->stat)) {
            $errors['stat'] = true;
        }
        if (empty($this->level) || ($this->level < 0 || $this->level > 5)) {
            $errors['level'] = true;
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

    public function getStat(): string
    {
        return $this->stat;
    }

    public function setStat(string $stat): self
    {
        $this->stat = $stat;
        return $this;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;
        return $this;
    }
}