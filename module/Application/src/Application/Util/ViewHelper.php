
<?php
namespace Application\Util;
use Zend\View\Helper\AbstractHelper;

class ViewHelper extends AbstractHelper
{
	protected $request;
	 
	//get Request
	public function setRequest($request)
	{
		$this->request = $request;
	}
	 
	public function getRequest()
	{
		return $this->request;
	}
	 
	public function __invoke()
	{
		return $this->getRequest()->getServer()->get('QUERY_STRING');
	}
}