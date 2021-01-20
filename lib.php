<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * BKash enrolment plugin.
 *
 * This plugin allows you to set up paid courses.
 *
 * @package    enrol_bkash
 * @copyright  2020 Sahed Moral {smsawoncse@gmail.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * BKash enrolment plugin implementation.
 * @package    enrol_bkash
 * @copyright  2020 Sahed Moral {smsawoncse@gmail.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class enrol_bkash_plugin extends enrol_plugin {

    /**
     * @param stdClass $instance
     * @return bool
     */
    public function allow_unenrol(stdClass $instance): bool
    {
        // users with unenrol cap may unenrol other users manually - requires enrol/bkash:unenrol
        return true;
    }

    /**
     * @param stdClass $instance
     * @return bool
     */
    public function allow_manage(stdClass $instance): bool
    {
        // users with manage cap may tweak period and status - requires enrol/bkash:manage
        return true;
    }

    /**
     * Returns true if the user can add a new instance in this course.
     * @param int $courseid
     * @return boolean
     * @throws coding_exception
     */
    public function can_add_instance($courseid): bool
    {
        $context = context_course::instance($courseid, MUST_EXIST);

        if (!has_capability('moodle/course:enrolconfig', $context) or !has_capability('enrol/bkash:config', $context)) {
            return false;
        }

        // multiple instances supported - different cost for different roles
        return true;
    }

}
