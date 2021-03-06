<?php

/**
 * Kolab storage cache class for task objects
 *
 * @author Thomas Bruederli <bruederli@kolabsys.com>
 *
 * Copyright (C) 2013, Kolab Systems AG <contact@kolabsys.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

class kolab_storage_cache_task extends kolab_storage_cache
{
    protected $extra_cols = array('dtstart','dtend');

    /**
     * Helper method to convert the given Kolab object into a dataset to be written to cache
     *
     * @override
     */
    protected function _serialize($object)
    {
        $sql_data = parent::_serialize($object) + array('dtstart' => null, 'dtend' => null);

        if ($object['start'])
            $sql_data['dtstart'] = is_object($object['start']) ? $object['start']->format(self::DB_DATE_FORMAT) : date(self::DB_DATE_FORMAT, $object['start']);
        if ($object['due'])
            $sql_data['dtend']   = is_object($object['due'])   ? $object['due']->format(self::DB_DATE_FORMAT)   : date(self::DB_DATE_FORMAT, $object['due']);

        return $sql_data;
    }
}