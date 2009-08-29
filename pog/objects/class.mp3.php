<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `mp3` (
	`mp3id` int(11) NOT NULL auto_increment,
	`path` TEXT NOT NULL,
	`filename` TEXT NOT NULL,
	`artist` VARCHAR(255) NOT NULL,
	`title` VARCHAR(255) NOT NULL,
	`album` VARCHAR(255) NOT NULL, PRIMARY KEY  (`mp3id`)) ENGINE=MyISAM;
*/

/**
* <b>Mp3</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.0e / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=Mp3&attributeList=array+%28%0A++0+%3D%3E+%27path%27%2C%0A++1+%3D%3E+%27filename%27%2C%0A++2+%3D%3E+%27artist%27%2C%0A++3+%3D%3E+%27title%27%2C%0A++4+%3D%3E+%27album%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27TEXT%27%2C%0A++1+%3D%3E+%27TEXT%27%2C%0A++2+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++3+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++4+%3D%3E+%27VARCHAR%28255%29%27%2C%0A%29
*/
include_once('class.pog_base.php');
class Mp3 extends POG_Base
{
	public $mp3Id = '';

	/**
	 * @var TEXT
	 */
	public $path;
	
	/**
	 * @var TEXT
	 */
	public $filename;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $artist;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $title;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $album;
	
	public $pog_attribute_type = array(
		"mp3Id" => array('db_attributes' => array("NUMERIC", "INT")),
		"path" => array('db_attributes' => array("TEXT", "TEXT")),
		"filename" => array('db_attributes' => array("TEXT", "TEXT")),
		"artist" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"title" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"album" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		);
	public $pog_query;
	
	
	/**
	* Getter for some private attributes
	* @return mixed $attribute
	*/
	public function __get($attribute)
	{
		if (isset($this->{"_".$attribute}))
		{
			return $this->{"_".$attribute};
		}
		else
		{
			return false;
		}
	}
	
	function Mp3($path='', $filename='', $artist='', $title='', $album='')
	{
		$this->path = $path;
		$this->filename = $filename;
		$this->artist = $artist;
		$this->title = $title;
		$this->album = $album;
	}
	
	
	/**
	* Gets object from database
	* @param integer $mp3Id 
	* @return object $Mp3
	*/
	function Get($mp3Id)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `mp3` where `mp3id`='".intval($mp3Id)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->mp3Id = $row['mp3id'];
			$this->path = $this->Unescape($row['path']);
			$this->filename = $this->Unescape($row['filename']);
			$this->artist = $this->Unescape($row['artist']);
			$this->title = $this->Unescape($row['title']);
			$this->album = $this->Unescape($row['album']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $mp3List
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `mp3` ";
		$mp3List = Array();
		if (sizeof($fcv_array) > 0)
		{
			$this->pog_query .= " where ";
			for ($i=0, $c=sizeof($fcv_array); $i<$c; $i++)
			{
				if (sizeof($fcv_array[$i]) == 1)
				{
					$this->pog_query .= " ".$fcv_array[$i][0]." ";
					continue;
				}
				else
				{
					if ($i > 0 && sizeof($fcv_array[$i-1]) != 1)
					{
						$this->pog_query .= " AND ";
					}
					if (isset($this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes']) && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'SET')
					{
						if ($GLOBALS['configuration']['db_encoding'] == 1)
						{
							$value = POG_Base::IsColumn($fcv_array[$i][2]) ? "BASE64_DECODE(".$fcv_array[$i][2].")" : "'".$fcv_array[$i][2]."'";
							$this->pog_query .= "BASE64_DECODE(`".$fcv_array[$i][0]."`) ".$fcv_array[$i][1]." ".$value;
						}
						else
						{
							$value =  POG_Base::IsColumn($fcv_array[$i][2]) ? $fcv_array[$i][2] : "'".$this->Escape($fcv_array[$i][2])."'";
							$this->pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." ".$value;
						}
					}
					else
					{
						$value = POG_Base::IsColumn($fcv_array[$i][2]) ? $fcv_array[$i][2] : "'".$fcv_array[$i][2]."'";
						$this->pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." ".$value;
					}
				}
			}
		}
		if ($sortBy != '')
		{
			if (isset($this->pog_attribute_type[$sortBy]['db_attributes']) && $this->pog_attribute_type[$sortBy]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$sortBy]['db_attributes'][0] != 'SET')
			{
				if ($GLOBALS['configuration']['db_encoding'] == 1)
				{
					$sortBy = "BASE64_DECODE($sortBy) ";
				}
				else
				{
					$sortBy = "$sortBy ";
				}
			}
			else
			{
				$sortBy = "$sortBy ";
			}
		}
		else
		{
			$sortBy = "mp3id";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$mp3 = new $thisObjectName();
			$mp3->mp3Id = $row['mp3id'];
			$mp3->path = $this->Unescape($row['path']);
			$mp3->filename = $this->Unescape($row['filename']);
			$mp3->artist = $this->Unescape($row['artist']);
			$mp3->title = $this->Unescape($row['title']);
			$mp3->album = $this->Unescape($row['album']);
			$mp3List[] = $mp3;
		}
		return $mp3List;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $mp3Id
	*/
	function Save()
	{
		$connection = Database::Connect();
		$this->pog_query = "select `mp3id` from `mp3` where `mp3id`='".$this->mp3Id."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows > 0)
		{
			$this->pog_query = "update `mp3` set 
			`path`='".$this->Escape($this->path)."', 
			`filename`='".$this->Escape($this->filename)."', 
			`artist`='".$this->Escape($this->artist)."', 
			`title`='".$this->Escape($this->title)."', 
			`album`='".$this->Escape($this->album)."' where `mp3id`='".$this->mp3Id."'";
		}
		else
		{
			$this->pog_query = "insert into `mp3` (`path`, `filename`, `artist`, `title`, `album` ) values (
			'".$this->Escape($this->path)."', 
			'".$this->Escape($this->filename)."', 
			'".$this->Escape($this->artist)."', 
			'".$this->Escape($this->title)."', 
			'".$this->Escape($this->album)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->mp3Id == "")
		{
			$this->mp3Id = $insertId;
		}
		return $this->mp3Id;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $mp3Id
	*/
	function SaveNew()
	{
		$this->mp3Id = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `mp3` where `mp3id`='".$this->mp3Id."'";
		return Database::NonQuery($this->pog_query, $connection);
	}
	
	
	/**
	* Deletes a list of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param bool $deep 
	* @return 
	*/
	function DeleteList($fcv_array)
	{
		if (sizeof($fcv_array) > 0)
		{
			$connection = Database::Connect();
			$pog_query = "delete from `mp3` where ";
			for ($i=0, $c=sizeof($fcv_array); $i<$c; $i++)
			{
				if (sizeof($fcv_array[$i]) == 1)
				{
					$pog_query .= " ".$fcv_array[$i][0]." ";
					continue;
				}
				else
				{
					if ($i > 0 && sizeof($fcv_array[$i-1]) !== 1)
					{
						$pog_query .= " AND ";
					}
					if (isset($this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes']) && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'SET')
					{
						$pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$this->Escape($fcv_array[$i][2])."'";
					}
					else
					{
						$pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$fcv_array[$i][2]."'";
					}
				}
			}
			return Database::NonQuery($pog_query, $connection);
		}
	}
}
?>