<?php
namespace app\home\controller;

use fengphp\core\controller\Controller;
use app\home\model\Student;

class Index extends Controller {
	public function index () {
		$arr =(new Student()) -> order ('age desc, sex asc') -> select ();
		$this -> data = compact('arr');

		$this -> show ();
	}
}