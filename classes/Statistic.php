<?php
class Statistic
{
	protected int $statistic_id;
	protected string $statistic_name;
	protected string $statistic_shortname;
	protected int $statistic_quantity;
	protected bool $inSum = false;
	protected bool $editable = false;

	public function getName(): string
	{
		return $this->statistic_name;
	}

	public function setName(string $statistic_name): self
	{
		$this->statistic_name = $statistic_name;
		return $this;
	}

	public function getShortname(): string
	{
		return $this->statistic_shortname;
	}

	public function setShortname(string $statistic_shortname): self
	{
		$this->statistic_shortname = $statistic_shortname;
		return $this;
	}

	public function getQuantity(): int
	{
		return $this->statistic_quantity;
	}

	public function setQuantity(int $statistic_quantity): self
	{
		$this->statistic_quantity = $statistic_quantity;
		return $this;
	}

	public function getId(): int
	{
		return $this->statistic_id;
	}

	public function setId(int $statistic_id): self
	{
		$this->statistic_id = $statistic_id;
		return $this;
	}

	public function getInSum(): bool
	{
		return $this->inSum;
	}

	public function setInSum(bool $inSum): self
	{
		$this->inSum = $inSum;
		return $this;
	}

	public function getEditable(): bool {
		return $this->editable;
	}
	
	public function setEditable(bool $editable): self {
		$this->editable = $editable;
		return $this;
	}
}