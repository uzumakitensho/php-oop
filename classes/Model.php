<?php
include('Connection.php');

class Model extends Connection
{
	protected $table = '';
	public $primary_key = null;
	public $columns = [];
	public $prepared_columns_array = [];
	public $prepared_columns_query = [];

	function __construct()
	{
		parent::__construct();
		$this->getTableColumns();
	}

	protected function getTableColumns()
	{
		$statement = $this->db->query('show columns from ' . $this->table);
		$result = new StdClass();
		while ($row = $statement->fetchObject()) {
			$field = $row->Field;
			$result->$field = $row;

			$this->prepared_columns_array[$field] = 'xxx';

			if($row->Key != 'PRI'){
				$this->prepared_columns_query[$field] = $field . ' = :' . $field;
			}

			if($row->Key == 'PRI'){
				$this->primary_key = $row->Field;
			}
		}

		$this->columns =  $result;
	}

	public function get()
	{
		$result = false;

		try{
			$statement = $this->db->query('select * from ' . $this->table);
			$statement->setFetchMode(PDO::FETCH_CLASS, get_class($this));
			$result = [];
			while ($row = $statement->fetchObject()) {
				$result[] = $row;
			}
		}catch(PDOException $ex){
			echo "PDOException: >> ";
			print_r($ex);
		}catch(Exception $ex){
			echo "Exception: >> ";
			print_r($ex);
		}

		return $result;
	}

	public function insert($input_columns = [])
	{
		if(count($input_columns) == 0)
			return false;

		$columns_query = [];
		foreach ($input_columns as $field => $value) {
			$columns_query[$field] = $field . ' = :' . $field;
		}

		$columns_query = implode(', ', $columns_query);
		$query = "INSERT INTO " . $this->table . " SET " . $columns_query;

		try{
			$stmt = $this->db->prepare($query);
			$stmt->execute($input_columns);
			$user = $stmt->fetch();
		}catch(PDOException $ex){
			echo "PDOException: >> ";
			print_r($ex);
		}catch(Exception $ex){
			echo "Exception: >> ";
			print_r($ex);
		}

		return true;
	}

	public function update($id = null, $input_columns = [])
	{
		if(count($input_columns) == 0)
			return false;

		if($id == null || !is_numeric($id))
			return false;

		$columns_query = [];
		foreach ($input_columns as $field => $value) {
			$columns_query[$field] = $field . ' = :' . $field;
		}

		$columns_query = implode(', ', $columns_query);
		$query = "UPDATE " . $this->table . " SET " . $columns_query;
		$query .= " WHERE " . $this->primary_key . " = " . $id;

		// return $input_columns;

		try{
			$stmt = $this->db->prepare($query);
			$stmt->execute($input_columns);
			$user = $stmt->fetch();
		}catch(PDOException $ex){
			echo "PDOException: >> ";
			print_r($ex);
		}catch(Exception $ex){
			echo "Exception: >> ";
			print_r($ex);
		}

		return true;
	}

	public function delete($id = null)
	{
		if($id == null || !is_numeric($id))
			return false;

		$query = "DELETE FROM " . $this->table . " WHERE " . $this->primary_key . " = " . $id;

		try{
			$stmt = $this->db->query($query);
			$user = $stmt->fetch();
		}catch(PDOException $ex){
			echo "PDOException: >> ";
			print_r($ex);
		}catch(Exception $ex){
			echo "Exception: >> ";
			print_r($ex);
		}

		return true;
	}

	public function find($id = null)
	{
		if($id == null || !is_numeric($id))
			return false;

		$query = "SELECT * FROM " . $this->table . " WHERE " . $this->primary_key . " = " . $id;
		$result = false;

		try{
			$statement = $this->db->query($query);
			$statement->setFetchMode(PDO::FETCH_CLASS, get_class($this));
			while ($row = $statement->fetchObject()) {
				$result = $row;
			}
		}catch(PDOException $ex){
			echo "PDOException: >> ";
			print_r($ex);
		}catch(Exception $ex){
			echo "Exception: >> ";
			print_r($ex);
		}

		return $result;
	}
}