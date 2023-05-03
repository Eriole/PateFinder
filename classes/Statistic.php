<?php
class Statistic 
{
    protected string $name;
    protected string $shortname;
    protected int $quantity;

	public function getName(): string {
		return $this->name;
	}
	
	public function setName(string $name): self {
		$this->name = $name;
		return $this;
	}

	public function getShortname(): string {
		return $this->shortname;
	}
	
	public function setShortname(string $shortname): self {
		$this->shortname = $shortname;
		return $this;
	}

	public function getQuantity(): int {
		return $this->quantity;
	}

	public function setQuantity(int $quantity): self {
		$this->quantity = $quantity;
		return $this;
	}
}