<?php

namespace MosseboShopCore\Contracts\Repositories;

interface CategoriesRepository extends Repository
{
    public function getTree();
}