<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic news interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class NewsPost extends REST_Controller
{
	//function __construct() {
		// Load models
		//$this->load->model('newscenter/News');
	//}

	function news_get()
    {
        if(!$this->get('id'))
        {
        	$this->response(NULL, 400);
        }

        // $news = $this->some_model->getSomething( $this->get('id') );
    	 $news = array(
			1 => array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com', 'fact' => 'Loves swimming'),
			2 => array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com', 'fact' => 'Has a huge face'),
			3 => array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com', 'fact' => 'Is a Scott!'),
		);
		// $news = $this->some_model->getSomething( $this->get('id') );

		// Load models
		$this->load->model('newscenter/News');

		// Set default where condition
		$where_cond = ['type'=>'news','status'=>'publish'];

	 	//$news = $this->News->find_all($where_cond,'*',['publish_date'=>'DESC']);
		$news = @$news[$this->get('id')];

        if($news)
        {
            $this->response($news, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'news could not be found'), 404);
        }
    }

    function news_post()
    {
        //$this->some_model->updatenews( $this->get('id') );
        $message = array('id' => $this->get('id'), 'name' => $this->post('name'), 'email' => $this->post('email'), 'message' => 'ADDED!');

        $this->response($message, 200); // 200 being the HTTP response code
    }

    function news_delete()
    {
    	//$this->some_model->deletesomething( $this->get('id') );
        $message = array('id' => $this->get('id'), 'message' => 'DELETED!');

        $this->response($message, 200); // 200 being the HTTP response code
    }

    function lists_get()
    {

		// Load models
		$this->load->model('newscenter/News');

		// Set default where condition
		$where_cond = ['type'=>'news','status'=>'publish'];
		$news['news'] = $this->News->findAll($where_cond,'*',['publish_date'=>'DESC']);
		$news['total'] = $this->News->findCount($where_cond);
		
        if($news)
        {
            $this->response($news, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Couldn\'t find any newss!'), 404);
        }
    }

}
