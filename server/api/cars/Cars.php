<?php

class Cars extends Rest
{

    public function getCars()
    {
        $db = Db::getInstance();
        $result = $db->query("SELECT auto_info.id, brand.brand as title_brand, model.model as title_model  FROM auto_info "
                . "INNER JOIN model_to_brand ON auto_info.id = model_to_brand.id "
                . "INNER JOIN brand ON brand.id = model_to_brand.brand_id "
                . "INNER JOIN model ON model.id = model_to_brand.model_id");

        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($data)) {
            return $this->response($data, 200);
        } else {
            return $this->response($data, 204);
        }
    }

    public function getCarsById($id)
    {
        $db = Db::getInstance();
        $result = $db->query("SELECT auto_info.*, brand.brand as title_brand, model.model as title_model  FROM auto_info "
                . "INNER JOIN model_to_brand ON auto_info.id = model_to_brand.id "
                . "INNER JOIN brand ON brand.id = model_to_brand.brand_id "
                . "INNER JOIN model ON model.id = model_to_brand.model_id "
                . "WHERE auto_info.id = $id");

        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($data)) {
            return $this->response($data, 200);
        } else {
            return $this->response($data, 204);
        }
    }
    
    
    public function getCarsByIds($data)
    {
        $db = Db::getInstance();
        $id = [];
        if(is_array($data)){
            foreach ($data as $item){
                $id[] = $item['auto_id'];
            }
        }
        
        $ids = implode(', ', $id);
         
        $result = $db->query("SELECT auto_info.id, brand.brand as title_brand, model.model as title_model  FROM auto_info "
                . "INNER JOIN model_to_brand ON auto_info.id = model_to_brand.id "
                . "INNER JOIN brand ON brand.id = model_to_brand.brand_id "
                . "INNER JOIN model ON model.id = model_to_brand.model_id WHERE auto_info.id  IN ($ids)");

       // $data = $result->fetchAll(PDO::FETCH_ASSOC);

        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }

    public function getCarsFilter($year, $brand = '')
    {

        if (empty($year)) {
            return $this->response(array('error' => 'year is require fields'));
        }
        $db = Db::getInstance();
        $addSql = '';
        if (!empty($brand)) {
            $addSql = " AND brand.brand = '$brand'";
        }
        $result = $db->query("SELECT auto_info.*, brand.brand as title_brand, model.model as title_model  FROM auto_info "
                . "INNER JOIN model_to_brand ON auto_info.id = model_to_brand.id "
                . "INNER JOIN brand ON brand.id = model_to_brand.brand_id "
                . "INNER JOIN model ON model.id = model_to_brand.model_id "
                . "WHERE auto_info.year = $year " . $addSql);

        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($data)) {
            return $this->response($data, 200);
        } else {
            return $this->response($data, 204);
        }
    }

}
