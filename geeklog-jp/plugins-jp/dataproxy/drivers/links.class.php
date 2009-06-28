<?php
//
// +---------------------------------------------------------------------------+
// | Data Proxy Plugin for Geeklog - The Ultimate Weblog                       |
// +---------------------------------------------------------------------------+
// | geeklog/plugins/dataproxy/drivers/links.class.php                         |
// +---------------------------------------------------------------------------+
// | Copyright (C) 2007-2008 mystral-kk - geeklog AT mystral-kk DOT net        |
// |                                                                           |
// | Constructed with the Universal Plugin                                     |
// | Copyright (C) 2002 by the following authors:                              |
// | Tom Willett                 -    twillett@users.sourceforge.net           |
// | Blaine Lang                 -    langmail@sympatico.ca                    |
// | The Universal Plugin is based on prior work by:                           |
// | Tony Bibbs                  -    tony@tonybibbs.com                       |
// +---------------------------------------------------------------------------+
// |                                                                           |
// | This program is free software; you can redistribute it and/or             |
// | modify it under the terms of the GNU General Public License               |
// | as published by the Free Software Foundation; either version 2            |
// | of the License, or (at your option) any later version.                    |
// |                                                                           |
// | This program is distributed in the hope that it will be useful,           |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of            |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             |
// | GNU General Public License for more details.                              |
// |                                                                           |
// | You should have received a copy of the GNU General Public License         |
// | along with this program; if not, write to the Free Software Foundation,   |
// | Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.           |
// |                                                                           |
// +---------------------------------------------------------------------------+

if (strpos(strtolower($_SERVER['PHP_SELF']), 'links.class.php') !== false) {
    die('This file can not be used on its own.');
}

/**
* Links plugin supports URL rwrite in individual links but doesn't do so in
* categories, e.g.:
*
* link     (off) http://www.example.com/links/portal.php?what=link&amp;item=geeklog.net
*          (on)  http://www.example.com/links/portal.php/link/geeklog.net
* category (off) http://www.example.com/links/index.php?category=geeklog-site
*          (on)  http://www.example.com/links/index.php?category=geeklog-site
*/

class Dataproxy_links extends DataproxyDriver
{
	var $driver_name = 'links';
	
	/*
	* Returns the location of index.php of each plugin
	*/
	function getEntryPoint()
	{
		global $_CONF;
		
		return $_CONF['site_url'] . '/links/index.php';
	}
	
	/**
	* @param $pid int/string/boolean id of the parent category.  False means
	*        the top category (with no parent)
	* @return array(
	*   'id'        => $id (string),
	*   'pid'       => $pid (string: id of its parent)
	*   'title'     => $title (string),
	*   'uri'       => $uri (string),
	*   'date'      => $date (int: Unix timestamp),
	*   'image_uri' => $image_uri (string)
	*  )
	*/	
	function getChildCategories($pid = false, $all_langs = false)
	{
		global $_CONF, $_TABLES;
		
		if (version_compare(VERSION, '1.5.0') < 0) {
			$entries = array();
			if ($pid !== false) {
				return $entries;
			}
			
			$sql = "SELECT DISTINCT category "
				 . "FROM {$_TABLES['links']} ";
			if ($this->uid > 0) {
				$sql .= COM_getPermSQL('WHERE', $this->uid);
			}
			$sql .= " ORDER BY category";
			$result = DB_query($sql);
			if (DB_error()) {
				return $entries;
			}
			
			while (($A = DB_fetchArray($result, false)) !== false) {
				$entry = array();
				
				$entry['id']        = stripslashes($A['category']);
				$entry['pid']       = false;
				$entry['title']     = $entry['id'];
				$entry['uri']       = $_CONF['site_url'] .  '/links/index.php?category='
									. urlencode($this->toUtf8($entry['id']));
				$entry['date']      = false;
				$entry['image_uri'] = false;
				$entries[] = $entry;
			}
			
			return $entries;
		} else {	// for GL-1.5.0+
			$entries = array();
			$sql = "SELECT * "
				 . "FROM {$_TABLES['linkcategories']} ";
			if ($pid === false) {
				$pid = 'site';
			}
			$sql .= "WHERE (pid = '" . addslashes($pid) . "') ";
			
			if ($this->uid > 0) {
				$sql .= COM_getPermSQL('AND', $this->uid);
			}
			$result = DB_query($sql);
			if (DB_error()) {
				return $entries;
			}
			
			while (($A = DB_fetchArray($result, false)) !== false) {
				$entry = array();
				$A = array_map('stripslashes', $A);
				
				$entry['id']        = $A['cid'];
				$entry['pid']       = $A['pid'];
				$entry['title']     = $A['category'];
				$entry['uri']       = $_CONF['site_url'] . '/links/index.php?category='
									. urlencode($this->toUtf8($entry['id']));
				$entry['date']      = strtotime($A['modified']);
				$entry['image_uri'] = false;
				$entry['raw_data']  = $A;
				$entries[] = $entry;
			}
			return $entries;
		}
	}
	
	/**
	* Returns array of (
	*   'id'        => $id (string),
	*   'title'     => $title (string),
	*   'uri'       => $uri (string),
	*   'date'      => $date (int: Unix timestamp),
	*   'image_uri' => $image_uri (string),
	*   'raw_data'  => raw data of the item (stripslashed)
	* )
	*/
	function getItemById($id, $all_langs = false)
	{
	    global $_CONF, $_TABLES;
		
		$retval = array();
		
		$sql = "SELECT * "
			 . "FROM {$_TABLES['links']} "
			 . "WHERE (lid ='" . addslashes($id) . "') ";
		if ($this->uid > 0) {
			$sql .= COM_getPermSQL('AND', $this->uid);
		}
		$result = DB_query($sql);
		if (DB_error()) {
			return $retval;
		}
		
		if (DB_numRows($result) == 1) {
			$A = DB_fetchArray($result, false);
			$A = array_map('stripslashes', $A);
			
			$retval['id']        = $id;
			$retval['title']     = $A['title'];
			$retval['uri']       = COM_buildURL(
					$_CONF['site_url'] . '/links/portal.php?what=link&amp;item='
					. urlencode($this->toUtf8($entry['id']))
			);	// GL uses urlencode()
			$retval['date']      = strtotime($A['date']);
			$retval['image_uri'] = false;
			$retval['raw_data']  = $A;
		}
		
		return $retval;
	}
	
	/**
	* Returns an array of (
	*   'id'        => $id (string),
	*   'title'     => $title (string),
	*   'uri'       => $uri (string),
	*   'date'      => $date (int: Unix timestamp),
	*   'image_uri' => $image_uri (string)
	* )
	*/
	function getItems($category, $all_langs = false)
	{
		global $_CONF, $_TABLES;
		
		$entries = array();
		
		if (version_compare(VERSION, '1.5.0') < 0) {
			$sql  = "SELECT lid, title, UNIX_TIMESTAMP(date) AS date_u "
				  . "FROM {$_TABLES['links']} "
				  . "WHERE (category ='" . addslashes($category) . "') ";
		} else {	// for GL-1.5.0+
			$sql  = "SELECT lid, title, UNIX_TIMESTAMP(date) AS date_u "
				  . "FROM {$_TABLES['links']} "
				  . "WHERE (cid ='" . addslashes($category) . "') ";
		}
		
		if ($this->uid > 0) {
			$sql .= COM_getPermSQL('AND', $this->uid);
		}
		$sql .= "ORDER BY date_u DESC";
		$result  = DB_query($sql);
		if (DB_error()) {
			return $entries;
		}
		
		while (($A = DB_fetchArray($result, false)) !== false) {
			$entry = array();
			$A = array_map('stripslashes', $A);
			
			$entry['id']        = $A['lid'];
			$entry['title']     = $A['title'];
			$entry['uri']       = COM_buildURL(
					$_CONF['site_url'] . '/links/portal.php?what=link&amp;item='
					. urlencode($this->toUtf8($entry['id']))
			);
									// GL uses urlencode()
			$entry['date']      = $A['date_u'];
			$entry['image_uri'] = false;
			$entries[] = $entry;
		}
		
		return $entries;
	}
}
