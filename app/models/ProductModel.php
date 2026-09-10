<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primary_key = 'id';

    public function all(): array
    {
        return $this->db->table($this->table)->get_all() ?: [];
    }

    public function find(int $id): ?array
    {
        $product = $this->db->table($this->table)
            ->where($this->primary_key, $id)
            ->get();

        return $product ?: null;
    }

    public function create(array $product)
    {
        return $this->db->table($this->table)->insert($product);
    }

    public function update(int $id, array $product)
    {
        return $this->db->table($this->table)
            ->where($this->primary_key, $id)
            ->update($product);
    }

    public function delete(int $id)
    {
        return $this->db->table($this->table)
            ->where($this->primary_key, $id)
            ->delete();
    }
}
