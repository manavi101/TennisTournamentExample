<?php
namespace Core\Repository;

interface AbstractRepositoryInterface{
  public function getById(int $id);
  public function create(object $object);
  public function delete(int $id);
}