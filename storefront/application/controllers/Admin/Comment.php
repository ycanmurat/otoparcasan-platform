<?defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Comment_model','CM');
	}

	public function index()
	{
		$data = new StdClass;
		$data->mainMenu = 'Comment';
		$data->subMenu = 'reviewList';
		$data->reviews = $this->CM->getReviews();
		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/review_list', $data);
		$this->load->view('Admin/footer');
	}

	public function deleteComment($id)
	{
		if ($this->CM->deleteComment($id)) {
			redirect(admin_url('Comment'));
		} else {
			redirect(admin_url('Comment'));
		}
	}

	public function addComment($id)
	{
		$data = new StdClass;
		$data->mainMenu = 'Comment';
		$data->subMenu = 'reviewList';
		$data->reviews = $this->CM->getReviewsById($id);
		$data->replys = $this->CM->getReplys();
		if ($this->input->post()) {
			$getAllPosts = $this->getAllPosts();
			$getAllPosts->review_id = $id;
			unset($getAllPosts->comment);
			if (empty($getAllPosts->quick_reply)) {
				unset($getAllPosts->quick_reply);
			} 
			if(empty($getAllPosts->answer)){
				$getAllPosts->answer = $getAllPosts->quick_reply;
				unset($getAllPosts->quick_reply);
			} else {
				unset($getAllPosts->quick_reply);
			}
			if (empty($getAllPosts->answer) && empty($getAllPosts->quick_reply)) {
				$this->session->set_flashdata('hata',2);
				redirect(admin_url('Comment'));
			}
			if ($this->CM->addComment($getAllPosts)) {
				$this->session->set_flashdata('onay',1);
				redirect(admin_url('Comment'));
			} else {
				$this->session->set_flashdata('hata',1);
				redirect(admin_url('Comment'));
			}
		}
		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/review_reply', $data);
		$this->load->view('Admin/footer');
	}

	public function clearComment($id)
	{
		if ($this->CM->clearComment($id)) {
			redirect(admin_url('Comment'));
		} else {
			redirect(admin_url('Comment'));
		}
	}

	public function SetStatus($id,$new)
	{
		if ($this->CM->SetStatus($id,$new)) {
			redirect(admin_url('Comment'));
		} else {
			redirect(admin_url('Comment'));
		}
	}

	public function seenStatus($id,$seen)
	{
		if ($this->CM->seenStatus($id,$seen)) {
			redirect(admin_url('Comment'));
		} else {
			redirect(admin_url('Comment'));
		}
	}

	public function answerList()
	{
		$data = new StdClass;
		$data->mainMenu = 'Comment';
		$data->subMenu = 'answerList';

		$data->answers = $this->CM->getQuickReply();

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/answer_list', $data);
		$this->load->view('Admin/footer');
	}

	public function answerAdd()
	{
		$data = new StdClass;
		$data->mainMenu = 'Comment';
		$data->subMenu = 'answerList';

		if ($this->input->post()) {
			$dataPost = $this->getAllPosts();
			if ($this->CM->addReply($dataPost)) {
				$this->session->set_flashdata('onay',1);
				redirect(admin_url('Comment/answerAdd'));
			} else {
				$this->session->set_flashdata('hata',1);
				redirect(admin_url('Comment/answerAdd'));
			}
		}

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/answer_add', $data);
		$this->load->view('Admin/footer');
	}

	public function deleteReply($id)
	{
		if ($this->CM->deleteReply($id)) {
			redirect(admin_url('Comment/answerList'));
		} else {
			redirect(admin_url('Comment/answerList'));
		}
	}

	public function SetStatusReply($id,$new)
	{
		if ($this->CM->SetStatusReply($id,$new)) {
			redirect(admin_url('Comment/answerList'));
		} else {
			redirect(admin_url('Comment/answerList'));
		}
	}

	public function editReply($id)
	{
		$data = new StdClass;
		$data->mainMenu = 'Comment';
		$data->subMenu = 'answerList';

		$data->reply = $this->CM->getReplyById($id);

		if ($this->input->post()) {
			$dataPost = $this->getAllPosts();

			if ($this->CM->updateReply($dataPost,$id)) {
				redirect(admin_url('Comment/answerList'));
			} else {
				redirect(admin_url('Comment/answerList'));
			}
		}

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/edit_reply', $data);
		$this->load->view('Admin/footer');
	}
}