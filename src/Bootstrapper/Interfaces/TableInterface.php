<?php

namespace Bootstrapper\Interfaces;

/**
 * Interface for objects that are being displayed in a table
 *
 * @package Bootstrapper\Interfaces
 */
interface TableInterface
{

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders();

    /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header);
}
