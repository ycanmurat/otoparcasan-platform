<?defined('BASEPATH') or exit('No direct script access allowed');

use Carbon\Carbon;

class Home extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
        $this->load->model('Admin/Home_model', 'model');
    }
    public function index()
    {
        $data                            = new StdClass;
        $data->mainMenu                  = 'Home';
        $data->subMenu                   = 'Home';
        $data->now                       = Carbon::now()->setTimezone('Europe/Istanbul')->toDateTimeString();
        $data->bulk_part_offer           = $this->model->bulk_part_offer();
        $data->web_site_reviews          = $this->model->web_site_reviews();
        $data->product_questions         = $this->model->product_questions();
        $data->questions_comments        = $this->model->questions_comments();
        $data->get_last_users            = $this->model->get_last_users();
        $data->product_quality_like      = $this->model->product_quality_like();
        $data->product_quality_dislike   = $this->model->product_quality_dislike();
        $data->ease_of_use_like          = $this->model->ease_of_use_like();
        $data->ease_of_use_dislike       = $this->model->ease_of_use_dislike();
        $data->fast_shipping_like        = $this->model->fast_shipping_like();
        $data->fast_shipping_dislike     = $this->model->fast_shipping_dislike();
        $data->product_packaging_like    = $this->model->product_packaging_like();
        $data->product_packaging_dislike = $this->model->product_packaging_dislike();
        $data->price_range_like          = $this->model->price_range_like();
        $data->price_range_dislike       = $this->model->price_range_dislike();
        $data->mount_of_users            = $this->model->get_mounth_of_users();
        $data->get_week_of_users         = $this->model->get_week_of_users();
        $data->get_day_of_users          = $this->model->get_day_of_users();
        $data->getStar                   = $this->model->getStar();
        $data->getCountReviews           = $this->model->getCountReviews();
        $this->load->view('Admin/header', $data);
        $this->load->view('Admin/home', $data);
        $this->load->view('Admin/footer');
    }

    public function my_404()
    {
        $data = new StdClass;
        
        $data->mainMenu                  = '';
        $data->subMenu                   = '';

        $this->output->set_status_header('404');
        $this->load->view('Admin/header', $data);
        $this->load->view('Admin/404');
        $this->load->view('Admin/footer');
    }
}
