<?php
class Statistic 
{
    protected int $statistic_id;
    protected string $statistic_name;
    protected string $statistic_shortname;
    protected int $statistic_quantity;

	public function getName(): string {
		return $this->statistic_name;
	}
	
	public function setName(string $statistic_name): self {
		$this->statistic_name = $statistic_name;
		return $this;
	}

	public function getShortname(): string {
<<<<<<< HEAD
		return $this->statistic_shortname;
	}
	
	public function setShortname(string $statistic_shortname): self {
		$this->statistic_shortname = $statistic_shortname;
=======
		return $this->shortname;
	}
	
	public function setShortname(string $shortname): self {
		$this->shortname = $shortname;
>>>>>>> 4bfc610 (F3-Ajout lien BDD Fixture et Insert Stat et Character)
		return $this;
	}

	public function getQuantity(): int {
<<<<<<< HEAD
		return $this->statistic_quantity;
	}

	public function setQuantity(int $statistic_quantity): self {
		$this->statistic_quantity = $statistic_quantity;
		return $this;
	}

	public function getId(): int {
		return $this->statistic_id;
	}
	
	public function setId(int $statistic_id): self {
		$this->statistic_id = $statistic_id;
=======
		return $this->quantity;
	}

	public function setQuantity(int $quantity): self {
		$this->quantity = $quantity;
>>>>>>> 4bfc610 (F3-Ajout lien BDD Fixture et Insert Stat et Character)
		return $this;
	}
}