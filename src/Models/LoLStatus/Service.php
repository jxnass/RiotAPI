<?php

namespace Phil404\RiotAPI\Models\LoLStatus;

class Service
{
    private $_status;
    private $_name;
    private $_slug;
    private $_incidents;

    public function __construct(array $args = [])
    {
        if (array_key_exists("status", $args)) {
            $this->_status = $args['status'];
        }
        if (array_key_exists("name", $args)) {
            $this->_name = $args['name'];
        }
        if (array_key_exists("slug", $args)) {
            $this->_slug = $args['slug'];
        }
        if (array_key_exists("incidents", $args)) {
            $this->setIncidents($args['incidents']);
        }
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status)
    {
        $this->_status = $status;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->_status;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->_name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug)
    {
        $this->_slug = $slug;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->_slug;
    }

    /**
     * @param array $incidents
     */
    public function setIncidents(array $incidents)
    {
        $qualifiedIncidents = [];
        if (sizeof($incidents) >= 1) {
            foreach ($incidents as $incident) {
                $counter = sizeof($qualifiedIncidents);
                if ($incident instanceof Incident) {
                    $qualifiedIncidents[$counter] = $incident;
                } else {
                    $createdIncident = new Incident($incident);
                    if ($createdIncident != null) {
                        $qualifiedIncidents[$counter] = $createdIncident;
                    }
                }
            }
        }
        $this->_incidents = $qualifiedIncidents;
    }

    /**
     * @return array
     */
    public function getIncidents()
    {
        return $this->_incidents;
    }
}