<?php
class Character
{
    protected int $character_id;
    protected int $player_id;
    protected string $character_name = '';
    protected string $character_creation_date = '';
    
    /** stat = sum of stats only for creation*/
    protected int $stat = 0;

    // Constructor
    public function __construct(?array $form = [])
    {
       
    }

    public function update(array $form = []): self
    {
       
    }

    //Validate function
    public function validate(bool $isCreate = true): array
    {
        
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
}