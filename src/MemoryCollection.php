<?php

namespace Live\Collection;

/**
 * Memory collection
 *
 * @package Live\Collection
 */
class MemoryCollection implements CollectionInterface
{
    /**
     * Collection data
     *
     * @var array
     */
    protected $data;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->data = [];
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $index, $defaultValue = null)
    {
        if (!$this->has($index)) {
            return $defaultValue;
        }

        return $this->data[$index];
    }

    /**
     * {@inheritDoc}
     */
    public function set(string $index, $value, $days_to_expire = 1)
    {
        $day_to_expire_modified = (date_create())->modify("+ $days_to_expire days");
        $this->data[$index] = [ 'value' => $value, 'days_to_expire' => $day_to_expire_modified->format('Y-m-d H:i:s')];
    }

    /**
     * {@inheritDoc}
     */
    public function has(string $index)
    {
        return array_key_exists($index, $this->data);
    }

    /**
     * {@inheritDoc}
     */
    public function count(): int
    {
        return count(is_countable($this->data)? $this->data:[]);
    }

    /**
     * {@inheritDoc}
     */
    public function clean()
    {
        $this->data = null;
    }
}
