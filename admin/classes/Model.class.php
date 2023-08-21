<?php 

class Model extends DBconnect{

    function paginate($cols = '*', $filter = true, $start_from, $results_per_page)
    {
        return $this->getDataPaginate($this->table, $cols, $filter, $start_from, $results_per_page );
    }


    function count($filter)
    {
        return $this->getCountData($this->table, $filter);
    }


    function get($cols = '*', $filter = true)
    {
        return $this->getData($this->table, $cols, $filter);
    }

    function getRowCount($cols = '*', $filter = true)
    {
        return $this->getRowCountData($this->table, $cols, $filter);
    }



    function insert($data)
    {
        return $this->create($this->table, $data);
    }



    function update($data, $filter = true)
    {
        return $this->edit($this->table, $data, $filter);
    }


    function delete($filter = true)
    {
        return $this->destroy($this->table, $filter);
    }
}