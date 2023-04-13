<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Core\Helpers\SessionHelper;
use App\Core\Request;
use App\Models\Products;
use App\Models\Variants;

class VariantController extends BaseController
{

    private $_pd;
    private $_variant;
    private $_request;
    public function __construct()
    {
        $this->_pd = new Products();
        $this->_variant = new Variants();
        $this->_request = new Request();
    }

    public function showDetails()
    {
        $prodId  = $this->_request->getQueryParams()['id'] ?? null;
        $prodDetails = $this->_pd->prodSelectById($prodId);
        $prodVariantDetails = $this->_variant->prodSelectById($prodId);
        $data = [
            "details" => $prodDetails,
            "variants" => $prodVariantDetails
        ];
        return $this->render('details', $data);
    }

    public function getColorVariant()
    {
        $colorId  = $this->_request->getQueryParams()['color_id'] ?? null;
        $prodId  = $this->_request->getQueryParams()['prod_id'] ?? null;
        $prodVariantDetails = $this->_variant->prodSelectByColor($prodId, $colorId);
        echo json_encode($prodVariantDetails);
    }

    public function deleteVariant()
    {
        $id = $this->_request->getParam('var_id');
        $res = $this->_variant->deleteVariant((int)$id);
        echo json_encode($res);
    }
}
