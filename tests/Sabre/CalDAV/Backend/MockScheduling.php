<?php

namespace Sabre\CalDAV\Backend;
use Sabre\DAV;
use Sabre\CalDAV;

class MockScheduling extends Mock implements SchedulingSupport {

    public $schedulingObjects = [];

    /**
     * Returns a single scheduling object.
     *
     * The returned array should contain the following elements:
     *   * uri - A unique basename for the object. This will be used to
     *           construct a full uri.
     *   * calendardata - The iCalendar object
     *   * lastmodified - The last modification date. Can be an int for a unix
     *                    timestamp, or a PHP DateTime object.
     *   * etag - A unique token that must change if the object changed.
     *   * size - The size of the object, in bytes.
     *
     * @param string $principalUri
     * @param string $objectUri
     * @return array
     */
    public function getSchedulingObject($principalUri, $objectUri) {

        if (isset($this->schedulingObjects[$principalUri][$objectUri])) {
            return $this->schedulingObjects[$principalUri][$objectUri];
        }

    }

    /**
     * Returns all scheduling objects for the inbox collection.
     *
     * These objects should be returned as an array. Every item in the array
     * should follow the same structure as returned from getSchedulingObject.
     *
     * The main difference is that 'calendardata' is optional.
     *
     * @param string $principalUri
     * @return array
     */
    public function getSchedulingObjects($principalUri) {

        if (isset($this->schedulingObjects[$principalUri])) {
            return array_values($this->schedulingObjects[$principalUri]);
        }

    }

    /**
     * Deletes a scheduling object
     *
     * @param string $principalUri
     * @param string $objectUri
     * @return void
     */
    public function deleteSchedulingObject($principalUri, $objectUri) {

        if (isset($this->schedulingObjects[$principalUri][$objectUri])) {
            unset($this->schedulingObjects[$principalUri][$objectUri]);
        }

    }

}
