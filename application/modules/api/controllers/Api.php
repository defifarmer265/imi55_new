<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');
require(APPPATH.'/libraries/Format.php');
use Restserver\Libraries\REST_Controller;
class Api extends MY_Controller
{
    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
      }
   

    public function index_get()
    {
        // ดึงรายการทั้งหมด

        $this->response(array(
            'status'=>'get',
            'data' => array('1','2')
        ),200);
    }
 
    public function index_post()
    {
        // สร้างรายการ
        $this->response(array(
            'status'=>'post',
            'data' => array('1','2')
        ),200);
    }
 
    public function index_put()
    {
        // แก้ไขรายการ
        $this->response(array(
            'status'=>'put',
            'data' => array('1','2')
        ),200);
    }
 
    public function index_delete()
    {
        // ลบรายการ
        $this->response(array(
            'status'=>'delete',
            'data' => array('1','2')
        ),200);
    }
}