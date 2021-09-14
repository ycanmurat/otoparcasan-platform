<?defined('BASEPATH') OR exit('No direct script access allowed');

class Reviews extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Reviews_model','RM');
	}

	public function index()
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$data->reviewsInformation = $this->RM->getReviewsInformation();
		$data->product_quality_like = $this->RM->product_quality_like();
		$data->product_quality_dislike = $this->RM->product_quality_dislike();
		$data->ease_of_use_like = $this->RM->ease_of_use_like();
		$data->ease_of_use_dislike = $this->RM->ease_of_use_dislike();
		$data->fast_shipping_like = $this->RM->fast_shipping_like();
		$data->fast_shipping_dislike = $this->RM->fast_shipping_dislike();
		$data->product_packaging_like = $this->RM->product_packaging_like();
		$data->product_packaging_dislike = $this->RM->product_packaging_dislike();
		$data->price_range_like = $this->RM->price_range_like();
		$data->price_range_dislike = $this->RM->price_range_dislike();
		$data->menus = $this->Api_model->getCategories();
		$data->commentsAndReviews = $this->RM->getCommentsAndReviews();
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('reviews');
		$this->load->view('footer');
	}

}
